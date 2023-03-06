<?php

namespace App\Http\Controllers\User;

use App\Helpers\Link\OrderLink;
use App\Helpers\Obn;
use App\Helpers\Template\Product;
use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\OrderModel as MainModel;
use App\Models\TaxonomyModel;
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class OrderController extends Controller
{
    private $pathViewController     = "user.pages.order";
    private $controllerName         = "order";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->productMetaModel = new ProductMetaModel();
        $this->userModel = new UserModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        return view(
            "{$this->pathViewController}/index",
            []
        );
    }
    public function dataList(Request $request)
    {
        $result = [];
        $user_id = User::getInfo('', 'id');
        $items = $this->model->listItems(['user_id' => $user_id], ['task' => 'created_by']);
        $total = count($items);
        $items = $total > 0 ? $items->toArray() : [];
        $items =  array_map(function ($item) {
            $id = $item['id'];
            $item['created_at'] = date('H:i:s d/m/Y', strtotime($item['created_at']));
            $order = $this->model::find($item['id']);
            $item['total'] = number_format($item['total']) . " đ";
            $item['user'] = $order->user()->first();
            $item['route_edit'] = OrderLink::detail($id);
            #_Status
            $status = $item['status'];
            $status = $status ? $status : 'default';
            $tpl_status = config('obn.status.template');
            $current_status = isset($tpl_status[$status]) ? $tpl_status[$status] : $tpl_status['default'];
            $xhtml_status = sprintf('<span class = "badge %s">%s</span>', $current_status['class'], $current_status['name']);
            $item['status'] = $xhtml_status;
            #_Payment
            $payment = json_decode($item['payment'], true);
            $payment_name =  isset($payment['method_title']) ? $payment['method_title'] : "-";
            $item['payment'] = $payment_name;
            #_Info Order
            $info_order = json_decode($item['info_order'], true);
            $fullname = isset($info_order['fullname']) ? $info_order['fullname'] : "-";
            $phone = isset($info_order['phone']) ? $info_order['phone'] : "-";
            $item['info_order'] = "{$fullname} <br> <small>Điện thoại: <a href = 'tel:{$phone}'>{$phone}</a></small>";
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
    public function destroyMulti(Request $request)
    {
        $result = [];
        return $result;
    }
    public function detail(Request $request)
    {
        $id = $request->id;
        $item = [];
        $products = [];
        $payment = [];
        $orderSum = 0;
        $item = $this->model::find($id);
        if ($item) {
            $status = $item['status'] ?? "";
            $payment = json_decode($item['payment'], true) ?? [];
            $info_order = json_decode($item['info_order'], true) ?? [];
            $info_shipping = json_decode($item['info_shipping'], true) ?? [];
            $products = json_decode($item['products'], true) ?? [];
            $shipping = json_decode($item['shipping'], true) ?? [];
            $shippingFee = $shipping['fee'] ?? 0;
            $total = $item['total'] ?? 0;
            $discount = $item['discount'] ?? 0;
            $orderSum = Product::getOrderSumary($total, [
                'add' => [$shippingFee],
                'minus' => [$discount],
            ]);
            $payment_status = $payment['status'] ?? "";
            $method_title = $payment['method_title'] ?? "";
            return view(
                "{$this->pathViewController}/detail",
                [
                    'id' => $id,
                    'item' => $item,
                    'products' => $products,
                    'orderSum' => $orderSum,
                    'status' => $status,
                    'payment' => $payment,
                    'payment_status' => $payment_status,
                    'shippingFee' => $shippingFee,
                    'method_title' => $method_title,
                    'info_order' => $info_order,
                    'info_shipping' => $info_shipping,
                ]
            );
        } else {
            return redirect(route("user_order/index"))->with('status_warning', 'Đơn hàng không tồn tại');
        }
    }
    public function customer(Request $request)
    {
        return view(
            "{$this->pathViewController}/customer",
            []
        );
    }
    public function dataCustomer(Request $request)
    {
        $user_id = User::getInfo('', 'id');
        $items = $this->model->listItems(['user_id' => $user_id], ['task' => 'user_id']);
        $total = count($items);
        $items = $total > 0 ? $items->toArray() : [];
        $customers = array_column($items, 'info_order');
        $customers = array_map(function ($item) {
            $item = json_decode($item, true);
            $item['route_edit'] = "#";
            return $item;
        }, $customers);
        $result = [
            'draw' => 0,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $customers,
        ];
        return $result;
    }
    public function income(Request $request)
    {
        return view(
            "{$this->pathViewController}/income",
            []
        );
    }
    public function dataIncome(Request $request)
    {
        $user_id = User::getInfo('', 'id');
        $user =  $this->userModel::find($user_id);
        $items = $user->payment_history()->orderBy('id', 'desc')->get();
        $total = $user->payment_history()->count();
        $items = $total > 0 ? $items->toArray() : [];
        $items = array_map(function ($item) {
            $item['route_edit'] = route('user_order/detail',['id' => $item['order_id']]);
            $order = $this->model::find($item['order_id']);
            $code = $order->code;
            $order_total =  $order->total;
            $item['code'] = $code;
            $item['order_total'] = $order_total;
            $item['show_status'] = Obn::showStatus($item['status']);
            $item['show_total_commission'] = number_format($item['total_commission']) . " đ";
            $item['show_order_total'] = number_format($item['order_total']) . " đ";
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
}
