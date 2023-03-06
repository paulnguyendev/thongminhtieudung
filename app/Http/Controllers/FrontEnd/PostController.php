<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\PostModel as MainModel;
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
class PostController extends Controller
{
    private $pathViewController     = "frontend.pages.post";
    private $controllerName         = "fe_post";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
    }
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $item = $this->model->getItem(['slug' => $slug] ,['task' => 'slug']);
        if($item) {
            return view(
                "{$this->pathViewController}/detail",
                [
                    'item' => $item,
                  
                ]
            );
        }
        else {
            return redirect()->route('home/index');
        }
        
    }
}
