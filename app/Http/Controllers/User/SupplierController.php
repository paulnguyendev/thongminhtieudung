<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\SupplierModel as MainModel;
use App\Models\TaxonomyModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class SupplierController extends Controller
{
    private $pathViewController     = "user.pages.supplier";
    private $controllerName         = "supplier";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $id = $request->id;
        $item = $this->model::find($id);
        
        $items = $item->products()->get();
        $total = $item->products()->count();
      
        $categories = $this->taxonomyModel::withDepth()->get()->toFlatTree()->where('taxonomy', 'product_cat')->pluck('name_with_depth', 'id');
        $navbar_title = $item['name'] . " ({$total})" ?? "";
        return view(
            "{$this->pathViewController}/index",
            [
                'items' => $items,
                'categories' => $categories,
                'item' => $item,
                'total' => $total,
                'navbar_title' => $navbar_title,
            ]
        );
    }
}
