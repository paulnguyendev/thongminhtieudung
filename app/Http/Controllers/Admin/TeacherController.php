<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\TeacherModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class TeacherController extends Controller
{
    private $pathViewController     = "admin.pages.teacher.";
    private $controllerName         = "admin_teacher";
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
            $error['title'] = "Chưa nhập tên giáo viên";
        }
        if (!$params['position']) {
            $error['position'] = "Chưa nhập tên chức vụ";
        }
        if (empty($error)) {
            $params['created_at'] = date('Y-m-d H:i:s');
            if(!$id) {
                $this->model->saveItem($params, ['task' => 'add-item']);
            }
            else {
                $this->model->saveItem($params, ['task' => 'edit-item']);
            }
          
            $params['redirect'] = route('admin_teacher/index');
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
            $item['total_course'] = 0;
           
            $item['route_edit'] = route('admin_teacher/form',['id' => $item['id']]);
            $item['route_remove'] = route('admin_teacher/delete',['id' => $id]);
            $item['move_up'] = "#";
            $item['move_down'] = "#";
            $item['move_top'] = "#";
            $item['move_bottom'] = "#";
            return $item;
        }, $categories);
        $total = count($categories);
      
        // [
        //     "id" => "297",
        //     "parent_id" => "0",
        //     "taxonomy" => "product",
        //     "sort_order" => "0",
        //     "thumbnail" => "",
        //     "description" => [
        //         "title" => "Dự án",
        //         "cat_id" => "297",
        //         "lang_code" => "vi"
        //     ],
        //     "seo" => [
        //         "id" => "1040",
        //         "slug" => "du-an",
        //         "robots" => "1",blank
        //         "taxonomy_type" => "category",
        //         "taxonomy_id" => "297",
        //         "lang_code" => "vi",
        //         "meta_title" => "Dự án",
        //         "meta_keyword" => "Dự án",
        //         "meta_description" => "Mô tả trang Dự án",
        //         "other_link" => "",
        //         "is_newtab_other_link" => ""
        //     ],
        //     "depth" => "0",
        //     "route_edit" => "https://dainghiagroup.com/admin/product/category/297/edit",
        //     "route_remove" => "https://dainghiagroup.com/admin/product/category/297",
        //     "move_up" => "https://dainghiagroup.com/admin/product/category/297/move?direction=up",
        //     "move_down" => "https://dainghiagroup.com/admin/product/category/297/move?direction=down",
        //     "move_top" => "https://dainghiagroup.com/admin/product/category/297/move?direction=top",
        //     "move_bottom" => "https://dainghiagroup.com/admin/product/category/297/move?direction=bottom"
        // ]
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
