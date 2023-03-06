<?php
use App\Http\Controllers\Admin\AffiliateController as AdminAffiliateController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\BunnyController;
use App\Http\Controllers\Admin\ComboController as AdminComboController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FrontEnd\AffiliateController;
use App\Http\Controllers\FrontEnd\CartController as FrontEndCartController;
use App\Http\Controllers\FrontEnd\ComboController;
use App\Http\Controllers\FrontEnd\CourseController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\BotController;
use App\Http\Controllers\FrontEnd\ProductController as FrontEndProductController;
use App\Http\Controllers\FrontEnd\PostController as FrontEndPostController;
use App\Http\Controllers\FrontEnd\TeacherController as FrontEndTeacherController;
use App\Http\Controllers\User\AffiliateController as UserAffiliateController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CourseController as UserCourseController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\SupplierController as UserSupplierController;
use App\Http\Controllers\User\TicketController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\EventListener\ProfilerListener;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// HomePage
$prefix = config('obn.prefix.homepage');
Route::prefix($prefix)->group(function () {
    $routeName = "home";
    Route::controller(HomeController::class)->group(function () use ($routeName) {
        Route::get('/', 'index')->name($routeName . '/index');
        Route::get('/subBanner', 'subBanner')->name($routeName . '/subBanner');
    });
    Route::prefix('cart')->group(function () {
        $routeName = "fe_cart";
        Route::controller(FrontEndCartController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/data', 'data')->name($routeName . '/data');
            Route::get('/product', 'product')->name($routeName . '/product');
            Route::get('/add/{id?}/{number?}', 'add')->name($routeName . '/add');
            Route::get('/update/{id?}/{number?}', 'update')->name($routeName . '/update');
            Route::get('/remove/{id?}/{number?}', 'remove')->name($routeName . '/remove');
            Route::get('/removeAll', 'removeAll')->name($routeName . '/removeAll');
            Route::get('/test', 'test')->name($routeName . '/test');
            Route::post('/order', 'order')->name($routeName . '/order');
            Route::post('/orderTest', 'orderTest')->name($routeName . '/orderTest');
            Route::post('/buyNow', 'buyNow')->name($routeName . '/buyNow');
            Route::get('/thanh-toan', 'checkout')->name($routeName . '/checkout');
            Route::get('/removeCookie', 'removeCookie')->name($routeName . '/removeCookie');
            Route::get('/order-success/{code?}', 'order_success')->name($routeName . '/order_success');
        });
    });
    Route::prefix('product')->group(function () {
        $routeName = "fe_product";
        Route::controller(FrontEndProductController::class)->group(function () use ($routeName) {
            Route::get('/{id?}', 'detail')->name($routeName . '/detail');
            Route::get('/category/{id?}', 'category')->name($routeName . '/category');
            Route::get('/supplier/{id?}', 'supplier')->name($routeName . '/supplier');
        });
    });
    Route::prefix('post')->group(function () {
        $routeName = "fe_post";
        Route::controller(FrontEndPostController::class)->group(function () use ($routeName) {
            Route::get('/{slug?}', 'detail')->name($routeName . '/detail');
        });
    });
    Route::prefix('course')->group(function () {
        $routeName = "fe_course";
        Route::controller(CourseController::class)->group(function () use ($routeName) {
            Route::get('/{slug?}', 'detail')->name($routeName . '/detail');
            Route::get('/category/{slug?}', 'category')->name($routeName . '/category');
            Route::get('/supplier/{id?}', 'supplier')->name($routeName . '/supplier');
            Route::get('/ajax/listCourse', 'listCourse')->name($routeName . '/listCourse');
            Route::get('/ajax/search', 'search')->name($routeName . '/search');
        });
    });
    Route::prefix('giang-vien')->group(function () {
        $routeName = "fe_teacher";
        Route::controller(FrontEndTeacherController::class)->group(function () use ($routeName) {
            Route::get('/{slug?}', 'detail')->name($routeName . '/detail');
        });
    });
    Route::prefix('combo')->group(function () {
        $routeName = "fe_combo";
        Route::controller(ComboController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/{slug?}', 'detail')->name($routeName . '/detail');
            Route::get('/ajax/listCourse', 'listCourse')->name($routeName . '/listCourse');
        });
    });
    Route::prefix('aff')->group(function () {
        $routeName = "fe_aff";
        Route::controller(AffiliateController::class)->group(function () use ($routeName) {
            Route::get('/{code?}', 'index')->name($routeName . '/index');
            Route::get('/{code?}/register', 'register')->name($routeName . '/register');
            Route::get('/{code?}/product/{product_id?}', 'product')->name($routeName . '/product');
        });
    });
    Route::prefix('bot')->group(function () {
        $routeName = "fe_bot";
        Route::controller(BotController::class)->group(function () use ($routeName) {
            Route::get('/updateLevel', 'updateLevel')->name($routeName . '/updateLevel');
        });
    });
    // Route::controller(HomeController::class)->group(function () use ($routeName) {
    //     Route::get('/aff/{?username}', 'index')->name($routeName . '/index');
    // });
});
// User
$prefix = config('obn.prefix.user');
// ::middleware('access.userDashboard')
Route::middleware('access.userDashboard')->prefix($prefix)->group(function () {
    $routeName = "user";
    Route::controller(DashboardController::class)->group(function () use ($routeName) {
        Route::get('/', 'index')->name($routeName . '/index');
        Route::get('/test', 'test')->name($routeName . '/test');
        Route::get('/seniority', 'seniority')->name($routeName . '/seniority');
    });
    Route::prefix('profile')->group(function () {
        $routeName = "user_profile";
        Route::controller(UserProfileController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form', 'form')->name($routeName . '/form');
            Route::post('/save', 'save')->name($routeName . '/save');
        });
    });
    Route::prefix('supplier')->group(function () {
        $routeName = "user_supplier";
        Route::controller(UserSupplierController::class)->group(function () use ($routeName) {
            Route::get('/{id?}', 'index')->name($routeName . '/index');
        });
    });
    Route::prefix('product')->group(function () {
        $routeName = "user_product";
        Route::controller(UserProductController::class)->group(function () use ($routeName) {
            Route::get('/{id?}', 'detail')->name($routeName . '/detail');
        });
    });
    Route::prefix('cart')->group(function () {
        $routeName = "cart";
        Route::controller(CartController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/data', 'data')->name($routeName . '/data');
            Route::get('/product', 'product')->name($routeName . '/product');
            Route::get('/add/{id?}/{number?}', 'add')->name($routeName . '/add');
            Route::get('/update/{id?}/{number?}', 'update')->name($routeName . '/update');
            Route::get('/remove/{id?}/{number?}', 'remove')->name($routeName . '/remove');
            Route::get('/removeAll', 'removeAll')->name($routeName . '/removeAll');
            Route::get('/test', 'test')->name($routeName . '/test');
            Route::post('/order', 'order')->name($routeName . '/order');
        });
    });
    Route::prefix('order')->group(function () {
        $routeName = "user_order";
        Route::controller(OrderController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::get('/customer', 'customer')->name($routeName . '/customer');
            Route::get('/dataCustomer', 'dataCustomer')->name($routeName . '/dataCustomer');
            Route::get('/income', 'income')->name($routeName . '/income');
            Route::get('/dataIncome', 'dataIncome')->name($routeName . '/dataIncome');
            Route::get('/detail/{id?}', 'detail')->name($routeName . '/detail');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
        });
    });
    Route::prefix('aff')->group(function () {
        $routeName = "user_aff";
        Route::controller(UserAffiliateController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form', 'form')->name($routeName . '/form');
            Route::get('/commission/{status?}', 'commission')->name($routeName . '/commission');
            Route::get('/withdraw', 'withdraw')->name($routeName . '/withdraw');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::get('/dataCommissionList', 'dataCommissionList')->name($routeName . '/dataCommissionList');
            Route::post('/save', 'save')->name($routeName . '/save');
        });
    });
    Route::prefix('ticket')->group(function () {
        $routeName = "user_ticket";
        Route::controller(TicketController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::post('/save', 'save')->name($routeName . '/save');
        });
    });
    Route::prefix('course')->group(function () {
        $routeName = "user_course";
        Route::controller(UserCourseController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/detail/{slug?}/{lesson_id?}', 'detail')->name($routeName . '/detail');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::post('/save', 'save')->name($routeName . '/save');
        });
    });
});
// Admin
$prefix = config('obn.prefix.admin');
Route::middleware('access.adminDashboard')->prefix($prefix)->group(function () {
    $routeName = "admin";
    Route::controller(AdminDashboardController::class)->group(function () use ($routeName) {
        Route::get('/', 'index')->name($routeName . '/index');
    });
    Route::prefix('product-category')->group(function () {
        $routeName = "productCategory";
        Route::controller(ProductCategoryController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('course-category')->group(function () {
        $routeName = "admin_courseCategory";
        Route::controller(CourseCategoryController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('supplier')->group(function () {
        $routeName = "supplier";
        Route::controller(SupplierController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('product')->group(function () {
        $routeName = "product";
        Route::controller(ProductController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::patch('/updateField/{id?}', 'updateField')->name($routeName . '/updateField');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::delete('/destroyMulti', 'destroyMulti')->name($routeName . '/destroyMulti');
        });
    });
    Route::prefix('teacher')->group(function () {
        $routeName = "admin_teacher";
        Route::controller(TeacherController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('level')->group(function () {
        $routeName = "admin_level";
        Route::controller(LevelController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('affiliate')->group(function () {
        $routeName = "admin_affiliate";
        Route::controller(AdminAffiliateController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/payment', 'income')->name($routeName . '/income');
            Route::get('/setting', 'setting')->name($routeName . '/setting');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('transaction')->group(function () {
        $routeName = "admin_transaction";
        Route::controller(AdminTransactionController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
            Route::post('/approve/{category}/{status}/{id?}', 'approve')->name($routeName . '/approve');
        });
    });
    Route::prefix('user')->group(function () {
        $routeName = "admin_user";
        Route::controller(UserController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/updateLevel/{token?}', 'updateLevel')->name($routeName . '/updateLevel');
            Route::get('/detail/{id?}', 'detail')->name($routeName . '/detail');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::delete('/destroy-multi/{id?}', 'destroyMulti')->name($routeName . '/destroy-multi');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
    Route::prefix('course')->group(function () {
        $routeName = "admin_course";
        Route::controller(AdminCourseController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::patch('/updateField/{id?}', 'updateField')->name($routeName . '/updateField');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::delete('/destroyMulti', 'destroyMulti')->name($routeName . '/destroyMulti');
        });
    });
    Route::prefix('combo')->group(function () {
        $routeName = "admin_combo";
        Route::controller(AdminComboController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::patch('/updateField/{id?}', 'updateField')->name($routeName . '/updateField');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::delete('/destroyMulti', 'destroyMulti')->name($routeName . '/destroyMulti');
        });
    });
    Route::prefix('post')->group(function () {
        $routeName = "admin_post";
        Route::controller(PostController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::patch('/updateField/{id?}', 'updateField')->name($routeName . '/updateField');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::delete('/destroyMulti', 'destroyMulti')->name($routeName . '/destroyMulti');
        });
    });
    Route::prefix('lesson')->group(function () {
        $routeName = "admin_lesson";
        Route::controller(LessonController::class)->group(function () use ($routeName) {
            Route::get('/', 'index')->name($routeName . '/index');
            Route::get('course/{course_id}/', 'course_index')->name($routeName . '/course_index');
            Route::get('course/{course_id}/form/{id?}', 'course_form')->name($routeName . '/course_form');
            Route::get('/form/{id?}', 'form')->name($routeName . '/form');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::patch('/updateField/{id?}', 'updateField')->name($routeName . '/updateField');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::delete('/destroyMulti', 'destroyMulti')->name($routeName . '/destroyMulti');
        });
    });
    Route::prefix('bunny')->group(function () {
        $routeName = "admin_bunny";
        Route::controller(BunnyController::class)->group(function () use ($routeName) {
            Route::post('/uploadVideo', 'uploadVideo')->name($routeName . '/uploadVideo');
        });
    });
    Route::prefix('media')->group(function () {
        $routeName = "media";
        Route::controller(MediaController::class)->group(function () use ($routeName) {
            Route::get('/folders', 'folders')->name($routeName . '/folders');
            Route::post('/action', 'action')->name($routeName . '/action');
            Route::post('/upload', 'upload')->name($routeName . '/upload');
            // Route::get('/form/{id?}', 'form')->name($routeName . '/form');
        });
    });
    Route::prefix('profile')->group(function () {
        $routeName = "admin_profile";
        Route::controller(ProfileController::class)->group(function () use ($routeName) {
            Route::get('/index', 'index')->name($routeName . '/index');
            Route::get('/form', 'form')->name($routeName . '/form');
            Route::post('/save', 'save')->name($routeName . '/save');
        });
    });
    Route::prefix('order')->group(function () {
        $routeName = "admin_order";
        Route::controller(AdminOrderController::class)->group(function () use ($routeName) {
            Route::get('/index', 'index')->name($routeName . '/index');
            Route::get('/detail/{id?}', 'detail')->name($routeName . '/detail');
            Route::get('/form', 'form')->name($routeName . '/form');
            Route::get('/activeCourse/{code?}', 'activeCourse')->name($routeName . '/activeCourse');
            Route::get('/deactiveCourse/{code?}', 'deactiveCourse')->name($routeName . '/deactiveCourse');
            Route::delete('/delete/{id?}', 'delete')->name($routeName . '/delete');
            Route::post('/save/{id?}', 'save')->name($routeName . '/save');
            Route::get('/checkUser/{id?}', 'checkUser')->name($routeName . '/checkUser');
            Route::get('/checkLevel', 'checkLevel')->name($routeName . '/checkLevel');
            Route::post('/createUser', 'createUser')->name($routeName . '/createUser');
            Route::post('/updateOrder', 'updateOrder')->name($routeName . '/updateOrder');
            Route::post('/saveActiveCourse', 'saveActiveCourse')->name($routeName . '/saveActiveCourse');
            Route::post('/saveInfo/{type?}/{id?}', 'saveInfo')->name($routeName . '/saveInfo');
            Route::delete('/destroyMulti', 'destroyMulti')->name($routeName . '/destroyMulti');
            Route::get('/dataList', 'dataList')->name($routeName . '/dataList');
            Route::get('/test', 'test')->name($routeName . '/test');
        });
    });
    Route::prefix('setting')->group(function () {
        $routeName = "admin_setting";
        Route::controller(SettingController::class)->group(function () use ($routeName) {
            Route::get('/{type?}', 'index')->name($routeName . '/index');
            Route::post('/save/{type?}', 'save')->name($routeName . '/save');
            Route::get('/data/list', 'dataList')->name($routeName . '/dataList');
        });
    });
});
// Authen User
$prefix = config('obn.prefix.auth');
Route::prefix($prefix)->group(function () {
    $routeName = "auth";
    Route::controller(AuthController::class)->group(function () use ($routeName) {
        Route::get('/login123', 'login')->name($routeName . '/login123');
        Route::get('/login', 'login')->name($routeName . '/login')->middleware('check.login');
        Route::get('/logout', 'logout')->name($routeName . '/logout');
        Route::get('/register', 'register')->name($routeName . '/register');
        Route::get('/active/{token}', 'active')->name($routeName . '/active');
        Route::post('/postRegister', 'postRegister')->name($routeName . '/postRegister');
        Route::post('/postLogin', 'postLogin')->name($routeName . '/postLogin');
        // Route::get('/active/{code}', 'active')->name($routeName . '/active')->middleware('check.statusActive');
        // Route::post('/post-active/{code}', 'postActive')->name($routeName . '/postActive')->middleware('check.statusActive');
        // Route::get('/quickLogin/{email}-{phone}', 'quickLogin')->name($routeName . '/quickLogin');
        // Route::post('/post-login', 'postLogin')->name($routeName . '/postLogin');
        // Route::post('/post-register', 'postRegister')->name($routeName . '/postRegister');
        // Route::get('/forget-password', 'forgetPassword')->name($routeName . '/forgetPassword');
        // Route::post('/post-forget-password', 'postForgetPassword')->name($routeName . '/postForgetPassword');
        // Route::get('/new-password', 'newPassword')->name($routeName . '/newPassword');
        // Route::get('/test-mail', 'testMail')->name($routeName . '/testMail');
    });
});
// Authen admin
$prefix = config('obn.prefix.admin_auth');
Route::prefix($prefix)->group(function () {
    $routeName = "admin_auth";
    Route::controller(AuthAdminController::class)->group(function () use ($routeName) {
        Route::get('/login', 'login')->name($routeName . '/login')->middleware('check.login_admin');
        Route::get('/logout', 'logout')->name($routeName . '/logout');
        Route::post('/postLogin', 'postLogin')->name($routeName . '/postLogin');
    });
});
