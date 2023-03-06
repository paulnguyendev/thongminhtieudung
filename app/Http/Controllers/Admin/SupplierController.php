<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\SupplierModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class SupplierController extends Controller
{
    private $pathViewController     = "admin.pages.supplier.";
    private $controllerName         = "supplier";
    private $title         = "Nhà cung cấp";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
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
        $id = $request->id;
        $item = $this->model->getItem(['id' => $id],['task' => 'id']);
        $actionTitle = $id ? "Chỉnh sửa" : "Tạo mới";
        return view(
            "{$this->pathViewController}form",
            [
                'item' => $item,
                'id' => $id,
                'actionTitle' => $actionTitle,
            ]
        );
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $id = $request->id;
        $error = [];
        if (!$params['name']) {
            $error['name'] = "Chưa nhập tên nhà cung cấp";
        }
        
        if (!$params['phone']) {
            $error['phone'] = "Chưa nhập Số điện thoại nhà cung cấp";
        }
        if (!$params['address']) {
            $error['address'] = "Chưa nhập Địa chỉ nhà cung cấp";
        }
        if (empty($error)) {
            $params['created_at'] = date('Y-m-d H:i:s');
            if(!$id) {
                $this->model->saveItem($params, ['task' => 'add-item']);
            }
            else {
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
        $search = $request->search;
        $searchValue = isset($search['value']) ? $search['value'] : "";
        if(!$searchValue) {
            $items = $this->model->listItems([],['task' => 'list']);
            $items = $items ? $items->toArray()  : [];
        }
        else {
            $items  = $this->model->listItems(['name' => $searchValue],['task' => 'search']);
        }
        $items = array_map(function ($item) {
            $id = $item['id'];
            $item['description'] = [
                'title' => $item['name'],
                'cat_id' => $item['id'],
                'lang_code' => 'vi'
            ];
            $item['route_edit'] = route('supplier/form',['id' => $item['id']]);
            $item['route_remove'] = route('supplier/delete',['id' => $id]);
            $item['move_up'] = "#";
            $item['move_down'] = "#";
            $item['move_top'] = "#";
            $item['move_bottom'] = "#";
            return $item;
        }, $items);
        $total = count($items);
        return $result = [
            "draw" => 0,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $items
        ];
    }
    public function delete(Request $request) {
        $id = $request->id;
        $this->model->deleteItem(['id' => $id],['task' => 'node-delete']);
        return $id;
    }
    public function destroyMulti(Request $request) {
        $ids = $request->ids;
        if(count($ids) > 0) {
            foreach ($ids as $id) {
                $this->model->deleteItem(['id' => $id],['task' => 'delete']);
            }
        }
        return $ids;
    }
}
