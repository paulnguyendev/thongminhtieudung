<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\User;
use App\Helpers\Order;
use App\Helpers\Package\AffiliatePackage;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\UserModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class UserController extends Controller
{
    private $pathViewController     = "admin.pages.user.";
    private $controllerName         = "admin_user";
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
        $item = $this->model::findOrFail($id);
        if ($id) {
            $title = "Chỉnh sửa";
        } else {
            $title = "Tạo mới";
        }
        $title = "Danh sách thành viên - " . $title;
        return view(
            "{$this->pathViewController}form",
            [
                'item' => $item,
                'id' => $id,
                'title' => $title,
            ]
        );
    }
    public function detail(Request $request)
    {
        $id = $request->id;
        $user = $this->model::findOrFail($id);
        $code = $user->code;
        $total_balance = AffiliatePackage::getBalance($id,'active');
        $available_balance = User::getTotalBalance($id, "available");
        $aff_link = route('fe_aff/index', ['code' => $code]);
        $level = $user['level'];
        $levelName = User::getCurrentLevel($level);
        $orders = $user->order()->get();
        $transactions = $user->transaction()->orderBy('id','desc')->get();
        $parent_id = $user['parent_id'];
        $parents = Order::getParentByParentId($parent_id);
        $parents = array_reverse($parents);
        $childs = Order::getChilds($id);
       
    
        // $item = $this->model->getItem(['id' => $id], ['task' => 'id']);
        return view(
            "{$this->pathViewController}detail",
            [
                'id' => $id,
                'total_balance' => $total_balance,
                'aff_link' => $aff_link,
                'user' => $user,
                'levelName' => $levelName,
                'orders' => $orders,
                'transactions' => $transactions,
                'parents' => $parents,
                'childs' => $childs,
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
            if (!$id) {
                $this->model->saveItem($params, ['task' => 'add-item']);
            } else {
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
        $data = [];
        $params = $request->all();
        $draw = isset($params['draw']) ? $params['draw'] : "";
        $start = isset($params['start']) ? $params['start'] : "";
        $length = isset($params['length']) ? $params['length'] : "";
        $search = isset($params['search']) ? $params['search'] : "";
        $searchValue = isset($search['value']) ? $search['value'] : "";
        if (!$searchValue) {
            $data = $this->model->listItems(['start' => $start, 'length' => $length], ['task' => 'list']);
        } else {
            $data = $this->model->listItems(['title' => $searchValue], ['task' => 'search']);
        }
        $total = count($data);
        $data  = $total > 0 ? $data->toArray() : [];
        $data = array_map(function ($item) {
            $id = $item['id'];
            $item['total_course'] = 0;
            $level_id = $item['level_id'] ?? "";
            $level = $item['level'];
            $userName = $item['name'] ?? "";
            $userPhone = $item['phone'] ?? "";
            $userEmail = $item['email'] ?? "";
            $parent_id = $item['parent_id'];
            $item['userInfo'] = User::showUserInfo($id);
            $item['parentInfo'] = User::showUserInfo($parent_id);
            $item['levelName'] = User::getCurrentLevel($level);
            $item['fullname'] = $item['name'];
            $item['route_edit'] = route('admin_user/form', ['id' => $item['id']]);
            $item['route_remove'] = route('admin_user/delete', ['id' => $id]);
            $item['route_detail'] = route('admin_user/detail', ['id' => $id]);
            $item['move_up'] = "#";
            $item['move_down'] = "#";
            $item['move_top'] = "#";
            $item['move_bottom'] = "#";
            $item['avaiable_balance'] = User::getTotalBalance($id, "avaiable");
            $item['total_balance'] = User::getTotalBalance($id);
            $code = $item['code'];
            $item['affilate_link'] = route('fe_aff/register', ['code' => $code]);
            $item['transaction']['translated_status'] = "0";
            return $item;
        }, $data);
        $total = count($data);
        return $result = [
            "draw" => 0,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ];
        return "!23";
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $this->model->deleteItem(['id' => $id], ['task' => 'delete']);
        return $id;
    }
    public function destroyMulti(Request $request)
    {
        $ids = $request->ids;
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $this->model->deleteItem(['id' => $id], ['task' => 'delete']);
            }
        }
        return $ids;
    }
    public function updateLevel(Request $request) {
        $items = $this->model->listItems([],['task' => 'list'])->toArray();
        foreach ($items as $item) {
            $user_id = $item['id'];
            $checkAffiliate = AffiliatePackage::checkAffiliate($user_id);
            $updateLevel = AffiliatePackage::updateLevel2($user_id);
        }
    }
}
