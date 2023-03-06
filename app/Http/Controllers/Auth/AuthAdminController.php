<?php
namespace App\Http\Controllers\Auth;
use App\Helpers\Notify;
use App\Helpers\Obn;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\UserModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
// use App\Mail\NewUserMail;
#Helper
class AuthAdminController extends Controller
{
    private $pathViewController     = "auth.pages.";
    private $controllerName         = "auth";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
    }
    public function login(Request $request)
    {
        return view(
            "{$this->pathViewController}login_admin",
            []
        );
    }
    public function register(Request $request)
    {
        return view(
            "{$this->pathViewController}register",
            []
        );
    }
    public function forgetPassword(Request $request)
    {
        return view(
            "{$this->pathViewController}register",
            []
        );
    }
   
    public function postRegister(Request $request)
    {
        $params = $request->all();
        $params['created_at'] = date('Y-m-d H:i:s');
        $params['password'] = md5($params['password']);
        $userCode = [];
        $checkEmail = [];
        $checkUsername = [];
        $error = [];
        // Check email tồn tại
        $checkEmail = $this->model->getItem($params, ['task' => 'email']);
        if ($checkEmail) {
            $error['email'] = "Đã tồn tại Email trên hệ thống";
        }
        // Check username đã tồn tại
        $checkUsername = $this->model->getItem($params, ['task' => 'username']);
        if ($checkUsername) {
            $error['username'] = "Đã tồn tại Tên đăng nhập trên hệ thống";
        }
        if (empty($error)) {
            // Check parent id
            $userCode = $this->model->getItem($params, ['task' => 'code']);
            $parent_id = (!empty($userCode) && isset($userCode['id'])) ? $userCode['id'] : "";
            $params['parent_id'] = $parent_id;
            $params['status'] = 'pending';
            $params['role'] = 'user';
            $params['code'] = config('obn.prefix.code') . Obn::generateUniqueCode();
            $params['token'] = $params['_token'];
            $status = 200;
            $msg = "Bạn đã đăng ký tài khoản thành công! Vui lòng kiểm tra Email để kích hoạt tài khoản và đăng nhập vào hệ thống!";
            $this->model->saveItem($params, ['task' => 'add-item']);
            try {
                Notify::sendMailRegisterUser($params);
            } catch (\Throwable $th) {
                // $status = 400;
                // $error['email'] = "Gửi mail không thành công";
            }
        } else {
            $status = 400;
            $msg = $error;
        }
        $params['status'] = $status;
        $params['msg'] = $msg;
        // $request->session()->push('userInfo', $userInfo);
        return response()->json($params);
    }
    public function postLogin(Request $request)
    {
        $params = $request->all();
        $userInfo = $this->model->getItem($params, ['task' => 'user-login']);
        $status = null;
        $msg = null;
        $error = [];
        if ($userInfo) {
            $role = isset($userInfo['role']) ? $userInfo['role'] : "";
            $status = isset($userInfo['status']) ? $userInfo['status'] : "";
            if($role == 'user') {
                $error['user'] = "Tài khoản của bạn không có quyền truy cập vào hệ thống ";
            }
            if($status == 'pending') {
                $error['pending'] = "Tài khoản của bạn chưa được kích hoạt. Vui lòng kích hoạt để đăng nhập vào hệ thống";
            }
        }
        else {
            $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
        if(empty($error)) {
            $status =  200;
            $msg = "Đăng nhập thành công";
            session()->push('adminInfo', $userInfo);
        }
        else {
            $status = 400;
            $msg = implode("<br>",$error);
        }
        $params['redirect'] = route('admin/index');
        $params['status'] = $status;
        $params['msg'] = $msg;
        $params['session'] = session()->get('adminInfo');
        $params['adminInfo'] = $userInfo;
        return response()->json($params);
    }
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect(route('admin_auth/login'));
    }
}
