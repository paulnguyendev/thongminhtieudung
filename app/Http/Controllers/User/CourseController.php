<?php

namespace App\Http\Controllers\User;

use App\Helpers\Link\ProductLink;
use App\Helpers\Obn;
use App\Helpers\Package\CoursePackage;
use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\TeacherModel;
#Request
#Model
use App\Models\UserModel as MainModel;
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class CourseController extends Controller
{
    private $pathViewController     = "user.pages.course";
    private $controllerName         = "user_course";
    private $model;
    private $userModel;
    private $teacherModel;
    private $courseModel;
    private $lessonModel;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->userModel = new UserModel();
        $this->teacherModel = new TeacherModel();
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $navbar_title = "Danh sách thành viên";
        $user_id = User::getInfo('', 'id');
        $user = $this->model::find($user_id);
        $myCourses = $user->courseOrder()->with('courseInfo')->get()->toArray();
        $total = $user->courseOrder()->count();
        $teacherModel = $this->teacherModel;
        $courseModel = $this->courseModel;
        return view(
            "{$this->pathViewController}/index",
            [
                'navbar_title' => $navbar_title,
                'myCourses' => $myCourses,
                'total' => $total,
                'teacherModel' => $teacherModel,
                'courseModel' => $courseModel,
            ]
        );
    }
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $current_lesson_id = $request->lesson_id;
        $item = $this->courseModel->getItem(['slug' => $slug], ['task' => 'slug']);
        if ($item) {
            $id = $item['id'];
            $user_id = User::getInfo('', 'id');
            $user = $this->model::find($user_id);
            $myCourses = $user->courseOrder()->with('courseInfo')->get()->toArray();
            $checkCourse = 0;
            if (count($myCourses) > 0) {
                $myCourses_ids = array_column($myCourses, 'course_id');
                $checkCourse = in_array($id, $myCourses_ids) ? 1 : 0;
            }
            if ($checkCourse == 1) {
                $lessons = $item->lesson()->whereNull('parent_id')->withDepth()->get();
                $current_lesson = $this->lessonModel->getItem(['id' => $current_lesson_id], ['task' => 'id']);
                if($current_lesson) {
                    return view(
                        "{$this->pathViewController}/detail",
                        [
                            'slug' => $slug,
                            'lessons' => $lessons,
                            'current_lesson_id' => $current_lesson_id,
                            'current_lesson' => $current_lesson,
                        ]
                    );
                }
                else {
                    return redirect(route('user_course/index'));
                }
              
            } else {
                return redirect(route('user_course/index'));
            }
        }
        else {
            return redirect(route('user_course/index'));
        }
    }
    public function dataList(Request $request)
    {
        $result = [];
        $user_id = User::getInfo('', 'id');
        $user = $this->userModel::find($user_id);
        $items = $user->ticket()->whereNull('parent_id')->get();
        $total = count($items);
        $items = $total > 0 ? $items->toArray() : [];
        $items =  array_map(function ($item) {
            $id = $item['id'];
            $item['created_at'] = date('H:i:s d/m/Y', strtotime($item['created_at']));
            $user = $this->model::find($id);
            $item['route_edit'] = route("{$this->controllerName}/form", ['id' => $id]);
            #_Status
            $status = $item['status'];
            $status = $status ? $status : 'default';
            $tpl_status = config('obn.ticket.status');
            $current_status = isset($tpl_status[$status]) ? $tpl_status[$status] : $tpl_status['default'];
            $xhtml_status = sprintf('<span class = "badge %s">%s</span>', $current_status['class'], $current_status['name']);
            $item['status'] = $xhtml_status;
            return $item;
        }, $items);
        $result = [
            'draw' => 0,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
        ];
        return $result;
    }
    public function save(Request $request)
    {
        $params = $request->all();
        $user_id = User::getInfo('', 'id');
        $id = $request->id;
        $error = [];
        $user = [];
        $parent_id = null;
        if (isset($params['name']) && !$params['name']) {
            $error['name'] = "Chưa nhập Tiêu đề cần hỗ trợ";
        }
        if (!$params['content']) {
            $error['content'] = "Chưa nhập Nội dung cần hỗ trợ";
        }
        if (empty($error)) {
            $params['created_at'] = date('Y-m-d H:i:s');
            $params['parent_id'] = $id ? $id : NULL;
            $params['user_id'] = $user_id ??  NULL;
            $params['status'] = 'pending';
            $params['code'] = config('obn.prefix.code') . Obn::generateUniqueCode();
            $this->model->saveItem($params, ['task' => 'add-item']);
            if ($id) {
                $params['redirect'] = route("{$this->controllerName}/form", ['id' => $id]);
                session()->flash('status_success', 'Phản hồi yêu cầu thành công');
            } else {
                $params['redirect'] = route("{$this->controllerName}/index");
                session()->flash('status_success', 'Tạo yêu cầu thành công');
            }
            // $params['redirect'] = route("{$this->controllerName}/index");
            return response()->json($params);
        } else {
            return response()->json(
                $error,
                422,
            );
        }
    }
}
