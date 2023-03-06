<?php
namespace App\Http\Controllers\User;
use App\Helpers\User;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\UserModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class ProfileController extends Controller
{
    private $pathViewController     = "user.pages.profile.";
    private $controllerName         = "user_profile";
    private $title         = "Tài khoản";
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
        $actionTitle = "Thay đổi thông tin";
        $info = User::getInfo();
        return view(
            "{$this->pathViewController}form",
            [
                'id' => $id,
                'actionTitle' => $actionTitle,
                'info' => $info,
            ]
        );
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $id = $request->id;
        $error = [];
        if (!$params['name']) {
            $error['name'] = "Chưa nhập tên Admin";
        }
        if (!$params['username']) {
            $error['username'] = "Chưa nhập tên đăng nhập admin";
        }
        $password = isset($params['password']) ? md5($params['password']) : "";
        $new_password = isset($params['new_password']) ? md5($params['new_password']) : "";
        $confirm_password = isset($params['confirm_password']) ? md5($params['confirm_password']) : "";
        $current_password = User::getInfo('','password');
        $user_id = User::getInfo('','id');
        $paramsUpdate = [];
        if($password) {
            if($password != $current_password) {
                $error['password'] = "Mật khẩu không đúng";
            }
            elseif(!$new_password) {
                $error['new_password'] = "Bạn vui lòng nhập mật khẩu mới!";
            }
            elseif($confirm_password != $new_password) {
                $error['confirm_password'] = "Mật khẩu không khớp!";
            }
            else {
                $paramsUpdate['password'] = $new_password;
            }
        }
        else {
            if($new_password) {
                $error['password'] = "Bạn vui lòng nhập mật khẩu!";
            }
        }
        if (empty($error)) {
            $paramsUpdate['id'] = $user_id;
            $paramsUpdate['username'] = $params['username'];
            $paramsUpdate['name'] = $params['name'];
            $paramsUpdate['phone'] = $params['phone'];
            $this->model->saveItem($paramsUpdate, ['task' => 'edit-item']);
            session()->flash('status_success', 'Tài khoản đã được thay đổi!');
            $params['redirect'] = route("{$this->controllerName}/form");
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
    public function profile(Request $request) {
        return view(
            "{$this->pathViewController}profile",
            [
                'actionTitle' => 'Tài khoản'
            ]
        );
    }
}
