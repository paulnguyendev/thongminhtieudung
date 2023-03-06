<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\SupplierModel;
#Request
#Model
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class DashboardController extends Controller
{
    private $pathViewController     = "admin.pages.";
    private $controllerName         = "dashboard";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new UserModel();
        $this->supplierModel = new SupplierModel();
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();

        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $totalUser = $this->model->where('role','user')->count();
        $totalSupplier = $this->supplierModel->count();
        $totalProduct =$this->productModel->count();
        $totalOrderNew = $this->orderModel->where('status','new')->count();
        return view(
            "{$this->pathViewController}dashboard",
            [
                'totalUser' => $totalUser,
                'totalSupplier' => $totalSupplier,
                'totalProduct' => $totalProduct,
                'totalOrderNew' => $totalOrderNew,
            ]
        );
    }
    public function dashboard(Request $request)
    {
        return view(
            "{$this->pathViewController}dashboard",
            []
        );
    }
}
