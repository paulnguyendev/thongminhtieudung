<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\LevelModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class LevelController extends Controller
{
    private $pathViewController     = "admin.pages.level.";
    private $controllerName         = "admin_level";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        return view(
            "{$this->pathViewController}index",
            []
        );
    }
    public function form(Request $request)
    {
        $id = $request->id;
        $item = $this->model->getItem(['id' => $id],['task' => 'id']);
        return view(
            "{$this->pathViewController}form",
            [
                'item' => $item,
                'id' => $id,
            ]
        );
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $id = $request->id;
        $error = [];
        if (!$params['title']) {
            $error['title'] = "Chưa nhập tên level";
        }
        if (empty($error)) {
            $params['created_at'] = date('Y-m-d H:i:s');
            if(!$id) {
                $this->model->saveItem($params, ['task' => 'add-item']);
            }
            else {
                $this->model->saveItem($params, ['task' => 'edit-item']);
            }
            $params['redirect'] = route('admin_level/index');
            return response()->json($params);
        } else {
            return response()->json(
                $error,
                422,
            );
        }
    }
    public function dataList(Request $request)
    {
        $search = $request->search;
        $searchValue = isset($search['value']) ? $search['value'] : "";
        if(!$searchValue) {
            $categories = $this->model->listItems([],['task' => 'list'])->toArray();
        }
        else {
            $categories  = $this->model->listItems(['title' => $searchValue],['task' => 'search'])->toArray();
        }
        $categories = array_map(function ($item) {
            $id = $item['id'];
            $item['description'] = [
                'title' => $item['title'],
                'cat_id' => $item['id'],
                'lang_code' => 'vi'
            ];
            $item['route_edit'] = route('admin_level/form',['id' => $item['id']]);
            $item['route_remove'] = route('admin_level/delete',['id' => $id]);
            $item['move_up'] = "#";
            $item['move_down'] = "#";
            $item['move_top'] = "#";
            $item['move_bottom'] = "#";
            return $item;
        }, $categories);
        $total = count($categories);
        return $result = [
            "draw" => 0,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $categories
        ];
        return "!23";
    }
    public function delete(Request $request) {
        $id = $request->id;
        $this->model->deleteItem(['id' => $id],['task' => 'delete']);
        return $id;
    }
    public function destroyMulti(Request $request) {
        $ids = $request->ids;
        if(count($ids) > 0) {
            foreach ($ids as $id) {
                $this->model->deleteItem(['id' => $id],['task' => 'delete']);
            }
        }
        return $ids;
    }
}
