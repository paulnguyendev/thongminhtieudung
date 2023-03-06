<?php
namespace App\Http\Controllers\User;
use App\Helpers\Link\ProductLink;
use App\Helpers\Obn;
use App\Helpers\Template\Product;
use App\Helpers\User;
use App\Http\Controllers\Controller;
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
#Helper
class CartController extends Controller
{
    private $pathViewController     = "user.pages.cart";
    private $controllerName         = "cart";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->orderModel = new OrderModel();
        $this->paymentHistoryModel = new PaymentHistoryModel();
        View::share('controllerName', $this->controllerName);
    }
    public function add(Request $request)
    {
        $id = $request->id;
        $product = $this->model::find($id);
        if ($product) {
            $name = isset($product['title']) ? $product['title'] : "";
            $thumbnail = isset($product['thumbnail']) ? $product['thumbnail'] : "";
            $thumbnail = Obn::showThumbnail($thumbnail);
            $number = $request->number;
            $price = Product::getPriceProduct($product['regular_price'], false);
            $price = $price ? $price : 0;
          
            $supplier = $product->supplier()->first();
            if ($supplier) {
                $supplierName = $supplier['name'] ?? "-";
                $supplierAddress = $supplier['address'] ?? "-";
                $productLink = ProductLink::getLinkProductDetail($id);
                $name = "<div class = 'supplier-name'>{$supplierName} [{$supplierAddress}]</div> 
                <div class = 'product-name'> <a href = '{$productLink}'>{$name}</a> </div> ";
            }
            if (!$number) {
                $number = 1;
            }
            Cart::add([
                'id' => $id,
                'name' => $name,
                'qty' => $number,
                'price' => $price,
                'options' => [
                    'thumbnail' => $thumbnail,
                ]
            ]);
        }
        $cartData = Cart::content();
        $cartTotal = Cart::count();
        $result = [
            'cartData' => $cartData,
            'cartTotal' => $cartTotal,
        ];
        return response()->json($result);
    }
    public function index(Request $request)
    {
        return view(
            "{$this->pathViewController}/index",
            []
        );
    }
    public function removeAll(Request $request)
    {
        Cart::destroy();
        return Cart::content();
    }
    public function data(Request $request)
    {
        $cart = Cart::content();
        $cartTotal = Cart::count();
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
        Cart::update($rowId, $qty);
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
        Cart::remove($rowId);
        return $params;
    }
    public function searchCartById($id)
    {
        $cart = Cart::content()->toArray();
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
        $cart = Cart::content()->toArray();
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
        $cart = Cart::content()->toArray();
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
            if($id) {
                $product = $this->model::find($id);
                $point = $product['point'] ?? 0;
                $quantity = $item['quantity'] ?? 0;
                $point = $quantity * $point;
                $item['point'] = $point;
                $item['product_name'] = $product['title'] ?? "-";

            }
            $commision = Product::getDiscountByUser($user_id, $item['price']);
            $commision = $commision * $quantity;
            $item['commision'] = $commision;
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
        $params['redirect'] = route('user_order/index');
       
        // Add database order
        $shoppingCart['status'] = config('obn.status.setting.order');
        $shoppingCart['code'] = config('obn.prefix.code') . Obn::generateUniqueCode();
        $shoppingCart['products'] = json_encode($shoppingCart['products']);
        $shoppingCart['shipping'] = json_encode($shoppingCart['shipping']);
        $shoppingCart['info_order'] = json_encode($shoppingCart['info_order']);
        $shoppingCart['info_shipping'] = json_encode($shoppingCart['info_shipping']);
        $shoppingCart['payment'] = json_encode($shoppingCart['payment']);
        $shoppingCart['total_point'] = $total_point;
        $shoppingCart['total_commission'] = $total_commission;
        $order_id = $this->orderModel->saveItem($shoppingCart, ['task' => 'add-item']);
        #_Add database payment history
        if($order_id) {
            $params_PaymentHistory = [
                'order_id' => $order_id,
                'user_id' => $user_id,
                'total_commission' => $total_commission,
                'total_point' => $total_point,
                'status' => config('obn.status.setting.payment'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->paymentHistoryModel->saveItem($params_PaymentHistory,['task' => 'add-item' ]);
        }
       
        Cart::destroy();
        return $params;
    }
    public function test(Request $request)
    {
        $user = User::getInfo('', 'id');
        return $user;
    }
}
