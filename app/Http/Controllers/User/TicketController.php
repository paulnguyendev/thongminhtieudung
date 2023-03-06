<?php
namespace App\Http\Controllers\User;
use App\Helpers\Link\ProductLink;
use App\Helpers\Obn;
use App\Helpers\User;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\TicketModel as MainModel;
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class TicketController extends Controller
{
    private $pathViewController     = "user.pages.ticket";
    private $controllerName         = "user_ticket";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->userModel = new UserModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $navbar_title = "Danh sách thành viên";
        return view(
            "{$this->pathViewController}/index",
            [
                'navbar_title' => $navbar_title,
            ]
        );
    }
    public function form(Request $request)
    {
        $id = $request->id;
        $user = User::getInfo();
        $item = $this->model->getItem(['id' => $id],['task' => 'id']);
        $itemName = $item['name'] ?? "-";
        $code = $item['code'] ?? "";
        $itemName = $itemName . " - " . "Mã yêu cầu: {$code}";
        $navbar_title =   $id  ? $itemName : "Tạo yêu cầu hỗ trợ";
        $items = [];
        if ($id) {
            $items = $this->model->orderBy('id','desc')->descendantsOf($id);
            $phone = $item['phone'] ?? "";
        } else {
            $phone = $user['phone'] ?? "";
        }
        return view(
            "{$this->pathViewController}/form",
            [
                'navbar_title' => $navbar_title,
                'item' => $item,
                'user' => $user,
                'phone' => $phone,
                'id' => $id,
                'items' => $items,
            ]
        );
    }
    public function dataList(Request $request)
    {
        $result = [];
        $user_id = User::getInfo('', 'id');
        $user = $this->userModel ::find($user_id);
        $items = $user->ticket()->whereNull('parent_id')->get();
        $total = count($items);
        $items = $total > 0 ? $items->toArray() : [];
        $items =  array_map(function ($item) {
            $id = $item['id'];
            $item['created_at'] = date('H:i:s d/m/Y', strtotime($item['created_at']));
            $user = $this->model::find($id);
            $item['route_edit'] = route("{$this->controllerName}/form",['id' => $id]);
            #_Status
            $status = $item['status'];
            $status = $status ? $status : 'default';
            $tpl_status = config('obn.ticket.status');
            $current_status = isset($tpl_status[$status]) ? $tpl_status[$status] : $tpl_status['default'];
            $xhtml_status = sprintf('<span class = "badge %s">%s</span>', $current_status['class'], $current_status['name']);
            $item['status'] = $xhtml_status;
            return $item;
        }, $items);
        $result = [
            'draw' => 0,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
        ];
        return $result;
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $user_id = User::getInfo('', 'id');
        $id = $request->id;
        $error = [];
        $user = [];
        $parent_id = null;
        if (isset($params['name']) && !$params['name']  ) {
            $error['name'] = "Chưa nhập Tiêu đề cần hỗ trợ";
        }
        if (!$params['content']) {
            $error['content'] = "Chưa nhập Nội dung cần hỗ trợ";
        }
        if (empty($error)) {
            $params['created_at'] = date('Y-m-d H:i:s');
            $params['parent_id'] = $id ? $id : NULL;
            $params['user_id'] = $user_id ??  NULL;
            $params['status'] = 'pending';
            $params['code'] = config('obn.prefix.code') . Obn::generateUniqueCode();
            $this->model->saveItem($params, ['task' => 'add-item']);
            if ($id) {
                $params['redirect'] = route("{$this->controllerName}/form",['id' => $id]);
                session()->flash('status_success', 'Phản hồi yêu cầu thành công');
            } else {
                $params['redirect'] = route("{$this->controllerName}/index");
                session()->flash('status_success', 'Tạo yêu cầu thành công');
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
}
