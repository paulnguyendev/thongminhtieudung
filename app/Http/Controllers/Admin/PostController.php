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
use App\Models\PostModel as MainModel;
use App\Models\TaxonomyRelationshipModel;
use App\Models\TeacherModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class PostController extends Controller
{
    private $pathViewController     = "admin.pages.post.";
    private $controllerName         = "admin_post";
    private $title         = "Bài viết";
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
            if (!$id) {
                #_Add Product
                $product_id = $this->model->saveItem($params, ['task' => 'add-item']);
            } else {
                #_Edit Product
                $paramsProduct['id'] = $id;
                $this->model->saveItem($params, ['task' => 'edit-item']);
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
            $item['route_edit'] = route('admin_post/form', ['id' => $id]);
            $item['published_at'] = "";
            $item['description'] = [
                'title' => $item['title'],
            ];
            $item["thumbnail"] = [
                "lazy_src" => "data-isrc",
                "img_path" => $item['thumbnail'],
                "class" => "lazyload ",
                "alt_content" => ""
            ];
            $item['is_advanced_quantity'] = 0;
            $item['published_at'] = $item['created_at'];
            $item['route_remove'] = route('admin_post/delete', ['id' => $id]);
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
