<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\TeacherModel as MainModel;
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
class TeacherController extends Controller
{
    private $pathViewController     = "frontend.pages.teacher";
    private $controllerName         = "fe_teacher";
    private $model;
    private $taxonomyModel;
    private $productMetaModel;
    private $supplierModel;
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
        $slug = $request->slug;
        $item = $this->model->getItem(['slug' => $slug],['task' => 'slug']);
        $teacher = [];
        $level = [];
        if($item) {
            return view(
                "{$this->pathViewController}/detail",
                [
                    'item' => $item,
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
}
