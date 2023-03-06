<?php
namespace App\Http\Controllers\FrontEnd;
use App\Helpers\Package\CoursePackage;
use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Models\ComboModel;
use App\Models\ProductMetaModel;
#Request
#Model
use App\Models\CourseModel as MainModel;
use App\Models\SupplierModel;
use App\Models\TaxonomyModel;
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
    private $pathViewController     = "frontend.pages.course";
    private $controllerName         = "fe_course";
    private $model;
    private $taxonomyModel;
    private $productMetaModel;
    private $supplierModel;
    private $comboModel;
    private $userModel;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->productMetaModel = new ProductMetaModel();
        $this->supplierModel = new SupplierModel();
        $this->comboModel = new ComboModel();
        $this->userModel = new UserModel();
        View::share('controllerName', $this->controllerName);
    }
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $item = $this->model->getItem(['slug' => $slug], ['task' => 'slug']);
        $teacher = [];
        $level = [];
        $relatedCourses = [];
        $totalLesson = 0;
        $is_login = $request->session()->has('userInfo') ? 1 : 0;
        $checkCourse = 0;
        $lesson_id = null;
        if ($item) {
            $id = $item['id'];
            $teacher = $item->teacher()->first();
            $level = $item->level()->first();
            $lessons = $item->lesson()->whereNull('parent_id')->withDepth()->get();
            $combo = $item->combo()->with('comboInfo')->with('courseInfo')->get()->toArray();
            $taxonomy = $item->taxonomy()->first();
            $lessonCount = $item->totalLesson();
            $relatedCourses = $taxonomy->course_ids()->where('course_id', '!=', $id)->get();
            #_Check đăng nhập hiển thị vào lớp
            $user_id = $request->session()->has('userInfo') ? User::getInfo('','id') : "";
            if($user_id) {
                $user = $this->userModel::find($user_id);
                $myCourses = $user->courseOrder()->with('courseInfo')->get()->toArray();
                if (count($myCourses) > 0) {
                    $myCourses_ids = array_column($myCourses, 'course_id');
                    $checkCourse = in_array($id, $myCourses_ids) ? 1 : 0;
                }
                $firstLesson = CoursePackage::getFirstLesson($item['id']);
                $lesson_id = $firstLesson['id'] ?? "";
            }
           
            return view(
                "{$this->pathViewController}/detail",
                [
                    'item' => $item,
                    'teacher' => $teacher,
                    'level' => $level,
                    'lessons' => $lessons,
                    'combo' => $combo,
                    'relatedCourses' => $relatedCourses,
                    'lessonCount' => $lessonCount,
                    'checkCourse' => $checkCourse,
                    'lesson_id' => $lesson_id,
                ]
            );
        } else {
            return redirect(route('home/index'));
        }
        // $item = $this->model::find($id);
        // if ($item) {
        //     $item_meta = $this->productMetaModel->getItem(['product_id' => $id], ['task' => 'product_id']);
        //     $item_supplier = $item->supplier()->first();
        // }
        // else {
        //     return redirect(route('home/index'));
        // }
    }
    public function data(Request $request)
    {
    }
    public function category(Request $request)
    {
        $slug = $request->slug;
        $q = $request->q;
      
        $childs = [];
        $coursesList = [];
        $courses = null;
        $coursesTotal = 0;
        if (!$q) {
            if($slug == 'all') {
                $item['name']  = "tại RPA";
                $coursesList = $this->model->listItems([] , ['task' => 'list']);
                $coursesTotal = count($coursesList);
                return view(
                    "{$this->pathViewController}/category",
                    [
                        'item' => $item,
                        'childs' => $childs,
                        'coursesList' => $coursesList,
                        'coursesTotal' => $coursesTotal,
                    ]
                );
            }
            $item = $this->taxonomyModel->getItem(['slug' => $slug], ['task' => 'slug']);
            if ($item) {
                $id = $item['id'];
                $childs = $item::defaultOrder()->descendantsOf($id);
                $courses = $item->course_ids();
                $coursesList = $courses->get();
                $coursesTotal = $courses->count();
                return view(
                    "{$this->pathViewController}/category",
                    [
                        'item' => $item,
                        'childs' => $childs,
                        'coursesList' => $coursesList,
                        'coursesTotal' => $coursesTotal,
                    ]
                );
            } else {
                return redirect(route('home/index'));
            }
        } else {
            $coursesList = $this->model->listItems(['searchText' => $q], ['task' => 'liveSearch']);
            $coursesTotal = count($coursesList);
            $item['name'] = "Từ khóa:  " . $q;
            return view(
                "{$this->pathViewController}/category",
                [
                    'item' => $item,
                    'childs' => $childs,
                    'coursesList' => $coursesList,
                    'coursesTotal' => $coursesTotal,
                ]
            );
        }
    }
    public function supplier(Request $request)
    {
        $id = $request->id;
        $item = $this->supplierModel::find($id);
        $items = $item->products()->get();
        $total = $item->products()->count();
        return view(
            "{$this->pathViewController}/category",
            [
                'items' => $items,
                'item' => $item,
                'total' => $total,
            ]
        );
    }
    public function listCourse(Request $request)
    {
        $items = [];
        $type = $request->type;
        $is_free = $request->is_free ?? 0;
        $sliderClass = $is_free == 0 ? "course-exclusive__slider"  : "free-course__slider";
        $title  = $is_free == 0 ? "Khóa học tại RPA"  : "Khóa học 0đ";
        $desc = $is_free == 0 ? "Trải nghiệm học tập mới với các khóa học chất lượng cao được lựa chọn bởi đội ngũ chuyên gia của RPA."  : "";
        $items = ($type == 'combo') ? $this->comboModel->listItems([], ['task' => 'list']) : $this->model->listItems(['is_free' => $is_free], ['task' => 'list']);
        $data = ($type  == 'combo') ? view('frontend.pages.ajax.comboCourse')->with('items', $items)->render()  : view('frontend.pages.ajax.wowCourse')->with(['items' => $items,'title' => $title,'desc' => $desc,'sliderClass' => $sliderClass])->render();
        $data = ($is_free  == 0 ) ? $data  : view('frontend.pages.ajax.freeCourse')->with(['items' => $items,'title' => $title,'desc' => $desc])->render();
        return response()->json([
            'status' => [
                'code' => 200,
                'message' => "Success"
            ],
            'data' => $data,
            'total' => count($items)
        ]);
    }
    public function search(Request $request)
    {
        $searchText = $request->searchText;
        $data = $this->model->listItems(['searchText' => $searchText], ['task' => 'liveSearch'])->toArray();
        $data = array_map(function ($item) {
            $item['name'] = $item['title'] ?? "-";
            $item['highlight_name'] = $item['title'] ?? "-";
            $item['teacher_name'] = "Test teacher";
            $item['highlight_teacher_name'] = "Test teacher";
            $item['url'] = route('fe_course/detail',['slug' => $item['slug']]);
            return $item;
        }, $data);
        $result = [
            "data" => $data
        ];
        return $result;
    }
}
