<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\Obn;
use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use App\Models\LevelModel;
use App\Models\ProductMetaModel;
use App\Models\SupplierModel;
use App\Models\TaxonomyModel;
#Request
#Model
use App\Models\LessonModel as MainModel;
use App\Models\TaxonomyRelationshipModel;
use App\Models\TeacherModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class LessonController extends Controller
{
    private $pathViewController     = "admin.pages.lesson.";
    private $controllerName         = "admin_lesson";
    private $title         = "Bài học";
    private $model;
    private $params                 = [];
    private $teacherModel;
    private $taxonomyRelationshipModel;
    private $productMetaModel;
    private $supplierModel;
    private $taxonomyModel;
    private $levelModel;
    private $courseModel;
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->supplierModel = new SupplierModel();
        $this->productMetaModel = new ProductMetaModel();
        $this->taxonomyRelationshipModel = new TaxonomyRelationshipModel();
        $this->teacherModel = new TeacherModel();
        $this->levelModel = new LevelModel();
        $this->courseModel = new CourseModel();
        View::share('controllerName', $this->controllerName);
        View::share('title', $this->title);
    }
    public function index(Request $request)
    {
        $course_id = null;
        return view(
            "{$this->pathViewController}index",
            [
                'course_id' => $course_id,
            ]
        );
    }
    public function course_index(Request $request)
    {
        $course_id = $request->course_id;
        $courseInfo = $this->courseModel->getItem(['id' => $course_id], ['task' => 'id']);
        $courseLink = route('admin_course/form', ['id' => $course_id]);
        $manageCourseLink = route('admin_course/index');
        $courseTitleLink = $courseInfo ? " <a href = '{$manageCourseLink}'>Quản lý khóa học</a> / <a href = '{$courseLink}'>{$courseInfo->title}</a> " : "";
        $courseTitle = $courseInfo ? $courseInfo->title : "";
        return view(
            "{$this->pathViewController}index",
            [
                'courseTitleLink' => $courseTitleLink,
                'course_id' => $course_id,
            ]
        );
    }
    public function course_form(Request $request)
    {
        $course_id = $request->course_id;
        $courseInfo = $this->courseModel->getItem(['id' => $course_id], ['task' => 'id']);
        $courseLink = route('admin_course/form', ['id' => $course_id]);
        $courseTitleLink = $courseInfo ? "<a href = '{$courseLink}'>{$courseInfo->title}</a> " : "";
        $courseTitle = $courseInfo ? $courseInfo->title : "";
        $id = $request->id;
        $item = $this->model->getItem(['id' => $id], ['task' => 'id']);
        $lessons = $this->model->listItems([], ['task' => 'list_title']);
        $redirect = route('admin_lesson/course_index',['course_id' => $course_id]);
        return view(
            "{$this->pathViewController}form",
            [
                'item' => $item,
                'id' => $id,
                'course_id' => $course_id,
                'courseTitle' => $courseTitle,
                'courseTitleLink' => $courseTitleLink,
                'lessons' => $lessons,
                'redirect' => $redirect,
            ]
        );
    }
    public function form(Request $request)
    {
        $course_id = $request->course_id;
        $courseInfo = $this->courseModel->getItem(['id' => $course_id], ['task' => 'id']);
        $courseLink = route('admin_course/form', ['id' => $course_id]);
        $courseTitle = $courseInfo ? "<a href = '{$courseLink}'>{$courseInfo->title}</a> " : "";
        $categories = $this->taxonomyModel::withDepth()->get()->toFlatTree()->where('taxonomy', 'course_cat')->pluck('name_with_depth', 'id');
        $suppliers =  $this->supplierModel->listItems([], ['task' => 'list']);
        $id = $request->id;
        $item = $this->model->getItem(['id' => $id], ['task' => 'id']);
        $item_meta = $this->productMetaModel->getItem(['product_id' => $id], ['task' => 'product_id']);
        $taxonomy = [];
        $taxonomy_ids = [];
        $taxonomy_second_ids = [];
        $teachers = $this->teacherModel->listItems([], ['task' => 'list_title']);
        $levels = $this->levelModel->listItems([], ['task' => 'list_title']);
        if ($id) {
            $taxonomy = $this->model::find($id)->taxonomy()->get();
            $taxonomy = $taxonomy ? $taxonomy->toArray() : [];
            $taxonomySecond = $this->model::find($id)->taxonomy()->where('taxonomy_type', 'second')->get();
            $taxonomySecond = $taxonomySecond ? $taxonomySecond->toArray() : [];
            $taxonomy_ids = array_column($taxonomy, 'id');
            $taxonomy_second_ids = array_column($taxonomySecond, 'id');
        }
        return view(
            "{$this->pathViewController}form",
            [
                'categories' => $categories,
                'suppliers' => $suppliers,
                'item' => $item,
                'id' => $id,
                'item_meta' => $item_meta,
                'taxonomy_ids' => $taxonomy_ids,
                'taxonomy_second_ids' => $taxonomy_second_ids,
                'teachers' => $teachers,
                'levels' => $levels,
                'course_id' => $course_id,
                'courseTitle' => $courseTitle,
            ]
        );
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $id = isset($params['id']) ? $params['id'] : "";
        $is_published = isset($params['is_published']) ? $params['is_published'] : "1";
        $error = [];
        $paramsProduct = [];
        $paramsMeta = [];
        $paramsTaxonomyRelationship = [];
        $taxonomyList = [];
        if (!$params['title']) {
            $error['title'] = "Chưa nhập tên khóa học";
        }
        if (empty($error)) {
            $created_at = date('Y-m-d H:i:s');
            $params['created_at'] = date('Y-m-d H:i:s');
            $params['is_try'] = isset($params['is_try']) ? $params['is_try'] : 0;
            if (!$id) {
                $this->model->saveItem($params, ['task' => 'add-item']);
            } else {
                #_Edit Product
                $this->model->saveItem($params, ['task' => 'edit-item']);
            }
            // $params['redirect'] = route("{$this->controllerName}/index");
            return response()->json($params);
        } else {
            return response()->json(
                $error,
                422,
            );
        }
    }
    public function dataList(Request $request)
    {
        // [
        //     "id" => "29",
        //     "code" => "",
        // "thumbnail" => [
        //     "lazy_src" => "data-isrc",
        //     "img_path" => "https://media.loveitopcdn.com/34798/thumb/80x80/jahi-central-home-loc-an.jpg?zc=1",
        //     "class" => "lazyload ",
        //     "alt_content" => ""
        // ],
        //     "price" => "0",
        //     "sale_price" => "0",
        //     "updated_at" => "2022-12-23 01:39:24",
        //     "in_stock" => "1",
        //     "quantity" => "0",
        //     "allow_out_of_stock_order" => "0",
        //     "published_at" => "2021-07-08 09:05:45",
        //     "cat_id" => "325",
        //     "manufacturer_id" => "0",
        //     "is_published" => "1",
        //     "sort_order" => "29",
        //     "deleted_at" => "",
        //     "deleted_by" => "",
        //     "description" => [
        //         "product_id" => "29",
        //         "title" => "Khu dân cư Jahi-Central Home Lộc An"
        //     ],
        //     "seo" => [
        //         "id" => "1080",
        //         "slug" => "can-ho-pearl-plaza-3-phong-ngu-tang-11",
        //         "robots" => "1",
        //         "taxonomy_type" => "product",
        //         "taxonomy_id" => "29",
        //         "lang_code" => "vi",
        //         "meta_title" => "Đất nền TRUNG TÂM giá rẻ ở Lâm Đồng | Jahi-Central Home Lộc An",
        //         "meta_keyword" => "Jahi central home lộc an, jahi central home loc an",
        //         "meta_description" => "Tọa lạc ngay trung tâm xã Lộc An, huyện Bảo Lâm, tỉnh Lâm Đồng. Khu dân cư Jahi-Central Home Lộc An thừa hượng trọn vẹn hệ thống giao thương trọng điểm của xa Lộc An.",
        //         "other_link" => "",
        //         "is_newtab_other_link" => "0"
        //     ],
        //     "category" => [
        //         "id" => "325",
        //         "description" => [
        //             "cat_id" => "325",
        //             "title" => "Dự án "
        //         ]
        //     ],
        //     "manufacturer" => "",
        //     "price_formated" => "0đ",
        //     "sale_price_formated" => "0đ",
        //     "route_duplicate" => "https://dainghiagroup.com/admin/product/duplicate/29",
        //     "route_edit" => "https://dainghiagroup.com/admin/product/29/edit",
        //     "route_update" => "https://dainghiagroup.com/admin/product/29/update-field",
        //     "route_remove" => "https://dainghiagroup.com/admin/product/29",
        //     "direct_add_to_cart_url" => "https://dainghiagroup.com/add-to-cart/29",
        //     "route_review" => "https://dainghiagroup.com/du-an-dat-nen-bao-loc/can-ho-pearl-plaza-3-phong-ngu-tang-11.html",
        //     "move_up" => "https://dainghiagroup.com/admin/product/29/move?direction=up&amp;range=1",
        //     "move_down" => "https://dainghiagroup.com/admin/product/29/move?direction=down",
        //     "move_top" => "https://dainghiagroup.com/admin/product/29/move?direction=top",
        //     "move_bottom" => "https://dainghiagroup.com/admin/product/29/move?direction=bottom",
        //     "is_advanced_quantity" => "",
        //     "published_at_formated" => "08-07-2021 09:05:45",
        //     "deleted_at_formated" => "01-01-1970 08:00:00"
        // ],
        $data = [];
        $params = $request->all();
        $draw = isset($params['draw']) ? $params['draw'] : "";
        $start = isset($params['start']) ? $params['start'] : "";
        $length = isset($params['length']) ? $params['length'] : "";
        $search = isset($params['search']) ? $params['search'] : "";
        $searchValue = isset($search['value']) ? $search['value'] : "";
        $course_id = isset($params['course_id']) ? $params['course_id'] : "";
        if (!$searchValue) {
            $data = $this->model::withDepth()->orderBy('id','desc');
            if($course_id) {
                $data  = $data->where('course_id',$course_id);
            }
            if($start) {
                $data = $data->skip($params['start'])->take($params['length']);
            }
            $data = $data->get()->toFlatTree();
            // $data = $this->model->listItems(['start' => $start, 'length' => $length], ['task' => 'list']);
        } else {
            $data = $this->model->listItems(['title' => $searchValue], ['task' => 'search']);
        }
        $total = count($data);
        $data  = $total > 0 ? $data->toArray() : [];
        $data = array_map(function ($item) {
            $id = $item['id'];
            $course = $this->model::find($id)->course()->first();
            $courseTitle = $course ? $course->title : "";
            $courseID = $course ? $course->id : "";
            $item['course2'] = $course;
            $item['course'] = [
                'title' => $courseTitle
            ];
            $item['is_try_show'] = $item['is_try'] == 1 ? "Có" : "Không";
            $item['route_edit'] = route('admin_lesson/course_form', ['course_id' => $courseID,'id' => $id]);
            $item['published_at'] = "";
            $product = $this->model::find($id);
            $item['is_advanced_quantity'] = 0;
            $item['route_update'] = route('admin_course/updateField', ['id' => $id]);
            $item['direct_add_to_cart_url'] = route('fe_cart/add', ['id' => $id]);
            $item['route_review'] = route('fe_course/detail', ['slug' => '123']);
            $item['published_at'] = $item['created_at'];
            $item['route_remove'] = route('admin_lesson/delete', ['id' => $id]);
            return $item;
        }, $data);
        $result = [
            "draw" => $draw,
            "recordsTotal" => count($data) ,
            "recordsFiltered" => count($data),
            "data" => $data
        ];
        return $result;
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $this->model->deleteItem(['id' => $id], ['task' => 'delete']);
        return [
            'success' => true,
            'message' => 'Đã chuyển nội dung vào thùng rác'
        ];
    }
    public function updateField(Request $request)
    {
        $id = $request->id;
        $params = $request->all();
        $published_at = isset($params['published_at']) ? $params['published_at']  : "";
        $is_published = isset($params['is_published']) ? $params['is_published']  : "";
        $value = isset($params['value']) ? $params['value']  : "";
        $name = isset($params['name']) ? $params['name']  : "";
        $price = isset($params['price']) ? $params['price']  : "";
        $paramsUpdate['id'] = $id;
        $isUpdate = false;
        $reload = false;
        if ($published_at) {
            $paramsUpdate['created_at'] = $published_at;
            $isUpdate = true;
        }
        if ($is_published != '') {
            $paramsUpdate['is_published'] = $is_published;
            $isUpdate = true;
        }
        if ($name) {
            if ($value) {
                $paramsUpdate['in_stock'] = 1;
            } else {
                $paramsUpdate['in_stock'] = 0;
            }
            $isUpdate = true;
        }
        if ($price) {
            $isUpdate = true;
            $paramsUpdate['regular_price'] = $price;
            $reload = true;
        }
        if ($isUpdate == true) {
            $this->model->saveItem($paramsUpdate, ['task' => 'edit-item']);
        }
        return [
            'id' => $id,
            'value' => $value,
            'reload' => $reload,
        ];
    }
    public function destroyMulti(Request $request)
    {
        $ids = $request->ids;
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $this->model->deleteItem(['id' => $id], ['task' => 'delete']);
            }
        }
        return $ids;
    }
}
