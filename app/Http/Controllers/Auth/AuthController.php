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
class AuthController extends Controller
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
            "{$this->pathViewController}login",
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
    public function active(Request $request)
    {
        $token = $request->token;
        $user = $this->model->getItem(['token' => $token], ['task' => 'token']);
        $msg = null;
        $login_url = route('auth/login');
        if (!$user) {
            $msg = "<span class = 'text-danger'>Tài khoản của bạn không tồn tại trên hệ thống</span>";
        } else {
            if ($user['status'] == 'active') {
                $msg = "<span class = 'text-warning'>Tài khoản của bạn đã được kích hoạt trước đó.  <br> Vui lòng <a href = '{$login_url}'>đăng nhập</a> để sử dụng hệ thống</span>";
            } else {
                $this->model->saveItem(['token' => $token, 'status' => 'active'], ['task' => 'active-by-token']);
                $msg = "<span class = 'text-success'>Tài khoản của bạn đã được kích hoạt thành công. Vui lòng <a href = '{$login_url}'>đăng nhập</a> để sử dụng hệ thống</span>";
            }
        }
        return view(
            "{$this->pathViewController}active",
            [
                'msg' => $msg,
            ]
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
         // Check số điện thoại tồn tại
         $checkPhone = $this->model->getItem($params, ['task' => 'phone']);
         if ($checkPhone) {
             $error['phone'] = "Đã tồn tại số điện thoại trên hệ thống";
         }
        if (empty($error)) {
            // Check parent id
            $status = 200;
            $email = $params['email'] ?? "";
            $msg = "Bạn đã đăng ký tài khoản thành công! Vui lòng kiểm tra Email để kích hoạt tài khoản và đăng nhập vào hệ thống!";
            $userCode = $this->model->getItem($params, ['task' => 'code']);
            if(!$userCode) {
                $status = 400;
                $error['parent_code'] = "Mã giới thiệu không tồn tại";
                $msg = $error;
            }
            else {
                $parent_id = $userCode['id'];
                $params['parent_id'] = $parent_id;
                $params['status'] = 'active';
                $params['role'] = 'user';
                // $params['code'] = config('obn.prefix.code') . Obn::generateUniqueCode();
                $params['code'] = null;
                $params['token'] = md5($email. time());
                $this->model->saveItem($params, ['task' => 'add-item']);
            }
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
            if($role == 'admin') {
                $error['admin'] = "Tài khoản của bạn là admin! ";
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
            session()->push('userInfo', $userInfo);
        }
        else {
            $status = 400;
            $msg = implode("<br>",$error);
        }
        $params['redirect'] = route('user/index');
        $params['status'] = $status;
        $params['msg'] = $msg;
        $params['session'] = session()->get('userInfo');
        $params['userInfo'] = $userInfo;
        return response()->json($params);
    }
    public function logout(Request $request) {
        $request->session()->forget('userInfo');
        return redirect(route('auth/login'));
    }
}
