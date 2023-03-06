<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Obn;
use App\Helpers\User;
use App\Helpers\Package\AffiliatePackage;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\TransactionModel as MainModel;
use App\Models\OrderModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class TransactionController extends Controller
{
    private $pathViewController     = "admin.pages.transaction.";
    private $controllerName         = "admin_transaction";
    private $model;
    private $orderModel;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->orderModel = new OrderModel();
        View::share('controllerName', $this->controllerName);
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
        return view(
            "{$this->pathViewController}form",
            [
                'item' => $item,
                'id' => $id,
            ]
        );
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $id = $request->id;
        $error = [];
        if (!$params['title']) {
            $error['title'] = "Chưa nhập tên giáo viên";
        }
        if (!$params['position']) {
            $error['position'] = "Chưa nhập tên chức vụ";
        }
        if (empty($error)) {
            $params['created_at'] = date('Y-m-d H:i:s');
            if(!$id) {
                $this->model->saveItem($params, ['task' => 'add-item']);
            }
            else {
                $this->model->saveItem($params, ['task' => 'edit-item']);
            }
            $params['redirect'] = route('admin_teacher/index');
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
            $data = $this->model->listItems([],['task' => 'list'])->toArray();
        }
        else {
            $data  = $this->model->listItems(['title' => $searchValue],['task' => 'search'])->toArray();
        }
        $data = array_map(function ($item) {
            $id = $item['id'];
            $total = $item['total'] ?? 0;
            $item['totalShow'] = Obn::showPrice($total);
            $user_id = $item['user_id'];
            // Thông tin user
            $user = User::getInfo($user_id);
            $userName = $user['name'] ?? "-";
            $userPhone = $user['phone'] ?? "-";
            $userLevelId = $user['level_id'] ?? "";
            $userLevel = AffiliatePackage::getCurrentLevel($userLevelId,'name');
            $userInfo = "{$userName}";
            // Thông tin đơn hàng
            $order_id = $item['order_id'];
            $order = $this->orderModel::find($order_id);
            $orderCode = $order['code'] ?? "-";
            $orderRoute = route('admin_order/detail',['id' => $order_id]);
            $orderTitle = "<a target = '_blank' href = '{$orderRoute}'>{$orderCode}</a>";
            $orderTotal = $order['total'] ?? 0;
            $orderTotal = Obn::showPrice($orderTotal);
           
            $orderUserId = $order['created_by'];
            $orderUserInfo = User::getInfo($orderUserId);
            $orderUserName = $orderUserInfo['name'] ?? "-";
            $orderUserParentId = $orderUserInfo['parent_id'] ?? "";
            $orderUserParentName = User::getInfo($orderUserParentId,'name');
            $orderUserLevelId = $orderUserInfo['level_id'] ?? "";
            $orderUserLevelName = AffiliatePackage::getCurrentLevel($orderUserLevelId,'name');
            $orderInfo = "Mã đơn: {$orderTitle} <br> Tổng tiền: <span class = 'text-danger'>{$orderTotal} </span>  <br> Họ tên: {$orderUserName}";
            $item['orderInfo'] = $orderInfo;
            $item['userInfo'] = $userInfo;
            $item['statusShow'] = Obn::showStatus($item['status'] ?? "");
            $item['route_edit'] = "#";
            $item['route_remove'] = route("{$this->controllerName}/delete",['id' => $id]);
            $item['route_approve'] = route("{$this->controllerName}/approve",['id' => $id,'category' => 'affiliate','status' => $item['status']]);
            return $item;
        }, $data);
        $total = count($data);
        return $result = [
            "draw" => 0,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ];
        
    }
    public function delete(Request $request) {
        $id = $request->id;
        $this->model->deleteItem(['id' => $id],['task' => 'delete']);
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
    public function approve(Request $request) {
        $category = $request->category;
        $status = $request->status;
        $id = $request->id;
        $params = $request->all();
        $status = $status == 'pending' ? "active" : "pending";
        $params['id'] = $id;
        $params['category'] = $category;
        $params['success'] = true;
        $this->model->saveItem(['id' => $id, 'status' => $status],['task' => 'edit-item']);

        return $params;
    }
}
