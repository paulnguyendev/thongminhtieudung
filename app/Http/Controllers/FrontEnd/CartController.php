<?php
namespace App\Http\Controllers\FrontEnd;
use App\Helpers\Link\ProductLink;
use App\Helpers\Obn;
use App\Helpers\Package\AffiliatePackage;
use App\Helpers\Template\Product;
use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Models\ComboModel;
use App\Models\CourseModel;
use App\Models\OrderModel;
use App\Models\PaymentHistoryModel;
#Request
#Model
use App\Models\ProductModel as MainModel;
use App\Models\TaxonomyModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
#Helper
class CartController extends Controller
{
    private $pathViewController     = "frontend.pages.cart";
    private $controllerName         = "cart";
    private $model;
    private $courseModel;
    private $comboModel;
    private $taxonomyModel;
    private $orderModel;
    private $paymentHistoryModel;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->courseModel = new CourseModel();
        $this->comboModel = new ComboModel();
        $this->orderModel = new OrderModel();
        $this->paymentHistoryModel = new PaymentHistoryModel();
        View::share('controllerName', $this->controllerName);
    }
    public function add(Request $request)
    {
        $params = $request->all();
        $id = $params['pid'] ?? $request->id;
        $type = $params['type'] ?? "course";
        if ($type == 'course') {
            $item = $this->courseModel->getItem(['id' => $id], ['task' => 'id']);
        } else {
            $item = $this->comboModel->getItem(['id' => $id], ['task' => 'id']);
        }
        $slug = $item['slug'] ?? "";
        #_Check Course In Cart
        if (!$this->searchCartById($id)) {
            Cart::instance('frontend')->add([
                'id' => $id,
                'name' => $item['title'],
                'qty' => '1',
                'price' => $item['price'],
                'options' => [
                    'thumbnail' => $item['thumbnail'],
                    'type' => $type,
                    'slug' => $slug,
                ]
            ]);
        }
        $number = $request->number;
        $cartData = Cart::instance('frontend')->content();
        $cartTotal = Cart::instance('frontend')->count();
        $content = view('frontend.pages.ajax.cart')->with('')->render();
        $result = [
            'result' => true,
            'content' => $content,
            'totalCount' => $cartTotal,
            'cartData' => $cartData,
            'cartTotal' => $cartTotal,
        ];
        return response()->json($result);
    }
    public function index(Request $request)
    {
        $cart = Cart::instance('frontend');
        $cartCount = $cart->count();
        $cartContent = $cart->content();
        $cartTotal = $cart->total(0) . " đ";
        $cartSubTotal = $cart->subtotal(0);
        return view(
            "{$this->pathViewController}/index",
            [
                'cartTotal' => $cartTotal,
                'cartContent' => $cartContent,
                'cartCount' => $cartCount,
                'cartSubTotal' => $cartSubTotal,
            ]
        );
    }
    public function removeAll(Request $request)
    {
        Cart::instance('frontend')->destroy();
        return Cart::instance('frontend')->content();
    }
    public function data(Request $request)
    {
        $cart = Cart::instance('frontend')->content();
        $cartTotal = Cart::instance('frontend')->count();
        if ($cartTotal > 0) {
            $cart = $cart->toArray();
        }
        $result = [];
        foreach ($cart as $key => $item) {
            $item['title'] = $item['name'];
            $result[$key] = $item;
        }
        return response()->json($result);
    }
    public function update(Request $request)
    {
        $qty = $request->qty;
        $rowId = $request->rowId;
        $cartSearch = $this->searchCartById($rowId);
        $rowId = isset($cartSearch['rowId']) ? $cartSearch['rowId'] : $rowId;
        Cart::instance('frontend')->update($rowId, $qty);
        $result = [
            'qty' => $qty,
            'rowId' => $rowId,
            'checkCart' => $rowId,
        ];
        return response()->json($result);
    }
    public function remove(Request $request)
    {
        $params = $request->all();
        $id = $params['id'];
        $rowId = $params['id'];
        $cartSearch = $this->searchCartById($id);
        $rowId = isset($cartSearch['rowId']) ? $cartSearch['rowId'] : $rowId;
        Cart::instance('frontend')->remove($rowId);
        $params['cart'] = Cart::instance('frontend')->content();
        return $params;
    }
    public function searchCartById($id)
    {
        $cart = Cart::instance('frontend')->content()->toArray();
        $result = array_filter($cart, function ($item) use ($id) {
            if ($item['id'] == $id) {
                return $item;
            }
        });
        $result = array_shift($result);
        return $result;
    }
    public function searchCartByRowId($rowId)
    {
        $cart =  Cart::instance('frontend')->content()->toArray();
        $result = array_filter($cart, function ($item) use ($rowId) {
            if ($item['rowId'] == $rowId) {
                return $item;
            }
        });
        $result = array_shift($result);
        return $result;
    }
    public function product(Request $request)
    {
        $cart =  Cart::instance('frontend')->content()->toArray();
        $ids = array_column($cart, 'id');
        if ($ids) {
            $data = $this->model->listItems(['ids' => $ids], ['task' => 'list-in-cart']);
        } else {
            $data = $this->model->listItems([], ['task' => 'list-in-cart']);
        }
        $data = $data ? $data->toArray() : [];
        $data = array_map(function ($item) {
            $item['price'] = $item['regular_price'];
            $item['discount'] = '';
            $item['is_in_stock'] = $item['in_stock'];
            $item["shipping"] = [
                "id" => "",
                "product_id" => $item['id'],
                "weight" => "0",
                "length" => "0",
                "width" => "0",
                "height" => "0"
            ];
            $item['DT_RowAttr'] = [
                'data-id' => $item['id'],
                'data-title' => $item['title'],
                'data-thumbnail' => $item['thumbnail'],
                'data-price' => $item['regular_price'],
            ];
            return $item;
        }, $data);
        $total = count($data);
        $result = [
            "draw" => 1,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data,
        ];
        return $result;
    }
    public function order(Request $request)
    {
        $order_id = null;
        $params = $request->all();
        $shoppingCart = $params['shoppingCart'];
        $products = $shoppingCart['products'];
        $user_id = $shoppingCart['user_id'];
        $products = array_map(function ($item) use ($user_id) {
            $rowId = $item['id'];
            $cartItem = $this->searchCartByRowId($rowId);
            $id = $cartItem['id'] ?? "";
            if ($id) {
                $product = $this->model::find($id);
                $point = $product['point'] ?? 0;
                $quantity = $item['quantity'] ?? 0;
                $point = $quantity * $point;
                $item['point'] = $point;
                $item['product_name'] = $product['title'] ?? "-";
            }
            if ($user_id) {
                $commision = Product::getDiscountByUser($user_id, $item['price']);
                $commision = $commision * $quantity;
                $item['commision'] = $commision;
            } else {
                $item['commision'] = 0;
            }
            return $item;
        }, $products);
        #_Total Point
        $total_point = 0;
        #_Total commission
        $total_commission = 0;
        foreach ($products as $item) {
            $total_point += $item['point'];
            $total_commission += $item['commision'];
        }
        $shoppingCart['created_at'] = date('Y-m-d H:i:s');
        $shoppingCart['products'] = $products;
        $params['shoppingCart'] = $shoppingCart;
        // $params['redirect'] = "";
        $code = config('obn.prefix.code') . Obn::generateUniqueCode();
        $params['redirect'] = route('fe_cart/order_success', ['code' => $code]);
        // Add database order
        $shoppingCart['status'] = config('obn.status.setting.order');
        $shoppingCart['code'] = $code;
        $shoppingCart['products'] = json_encode($shoppingCart['products']);
        $shoppingCart['shipping'] = json_encode($shoppingCart['shipping']);
        $shoppingCart['info_order'] = json_encode($shoppingCart['info_order']);
        $shoppingCart['info_shipping'] = json_encode($shoppingCart['info_shipping']);
        $shoppingCart['payment'] = json_encode($shoppingCart['payment']);
        $shoppingCart['total_point'] = $total_point;
        $shoppingCart['total_commission'] = $total_commission;
        $order_id = $this->orderModel->saveItem($shoppingCart, ['task' => 'add-item']);
        #_Add database payment history
        if ($order_id) {
            $params_PaymentHistory = [
                'order_id' => $order_id,
                'user_id' => $user_id,
                'total_commission' => $total_commission,
                'total_point' => $total_point,
                'status' => config('obn.status.setting.payment'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->paymentHistoryModel->saveItem($params_PaymentHistory, ['task' => 'add-item']);
        }
        Cart::instance('frontend')->destroy();
        return $params;
    }
    public function test(Request $request)
    {
        $user = User::getInfo('', 'id');
        return $user;
    }
    public function order_success(Request $request)
    {
        $code = $request->code;
        $item =  $this->orderModel->getItem(['code' => $code], ['task' => 'code']);
        $info_order = json_decode($item['info_order'], true) ?? [];
        return view(
            "{$this->pathViewController}/order_success",
            [
                'info_order' => $info_order,
                'code' => $code,
            ]
        );
    }
    public function checkout(Request $request)
    {
        $cart = Cart::instance('frontend');
        $cartCount = $cart->count();
        $cartContent = $cart->content();
        $cartTotal = $cart->total(0);
        $cartTotalNumber = $cart->total(0, "", "");
        $cartSubTotal = $cart->subtotal(0);
        #_Check affiliate
        $is_login = $request->session()->has('userInfo') ? 1 : 0;
        $aff_user_id = User::getAffInfo('aff_user_id');
        $is_affiliate = $aff_user_id ? 1 : 0;
        $root_id = User::getRootInfo('id');
        #_Get thông tin user
        $userInfo = [];
        if($is_login == 1) {
            $userInfo = User::getInfo();
        }
        $user_id = isset($userInfo['id']) ? $userInfo['id'] : "";
        $parent_id = isset($userInfo['parent_id']) ? $userInfo['parent_id'] : $root_id;
        $discountPercent = 20;
        $discount = 0;
        $total = $cartTotalNumber;
        $totalShow = Obn::showPrice($total);
        $createdInfo = $request->session()->has('userInfo') ? User::getInfo() : [];
        $created_by = isset($createdInfo['id']) ? $createdInfo['id'] : "";
        $createdFullname = isset($createdInfo['name']) ? $createdInfo['name'] : "";
        $createdEmail = isset($createdInfo['email']) ? $createdInfo['email'] : "";
        $createdPhone = isset($createdInfo['phone']) ? $createdInfo['phone'] : "";
        #_Test
        return view(
            "{$this->pathViewController}/checkout",
            [
                'cartTotal' => $totalShow,
                'cartCount' => $cartCount,
                'cartContent' => $cartContent,
                'discount' => $discount,
                'totalOrder' => $total,
                'is_affiliate' => $is_affiliate,
                'user_id' => $user_id,
                'created_by' => $created_by,
                'createdFullname' => $createdFullname,
                'createdEmail' => $createdEmail,
                'createdPhone' => $createdPhone,
                'parent_id' => $parent_id,
            ]
        );
    }
    public function buyNow(Request $request)
    {
        $params = $request->all();
        $id = $params['pid'];
        $type = $params['type'] ?? "course";
        if ($type == 'course') {
            $item = $this->courseModel->getItem(['id' => $id], ['task' => 'id']);
        } else {
            $item = $this->comboModel->getItem(['id' => $id], ['task' => 'id']);
        }
        $slug = $item['slug'] ?? "";
        #_Check Course In Cart
        if (!$this->searchCartById($params['pid'])) {
            Cart::instance('frontend')->add([
                'id' => $id,
                'name' => $item['title'],
                'qty' => '1',
                'price' => $item['price'],
                'options' => [
                    'thumbnail' => $item['thumbnail'],
                    'type' => $type,
                    'slug' => $slug,
                ]
            ]);
        }
        $params['redirectUrl'] = route('fe_cart/checkout');
        return $params;
    }
    public function orderTest(Request $request)
    {
        $errors = [];
        $params = $request->all();
        $result = false;
        $info_order = isset($params['info_order']) ? $params['info_order'] : [];
        $phone = isset($info_order['phone']) && !empty($info_order['phone']) ? $info_order['phone'] : "";
        $email = isset($info_order['email']) && !empty($info_order['email']) ? $info_order['email'] : "";
        $fullname = isset($info_order['fullname']) && !empty($info_order['fullname']) ? $info_order['fullname'] : "";
        $address = isset($info_order['address']) && !empty($info_order['address']) ? $info_order['address'] : "";
        $orders = $this->orderModel->listItems([], ['task' => 'list'])->toArray();
        $params['orders'] = $orders;
        $order_info_order_phone = [];
        $phones = [];
        $emails = [];
        foreach ($orders as $order) {
            $order_info_order = isset($order['info_order']) ? json_decode($order['info_order'], true) : [];
            $phones[] = isset($order_info_order['phone']) ? $order_info_order['phone'] : "";
            $emails[] = isset($order_info_order['email']) ? $order_info_order['email'] : "";
        }
        if (!$phone) {
            $errors['paymentform-phone_number'] = "Chưa nhập số điện thoại";
        } else {
            if (in_array($phone, $phones) && !$request->session()->has('userInfo')) {
                $errors['paymentform-phone_number'] = "Số điện thoại đã tồn tại trên hệ thống";
            }
        }
        if (!$email) {
            $errors['paymentform-email'] = "Chưa nhập email";
        } else {
            if (in_array($email, $emails) && !$request->session()->has('userInfo')) {
                $errors['paymentform-email'] = "Email đã tồn tại trên hệ thống";
            }
        }
        if (!$fullname) {
            $errors['paymentform-contact_name'] = "Chưa nhập Họ tên";
        }
        if (!$address) {
            $errors['paymentform-street_address'] = "Chưa nhập địa chỉ";
        }
        $cart = Cart::instance('frontend');
        $cartContent = $cart->content()->toArray();
        $user_id = $params['user_id'];
        $products = array_map(function ($item) use ($user_id) {
            $commisionDirect = AffiliatePackage::getCommissionDirect($user_id);
            $price = $item['price'] ?? 0;
            $commision = round($price * $commisionDirect / 100);
            $item['commision'] = $commision;
            $item['quantity'] = $item['qty'];
            $item['thumbnail'] = isset($item['options']['thumbnail']) ? $item['options']['thumbnail'] : "";
            $item['type'] = isset($item['options']['type']) ? $item['options']['type'] : "";
            return $item;
        }, $cartContent);
        $total = $cart->total(0);
        $subtotal = $cart->subtotal(0, '', '');
        $code = config('obn.prefix.code') . Obn::generateUniqueCode();
        $status = config('obn.status.setting.payment');
        #_Total commission
        $total_commission = 0;
        foreach ($products as $item) {
            $total_commission += $item['commision'];
        }
        $params['products'] = $products;
        $params['subtotal']  =  $subtotal;
        $params['code']  =  $code;
        $params['status']  =  $status;
        $params['total_commission']  =  $total_commission;
        $params['discount']  =  0;
        $params['products'] = json_encode($params['products']);
        $params['info_order'] = json_encode($params['info_order']);
        $params['payment'] = json_encode($params['payment']);
        $params['created_at'] = date('Y-m-d H:i:s');
        if (empty($errors)) {
            $order_id = $this->orderModel->saveItem($params, ['task' => 'add-item']);
            $result = true;
            Cart::instance('frontend')->destroy();
        }
        $params['errors'] = $errors;
        $params['result'] = $result;
        $params['redirectUrl'] = route('fe_cart/order_success', ['code' => $code]);
        return $params;
    }
    public function removeCookie(Request $request)
    {
        if (Cookie::has('aff_user_id')) {
            $cookie = Cookie::forget('aff_user_id');
            return Response::make('cookie has bee deleted')->withCookie($cookie);
        }
    }
}
