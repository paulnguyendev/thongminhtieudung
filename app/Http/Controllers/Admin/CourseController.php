<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Obn;
use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\ProductMetaModel;
use App\Models\SupplierModel;
use App\Models\TaxonomyModel;
#Request
#Model
use App\Models\CourseModel as MainModel;
use App\Models\TaxonomyRelationshipModel;
use App\Models\TeacherModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class CourseController extends Controller
{
    private $pathViewController     = "admin.pages.course.";
    private $controllerName         = "admin_course";
    private $title         = "Khóa học";
    private $model;
    private $params                 = [];
    private $teacherModel;
    private $taxonomyRelationshipModel;
    private $productMetaModel;
    private $supplierModel;
    private $taxonomyModel;
    private $levelModel;
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->supplierModel = new SupplierModel();
        $this->productMetaModel = new ProductMetaModel();
        $this->taxonomyRelationshipModel = new TaxonomyRelationshipModel();
        $this->teacherModel = new TeacherModel();
        $this->levelModel = new LevelModel();
        View::share('controllerName', $this->controllerName);
        View::share('title', $this->title);
    }
    public function index(Request $request)
    {
        return view(
            "{$this->pathViewController}index",
            []
        );
    }
    public function form(Request $request)
    {
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
        if (!$params['teacher_id']) {
            $error['teacher_id'] = "Chưa chọn giáo viên";
        }
        if (!$params['level_id']) {
            $error['level_id'] = "Chưa chọn trình độ";
        }
        if (!$params['slug']) {
            $error['slug'] = "Chưa nhập đường dẫn";
        }
        if (!$params['time']) {
            $error['time'] = "Chưa nhập thời lượng video";
        }
        if ($params['price_sale'] > $params['price']) {
            $error['price_sale'] = "Giá khuyến mãi không được lớn hơn giá gốc";
        }
        if (empty($error)) {
            $created_at = date('Y-m-d H:i:s');
            $params['created_at'] = date('Y-m-d H:i:s');
            $cat_id = isset($params['cat_id']) ? $params['cat_id'] : "";
            $other_cat_ids = isset($params['other_cat_ids']) ? $params['other_cat_ids'] : [];
            $params['is_certificate'] = isset($params['is_certificate']) ? $params['is_certificate'] : 0;
            $params['is_best_seller'] = isset($params['is_best_seller']) ? $params['is_best_seller'] : 0;
            $params['is_published'] = isset($params['is_published']) ? $params['is_published'] : 0;
            if (!$id) {
                #_Add Product
                $product_id = $this->model->saveItem($params, ['task' => 'add-item']);
                if ($product_id) {
                    #_Add Taxonomy Relationships
                    $taxonomyMain = [
                        [
                            'course_id' => $product_id,
                            'taxonomy_id' => $cat_id,
                            'taxonomy_type' => 'main',
                        ]
                    ];
                    $taxonomySecond = [];
                    if (count($other_cat_ids) > 0) {
                        foreach ($other_cat_ids as $key_otherCatID => $other_cat_id) {
                            $taxonomySecond[$key_otherCatID]['taxonomy_id'] = $other_cat_id;
                            $taxonomySecond[$key_otherCatID]['taxonomy_type'] = 'second';
                            $taxonomySecond[$key_otherCatID]['course_id'] = $product_id;
                        }
                        $taxonomyList = array_merge($taxonomyMain, $taxonomySecond);
                    } else {
                        $taxonomyList = $taxonomyMain;
                    }

                    if (count($taxonomyList) > 0) {
                        foreach ($taxonomyList as $paramsTaxonomyRelationship) {
                            $this->taxonomyRelationshipModel->saveItem($paramsTaxonomyRelationship, ['task' => 'add-item']);
                        }
                    }
                }
            } else {
                $params['action'] = "edit";
                #_Edit Product
                $paramsProduct['id'] = $id;
                $this->model->saveItem($params, ['task' => 'edit-item']);
                #_Edit taxonomy relationship
                if (count($other_cat_ids) > 0) {
                    #_Delete item cũ
                    $taxonomy = $this->model::find($id)->taxonomy()->get()->toArray();
                    if (count($taxonomy) > 0) {
                        foreach ($taxonomy as $item_taxonomy) {
                            $this->taxonomyRelationshipModel->deleteItem(
                                [
                                    'taxonomy_id' => $item_taxonomy['id'],
                                    'course_id' => $id,
                                ],
                                ['task' => 'course_id']
                            );
                        }
                    }
                    #_Add item mới
                    $taxonomyMain = [
                        [
                            'course_id' => $id,
                            'taxonomy_id' => $cat_id,
                            'taxonomy_type' => 'main',
                        ]
                    ];
                    $taxonomySecond = [];
                    if (count($other_cat_ids) > 0) {
                        foreach ($other_cat_ids as $key_otherCatID => $other_cat_id) {
                            $taxonomySecond[$key_otherCatID]['taxonomy_id'] = $other_cat_id;
                            $taxonomySecond[$key_otherCatID]['taxonomy_type'] = 'second';
                            $taxonomySecond[$key_otherCatID]['course_id'] = $id;
                        }
                        $taxonomyList = array_merge($taxonomyMain, $taxonomySecond);
                    } else {
                        $taxonomyList = $taxonomyMain;
                    }
                    if (count($taxonomyList) > 0) {
                        foreach ($taxonomyList as $paramsTaxonomyRelationship) {
                            $this->taxonomyRelationshipModel->saveItem($paramsTaxonomyRelationship, ['task' => 'add-item']);
                        }
                    }
                } else {
                    #_Delete item cũ
                    $taxonomy = $this->model::find($id)->taxonomy()->where('taxonomy_type', 'second')->get()->toArray();
                    if (count($taxonomy) > 0) {
                        foreach ($taxonomy as $item_taxonomy) {
                            $this->taxonomyRelationshipModel->deleteItem(
                                [
                                    'taxonomy_id' => $item_taxonomy['id'],
                                    'course_id' => $id,
                                ],
                                ['task' => 'course_id']
                            );
                        }
                    }
                }
            }
            $params['redirect'] = route("{$this->controllerName}/index");
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
        if (!$searchValue) {
            $data = $this->model->listItems(['start' => $start, 'length' => $length], ['task' => 'list']);
        } else {
            $data = $this->model->listItems(['title' => $searchValue], ['task' => 'search']);
        }
        $total = count($data);
        $data  = $total > 0 ? $data->toArray() : [];
        $data = array_map(function ($item) {
            $id = $item['id'];
            $slug = $item['slug'];
            $item['route_edit'] = route('admin_course/form', ['id' => $id]);
            $item['published_at'] = "";
            $item['description'] = [
                'title' => $item['title'],
            ];
            $product = $this->model::find($id);
            $taxonomy = $product->taxonomy()->where('taxonomy_type', 'main')->first();
            $taxonomyName = $taxonomy ? $taxonomy->name : "";
            $taxonomyID = $taxonomy ? $taxonomy->id : "";
            $item['taxonomy'] = $taxonomy;
            $item['category'] = [
                "id" => $taxonomyID,
                "description" => [
                    "cat_id" => $taxonomyID,
                    "title" => $taxonomyName,
                ]
            ];
            $item["thumbnail"] = [
                "lazy_src" => "data-isrc",
                "img_path" => $item['thumbnail'],
                "class" => "lazyload ",
                "alt_content" => ""
            ];
            $item['is_advanced_quantity'] = 0;
            $item['route_update'] = route('admin_course/updateField', ['id' => $id]);
            $item['direct_add_to_cart_url'] = route('fe_cart/add', ['id' => $id]);
            $item['route_review'] = route('fe_course/detail', ['slug' => $slug]);
            
            $item['price_formated'] = Obn::showPrice($item['price']);
            if ($item['price_sale']) {
                $item['sale_price_formated'] = Obn::showPrice($item['price_sale']);
            }
            $item['published_at'] = $item['created_at'];
            $item['route_remove'] = route('admin_course/delete', ['id' => $id]);
            return $item;
        }, $data);
        $result = [
            "draw" => 0,
            "recordsTotal" => $this->model->count(),
            "recordsFiltered" => $this->model->count(),
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
