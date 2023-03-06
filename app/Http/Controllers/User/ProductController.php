<?php
namespace App\Http\Controllers\User;

use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\ProductModel as MainModel;
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
    private $pathViewController     = "user.pages.product";
    private $controllerName         = "product";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->productMetaModel = new ProductMetaModel();
        View::share('controllerName', $this->controllerName);
    }
    public function detail(Request $request)
    {
        
        $id = $request->id;
        $item = $this->model::find($id);
        $item_meta = $this->productMetaModel->getItem(['product_id' => $id], ['task' => 'product_id']);
        $item_supplier = $item->supplier()->first();
        $user_code = User::getInfo('','code');
        $aff_link = route('fe_aff/product',['code' =>  $user_code ,'product_id' => $id]);
       
       
       
        return view(
            "{$this->pathViewController}/detail",
            [
              'item' => $item,
              'item_meta' => $item_meta,
              'item_supplier' => $item_supplier,
              'aff_link' => $aff_link,
            ]
        );
    }
    public function data(Request $request) {
        
    }
}
