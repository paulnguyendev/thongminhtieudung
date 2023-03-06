<?php
namespace App\Http\Controllers\FrontEnd;
use App\Helpers\Link\ProductLink;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class AffiliateController extends Controller
{
    private $pathViewController     = "affiliate.pages.";
    private $controllerName         = "fe_aff";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new UserModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $code = $request->code;
        $item = $this->model->getItem(['code' => $code],['task' => 'code']);
        if($item) {
            $user_id = $item['id'];
            $time = 86400 * 30;
            Cookie::queue(Cookie::make('aff_user_id', $user_id, $time));
            $aff_number = $item['aff_number'] ?? 0;
            $aff_number = $aff_number + 1;
            $this->model->saveItem(['id' => $user_id, 'aff_number' => $aff_number],['task' => 'edit-item']);
            return redirect(route('home/index'));
        }
    }
    public  function product(Request $request) {
        $code = $request->code;
        $product_id = $request->product_id;
        $item = $this->model->getItem(['code' => $code],['task' => 'code']);
        $redirect = ProductLink::getLinkProductDetail2($product_id);
        if($item) {
            $user_id = $item['id'];
            $time = 86400 * 30;
            Cookie::queue(Cookie::make('aff_user_id', $user_id, $time));
            $aff_number = $item['aff_number'] ?? 0;
            $aff_number = $aff_number + 1;
            $this->model->saveItem(['id' => $user_id, 'aff_number' => $aff_number],['task' => 'edit-item']);
            return redirect($redirect);
        }
       
        //return redirect($redirect);
    }
    public function register(Request $request)
    {
        $code = $request->code;
        $item = $this->model->getItem(['code' => $code],['task' => 'code']);
        if($item) {
            $user_id = $item['id'];
            $time = 86400 * 30;
            Cookie::queue(Cookie::make('aff_user_code', $code, $time));
            $aff_number = $item['aff_number'] ?? 0;
            $aff_number = $aff_number + 1;
            $this->model->saveItem(['id' => $user_id, 'aff_number' => $aff_number],['task' => 'edit-item']);
            return redirect(route('auth/register'));
        }
    }
} 
