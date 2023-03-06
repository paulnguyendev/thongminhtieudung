<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\ProductModel as MainModel;
use App\Models\SupplierModel;
use App\Models\TaxonomyModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class ProductController extends Controller
{
    private $pathViewController     = "frontend.pages.product";
    private $controllerName         = "product";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->productMetaModel = new ProductMetaModel();
        $this->supplierModel = new SupplierModel();
        View::share('controllerName', $this->controllerName);
    }
    public function detail(Request $request)
    {
        $id = $request->id;
        $item = $this->model::find($id);
        if ($item) {
            $item_meta = $this->productMetaModel->getItem(['product_id' => $id], ['task' => 'product_id']);
            $item_supplier = $item->supplier()->first();
            return view(
                "{$this->pathViewController}/detail",
                [
                    'item' => $item,
                    'item_meta' => $item_meta,
                    'item_supplier' => $item_supplier,
                ]
            );
        }
        else {
            return redirect(route('home/index'));
        }
    }
    public function data(Request $request)
    {
    }
    public function category(Request $request) {
        $id = $request->id;
        $item = $this->taxonomyModel::find($id);
        $items = $item->product_ids()->get();
        $total = $item->product_ids()->count();
        return view(
            "{$this->pathViewController}/category",
            [
                'items' => $items,
                'item' => $item,
                'total' => $total,
            ]
        );
    }
    public function supplier(Request $request) {
        $id = $request->id;
        $item = $this->supplierModel ::find($id);
        $items = $item->products()->get();
        $total = $item->products()->count();
        return view(
            "{$this->pathViewController}/category",
            [
                'items' => $items,
                'item' => $item,
                'total' => $total,
            ]
        );
    }
}
