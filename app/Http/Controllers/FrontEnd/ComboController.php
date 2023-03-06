<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\ComboModel as MainModel;
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
class ComboController extends Controller
{
    private $pathViewController     = "frontend.pages.combo";
    private $controllerName         = "fe_combo";
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
        $item = $this->model->getItem(['slug' => $slug], ['task' => 'slug']);
        $courses = $item->courseList()->get();
        
        $teacher = [];
        $level = [];
        if ($item) {
            return view(
                "{$this->pathViewController}/detail",
                [
                    'item' => $item,
                    'courses' => $courses,
                ]
            );
        } else {
            return redirect(route('home/index'));
        }
    }
    public function index(Request $request)
    {
        $items = $this->model->listItems([], ['task' => 'list']);
        $total = $this->model->listItems([], ['task' => 'count']);
        return view(
            "{$this->pathViewController}/index",
            [
                'items' => $items,
                'total' => $total,
            ]
        );
    }
    public function listCourse(Request $request)
    {
        $items = [];
        $items = $this->model->listItems([], ['task' => 'list']);
        $data = view('frontend.pages.ajax.comboCourse')->with('items', $items)->render();
        return response()->json([
            'status' => [
                'code' => 200,
                'message' => "Success"
            ],
            'data' => $data
        ]);
    }
}
