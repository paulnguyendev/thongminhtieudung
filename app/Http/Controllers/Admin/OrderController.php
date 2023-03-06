<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Link\OrderLink;
use App\Helpers\Notify;
use App\Helpers\Obn;
use App\Helpers\Order;
use App\Helpers\Package\AffiliatePackage;
use App\Helpers\Template\Count;
use App\Helpers\Template\Product;
use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Models\ComboModel;
use App\Models\OrderCourseUserModel;
use App\Models\ProductMetaModel;
use App\Models\AffiliateLevelModel;
use App\Models\TransactionModel;
#Request
#Model
use App\Models\OrderModel as MainModel;
use App\Models\TaxonomyModel;
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class OrderController extends Controller
{
    private $pathViewController     = "admin.pages.order";
    private $controllerName         = "admin_order";
    private $model;
    private $taxonomyModel;
    private $productMetaModel;
    private $userModel;
    private $comboModel;
    private $orderCourseUserModel;
    private $levelModel;
    private $transactionModel;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        $this->taxonomyModel = new TaxonomyModel();
        $this->productMetaModel = new ProductMetaModel();
        $this->userModel = new UserModel();
        $this->comboModel = new ComboModel();
        $this->orderCourseUserModel = new OrderCourseUserModel();
        $this->levelModel = new AffiliateLevelModel();
        $this->transactionModel = new TransactionModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $orderNew = Count::countOrder('new');
        $orderConfirm = Count::countOrder('confirm');
        $orderShipping = Count::countOrder('shipping');
        $orderComplete = Count::countOrder('complete');
        return view(
            "{$this->pathViewController}/index",
            [
                'orderNew' => $orderNew,
                'orderConfirm' => $orderConfirm,
                'orderShipping' => $orderShipping,
                'orderComplete' => $orderComplete,
            ]
        );
    }
    public function dataList(Request $request)
    {
        $result = [];
        $params = $request->all();
        $search = isset($params['search']) ? $params['search'] : [];
        $status = isset($params['status']) ? $params['status'] : [];
        $searchValue = isset($search['value']) ? $search['value'] : "";
        $total = 0;
        if ($status) {
            $items = $this->model->listItems(['status' => $status], ['task' => 'status']);
        } else {
            $items = $this->model->listItems([], ['task' => 'list']);
        }
        $items = $items ? $items->toArray() : [];
        $items = array_map(function ($item) {
            $products = $item['products'] ? json_decode($item['products'], true)  : [];
            $products = array_map(function ($product) {
                $product['product_name'] = $product['name'];
                return $product;
            }, $products);
            $item['details'] = $products;
            $info_order = $item['info_order'] ? json_decode($item['info_order'], true)  : [];
            $item['fullname'] = $info_order['fullname'] ?? "-";
            $item['phone'] = $info_order['phone'] ?? "-";
            $item['address'] = $info_order['address'] ?? "-";
            $payment = $item['payment'] ? json_decode($item['payment'], true)  : [];
            $item['payment_method'] = $payment['method_title'] ?? "-";
            $item['payment_status'] = $payment['status'] ?? 0;
            $item['currency'] = "đ";
          
            return $item;
        }, $items);
        $test = null;
        $typeSearch = null;
        if ($searchValue) {
            $test = strpos("0932730394", $searchValue);
            $items = array_filter($items, function ($item) use ($searchValue) {
                if (strpos($item['phone'], $searchValue) !== FALSE) {
                    $item['typeSearch'] = "phone";
                    return $item;
                } elseif (strpos($item['code'], $searchValue) !== FALSE) {
                    $item['typeSearch'] = "code";
                    return $item;
                }
            });
        }
        $total = count($items);
        $result = [
            'draw' => 0,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
            'searchValue' => $searchValue,
            'test' => $test,
        ];
        return $result;
    }
    public function destroyMulti(Request $request)
    {
        $result = [];
        $ids = $request->ids;
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $this->model->deleteItem(['id' => $id], ['task' => 'delete']);
            }
        }
        return $ids;
    }
    public function detail(Request $request)
    {
        $id = $request->id;
        $item = $this->model::find($id);
        $user = [];
        if ($item) {
            $payment = json_decode($item['payment'], true) ?? [];
            $info_order = json_decode($item['info_order'], true) ?? [];
            $info_shipping = json_decode($item['info_shipping'], true) ?? [];
            $products = json_decode($item['products'], true) ?? [];
            $shipping = json_decode($item['shipping'], true) ?? [];
            $shippingFee = $shipping['fee'] ?? 0;
            $total = $item['total'] ?? 0;
            $discount = $item['discount'] ?? 0;
            $orderSum = Product::getOrderSumary($total, [
                'add' => [$shippingFee],
                'minus' => [$discount],
            ]);
            $user_id = $item['user_id'] ?? "";
            $user = $this->userModel::find($user_id);
            $parent_id = $item['parent_id'] ?? "";
            $root_id = User::getRootInfo('id');
            $parents = [];
            $transactions = [];
            $checkUser = [];
            $is_affiliate = 0;
            if ($parent_id != $root_id) {
                $transactions = Order::getTransactions($id, $user_id);
                $checkUser = Order::checkUser($id);
                $parents = $transactions['data'] ?? [];
                $parents = array_reverse($parents);
                $is_affiliate = $checkUser['is_affiliate'] ?? 0;

                
            }
            return view(
                "{$this->pathViewController}/detail",
                [
                    'id' => $id,
                    'item' => $item,
                    'payment' => $payment,
                    'products' => $products,
                    'shipping' => $shipping,
                    'orderSum' => $orderSum,
                    'info_order' => $info_order,
                    'info_shipping' => $info_shipping,
                    'parents' => $parents,
                    'user' => $user,
                    'is_affiliate' => $is_affiliate,
                ]
            );
        } else {
            return redirect()->route('admin_order/index');
        }
    }
    public function save(Request $request)
    {
        $id = $request->id;
        $payment = [];
        $params = $request->all();
        $status = isset($params['status']) ? $params['status'] : "";
        $payment_status = isset($params['payment_status']) ? $params['payment_status'] : '';
        $shippingfee = isset($params['shippingfee']) ? $params['shippingfee'] : '';
        $discount = isset($params['discount']) ? $params['discount'] : '';
        $item = $this->model::find($id);
        $code = $item['code'] ?? "";
        $affiliate = null;
        $activeCourse = null;
        if ($status) {
            $paramsStatus['id'] = $id;
            $paramsStatus['status'] = $status;
            $payment = json_decode($item['payment'], true) ?? [];
            $payment['status'] = 0;
            $paramsStatus['payment'] = json_encode($payment);
            $this->model->saveItem($paramsStatus, ['task' => 'edit-item']);
            if ($status == 'complete') {
                $payment['status'] = 1;
                $user_id = $item['created_by'] ?? "";
                $paramsStatus['payment'] = json_encode($payment);
                $this->model->saveItem($paramsStatus, ['task' => 'edit-item']);
                $affiliate = $this->handleAffiliate($user_id, $id);
                $activeCourse = $this->handleActiveCourse($code);
            }
        }
        if ($payment_status != '') {
            $payment = json_decode($item['payment'], true) ?? [];
            $payment['status'] = $payment_status;
            $this->model->saveItem(['id' => $id, 'payment' => json_encode($payment)], ['task' => 'edit-item']);
        }
        if ($shippingfee != '') {
            $shipping = json_decode($item['shipping'], true) ?? [];
            $shipping['fee'] = $shippingfee;
            $this->model->saveItem(['id' => $id, 'shipping' => json_encode($shipping)], ['task' => 'edit-item']);
        }
        if ($discount != '') {
            $this->model->saveItem(['id' => $id, 'discount' => $discount], ['task' => 'edit-item']);
        }
        session()->flash('status_success', 'Cập nhật đơn hàng thành công');
        $result = [
            'title' => 'Thông báo',
            'message' => 'Cập nhật thành công',
            'success' => true,
            'affiliate' => $affiliate,
            'activeCourse' => $activeCourse,
            'redirect' => route('admin_order/detail', ['id' => $id]),
        ];
        return $result;
    }
    public function delete(Request $request)
    {
        $result = [];
        $id = $request->id;
        $this->model->deleteItem(['id' => $id], ['task' => 'delete']);
        return $id;
    }
    public function saveInfo(Request $request)
    {
        $id = $request->id;
        $params = $request->all();
        $type = $request->type;
        $paramsUpdate['id'] = $id;
        if ($type == 'order') {
            $paramsUpdate['info_order'] = json_encode($params);
        } else {
            $paramsUpdate['info_shipping'] = json_encode($params);
        }
        $this->model->saveItem($paramsUpdate, ['task' => 'edit-item']);
        return redirect(route('admin_order/detail', ['id' => $id]))->with('status_success', 'Cập nhật đơn hàng thành công');
    }
    public function activeCourse(Request $request)
    {
        $code = $request->code;
        $item = $this->model->getItem(['code' => $code], ['task' => 'code']);
        $products = [];
        $info_order = [];
        $randomPassword = Str::random(10);
        $emailExits  = 0;
        $is_affiliate = 0;
        $checkAffiliate = [];
        if ($item) {
            $id = $item['id'];
            $products = json_decode($item['products'], true);
            $comboPriceMin = 5000000;
            $checkAffiliate = array_filter($products, function ($item) use ($comboPriceMin) {
                if ($item['type'] == 'combo' && $item['price'] >= $comboPriceMin) {
                    return $item;
                }
            });
            $is_affiliate = count($checkAffiliate) > 0 ? 1 : 0;
            $info_order = json_decode($item['info_order'], true);
            $checkEmail = $this->userModel->getItem(['email' => $info_order['email']], ['task' => 'email']);
            if ($checkEmail) {
                $emailExits = 1;
            }
            $orderSum = 0;
            return view(
                "{$this->pathViewController}/activeCourse",
                [
                    'products' => $products,
                    'code' => $code,
                    'orderSum' => $orderSum,
                    'item' => $item,
                    'info_order' => $info_order,
                    'randomPassword' => $randomPassword,
                    'is_affiliate' => $is_affiliate,
                    'emailExits' => $emailExits,
                    'checkEmail' => $checkEmail,
                ]
            );
        } else {
            return redirect(route('admin_order/index'));
        }
    }
    public function test(Request $request)
    {
        $code = "RPA694474";
        $item = $this->model->getItem(['code' => $code], ['task' => 'code']);
        $products = [];
        $info_order = [];
        $products = json_decode($item['products'], true);
        $info_order = json_decode($item['info_order'], true);
        $parent_id = $item['user_id'];
        $email = $info_order['email'] ?? "";
        $user = $this->userModel->getItem(['email' => $email], ['task' => 'email']);
        $checkUser = !$user ? 0 : 1;
        $order_id = $item['id'];
        $user_id = $item['created_by'];
        #_Thêm thành viên mới nếu email không tồn tại
        if ($checkUser == 0) {
            $user_id = $this->createNewUserNotExits($parent_id, $info_order);
        }
        #_Thêm khóa học vào cho thành viên
        $addCourseToUser = $this->addCourseToUser($order_id, $user_id, $products);
        return $addCourseToUser;
    }
    public function saveActiveCourse(Request $request)
    {
        $params = $request->all();
        $active = $params['active'];
        $user_id = $params['user_id'] ?? "";
        $order_id = $params['order_id'] ?? "";
        $parent_id = $params['parent_id'] ?? "";
        $code = $params['code'] ?? "";
        $emailExits = $params['emailExits'] ?? 1;
        $is_affiliate = $params['is_affiliate'] ?? 0;
        $current_is_affiliate = $params['current_is_affiliate'] ?? "";
        $comboCourse = [];
        $course = [];
        $user = [];
        $level_id = null;
        $levelUpdateId = null;
        $checkAffiliate = null;
        $levelDefault = [];
        foreach ($active as $item) {
            $type = $item['type'];
            $id = $item['id'];
            if ($type == 'combo') {
                $combo = $this->comboModel::find($id);
                $comboCourse = $combo ? $combo->courseList()->get()->toArray() : [];
            } else {
                $course[] = $id;
            }
        }
        $courseActive = array_filter($comboCourse, function ($item) use ($course) {
            if (!in_array($item['id'], $course)) {
                return $item;
            }
        });
        #_Tạo tài khoản nếu chưa có
        if ($emailExits == 0) {
            $fullname = $params['fullname'] ?? "";
            $email = $params['email'] ?? "";
            $phone = $params['phone'] ?? "";
            $token = $params['_token'] ?? "";
            $code = config('obn.prefix.code') . Obn::generateUniqueCode();
            $randomPassword = Str::random(10);
            $user = [
                'password' => md5($randomPassword),
                'name' => $fullname,
                'phone' => $phone,
                'email' => $email,
                'username' => $email,
                'code' => $code,
                'token' => $token,
                'is_affiliate' => $is_affiliate,
                'parent_id' => $parent_id,
                'status' => 'active',
                'role' => 'user',
                'parent_id' => '',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $createUser = $this->userModel->saveItem($user, ['task' => 'add-item']);
            $user_id = $createUser->id;
            try {
                Notify::sendMailCreateUser(['email' => $email, 'name' => $fullname, 'password' => $randomPassword]);
                Notify::sendMailCreateCourse(['email' => $email, 'course' => $courseActive]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else {
            if ($current_is_affiliate == 0 && $is_affiliate == 1) {
                $this->userModel->saveItem(['is_affiliate' => $is_affiliate, 'id' => $user_id], ['task' => 'edit-item']);
            }
        }
        #_Active khóa học
        try {
            #_Add khóa học vào tài khoản user nếu khóa đó chưa mua
            if (count($courseActive) > 0) {
                foreach ($courseActive as $item) {
                    $activeItem['order_id'] = $order_id;
                    $activeItem['course_id'] = $item['id'];
                    $activeItem['user_id'] = $user_id;
                    $this->orderCourseUserModel->saveItem($activeItem, ['task' => 'add-item']);
                }
            }
            #_Add khóa học vào tài khoản user
            if (count($course) > 0) {
                foreach ($course as $courseId) {
                    $activeItem['order_id'] = $order_id;
                    $activeItem['course_id'] = $courseId;
                    $activeItem['user_id'] = $user_id;
                    $this->orderCourseUserModel->saveItem($activeItem, ['task' => 'add-item']);
                }
            }
            #_Update lại order đã active course
            $this->model->saveItem(['id' => $order_id, 'is_course_active' => '1', 'status' => 'complete'], ['task' => 'edit-item']);
        } catch (\Throwable $e) {
            # code...
        }
        $result = [
            'comboCourse' => $comboCourse,
            'course' => $course,
            'courseActive' => $courseActive,
            'params' => $params,
            'user' => $user,
            'levelUpdateId' => $levelUpdateId,
            'levelDefault' => $levelDefault,
            'level_id' => $level_id,
            'checkAffiliate' => $checkAffiliate,
            'redirect' => route('admin_order/activeCourse', ['code' => $code]),
        ];
        return $result;
    }
    public function deactiveCourse(Request $request)
    {
        $code = $request->code;
        $item = $this->model->getItem(['code' => $code], ['task' => 'code']);
        $order_id = null;
        $user_id = null;
        $courses = null;
        if ($item) {
            $order_id = $item['id'];
            $user_id = $item['created_by'];
            $courses = $this->orderCourseUserModel->listItems(['user_id' => $user_id, 'order_id' => $order_id], ['task' => 'course']);
            $this->model->saveItem(['id' => $order_id, 'is_course_active' => '0'], ['task' => 'edit-item']);
            if (count($courses) > 0) {
                foreach ($courses as $course) {
                    $this->orderCourseUserModel->deleteItem(['id' => $course['id']], ['task' => 'delete']);
                }
            }
            return redirect(route('admin_order/detail', ['id' => $order_id]))->with('status_success', 'Ngừng kích hoạt khóa học thành công');
        } else {
            return redirect(route('admin_order/index'));
        }
    }
    public function handleAffiliate($user_id, $order_id)
    {
        $checkAffiliate = null;
        $level_commission = null;
        $order = $this->model::find($order_id);
        $orderTotal = $order['total'] ?? 0;
        $total = 0;
        $parents = [];
        $levelDefault = [];
        $user_parent_id = null;
        if ($user_id) {
            #_Lấy thông tin user
            $userInfo = $this->userModel::find($user_id);
            $level_id = $userInfo['level_id'] ?? "";
            $level_commission = AffiliatePackage::getCurrentLevel($level_id, 'commission');
            #_Level default
            $levelDefault = $this->levelModel->getItem([], ['task' => 'is_default'])->toArray();
            $levelUpdateId = $levelDefault['id'] ?? "";
            #_Update lại level của user khi đạt điều kiện
            $checkAffiliate = AffiliatePackage::checkAffiliate($user_id);
            if ($checkAffiliate == 1 && $level_id == "") {
                $this->userModel->saveItem(['id' => $user_id, 'level_id' => $levelUpdateId], ['task' => 'edit-item']);
            }
            #_Add vào transaction để trả thưởng trực tiếp
            $transactionOrder = $this->transactionModel->getItem(['user_id' => $user_id, 'order_id' => $order_id], ['task' => 'order_and_user_id']);
            if ($level_commission > 0 && empty($transactionOrder)) {
                $total = round($orderTotal * $level_commission / 100);
                $code =  config('obn.prefix.code') . Obn::generateUniqueCode();
                $this->transactionModel->saveItem(
                    [
                        'code' => $code,
                        'type' => 'in',
                        'total' => $total,
                        'user_id' => $user_id,
                        'order_id' => $order_id,
                        'created' => date('Y-m-d H:i:s'),
                        'category' => 'affiliate',
                        'status' => 'pending'
                    ],
                    ['task' => 'add-item']
                );
            }
            #_Add vào transaction để trả thưởng gián tiếp
            $parents =  $this->userModel::ancestorsOf($user_id)->toArray();
            if ($parents) {
                # user_parent_id = parent_id && level_parent_id = 1 && $level_id == 3 => comission = 10
                # user_parent_id = parent_id && level_parent_id = 1 && $level_id == 2 => comission = 5
                # user_parent_id != parent_id && level_parent_id = 1 && $level_id == 3 => comission = 5
                # user_parent_id != parent_id && level_parent_id = 2 && $level_id == 2 => comission = 5
                $user_parent_id = $userInfo['parent_id'];
                $parents =  array_map(function ($parent)  use ($user_parent_id, $orderTotal, $level_id) {
                    $parent_id = $parent['id'];
                    $parent_level_id = $parent['level_id'];
                    $parentLevels = [1, 2];
                    $userLevels = [2, 3];
                    $parent_comission_other = in_array($parent_level_id, $parentLevels) && in_array($level_id, $userLevels)  ? 5 : 0;
                    $parent_comission = ($user_parent_id == $parent_id) && ($parent_level_id == 1) && ($level_id == 3) ? 10 : $parent_comission_other;
                    $parent_total = round($orderTotal * $parent_comission / 100);
                    $level_parent_id = $parent['level_id'];
                    $parent['comission'] = $parent_comission;
                    $parent['total'] = $parent_total;
                    return $parent;
                }, $parents);
                $transactionOrderIndirect = $this->transactionModel->getItem(['user_id' => $user_id, 'order_id' => $order_id, 'category' => 'affiliate_indirect'], ['task' => 'order_and_user_id']);
                foreach ($parents as $parent) {
                    $parent_id = $parent['id'];
                    $parentTotal = $parent['total'] ?? 0;
                    $code =  config('obn.prefix.code') . Obn::generateUniqueCode();
                    if (!$transactionOrderIndirect && $parentTotal > 0) {
                        $this->transactionModel->saveItem(
                            [
                                'code' => $code,
                                'type' => 'in',
                                'total' => $parent['total'] ?? 0,
                                'user_id' => $parent_id,
                                'order_id' => $order_id,
                                'created' => date('Y-m-d H:i:s'),
                                'category' => 'affiliate_indirect',
                                'status' => 'pending'
                            ],
                            ['task' => 'add-item']
                        );
                    }
                }
            }
        }
        $result = [
            'checkAffiliate' => $checkAffiliate,
            'level_id' => $level_id,
            'user_id' => $user_id,
            'level_commission' => $level_commission,
            'total' => $total,
            'parents' => $parents,
            'user_parent_id' => $user_parent_id,
            'levelDefault' => $levelDefault,
        ];
        return $result;
    }
    public function handleActiveCourse($code)
    {
        $products = [];
        $info_order = [];
        $item = $this->model->getItem(['code' => $code], ['task' => 'code']);
        $checkUser = null;
        if ($item) {
            $products = json_decode($item['products'], true);
            $info_order = json_decode($item['info_order'], true);
            $parent_id = $item['user_id'];
            $email = $info_order['email'] ?? "";
            $user = $this->userModel->getItem(['email' => $email], ['task' => 'email']);
            $checkUser = !$user ? 0 : 1;
            $order_id = $item['id'];
            $user_id = $item['created_by'];
            #_Thêm thành viên mới nếu email không tồn tại
            if ($checkUser == 0) {
                $user_id = $this->createNewUserNotExits($parent_id, $info_order);
            }
            #_Thêm khóa học vào cho thành viên
            $addCourseToUser = $this->addCourseToUser($order_id, $user_id, $products);
        }
        $result = [
            'addCourseToUser' => $addCourseToUser,
            'checkUser' => $checkUser,
            'user_id' => $user_id,
            'addCourseToUser' => $addCourseToUser,
        ];
        return $result;
    }
    public function addCourseToUser($order_id, $user_id, $products)
    {
        $coursesInCombo = [];
        $coursesNotInCombo = [];
        $orderCourseUserIds = [];
        if (count($products) > 0) {
            foreach ($products as $key => $product) {
                $type = $product['type'];
                $id = $product['id'];
                if ($type == 'combo') {
                    $combo = $this->comboModel::find($id);
                    $coursesInCombo = $combo ? $combo->courseList()->get()->toArray() : [];
                } else {
                    $coursesNotInCombo[] = $id;
                }
            }
            #_Danh sách khóa học của combo không trùng với khóa học lẻ => listCourseUnique
            $listCourseUnique = array_filter($coursesInCombo, function ($item) use ($coursesNotInCombo) {
                if (!in_array($item['id'], $coursesNotInCombo)) {
                    return $item;
                }
            });
            #_Add listCourseUnique to user
            if (count($listCourseUnique) > 0) {
                $itemCourseUnique = [];
                foreach ($listCourseUnique as $item) {
                    $itemCourseUnique['order_id'] = $order_id;
                    $itemCourseUnique['course_id'] = $item['id'];
                    $itemCourseUnique['user_id'] = $user_id;
                    $orderCourseUserIds[] = $this->orderCourseUserModel->saveItem($itemCourseUnique, ['task' => 'add-item']);
                }
            }
            #_Add coursesNotInCombo to user
            if (count($coursesNotInCombo) > 0) {
                $itemCourseNotInCombo = [];
                foreach ($coursesNotInCombo as $coursesNotInComboId) {
                    $itemCourseNotInCombo['order_id'] = $order_id;
                    $itemCourseNotInCombo['course_id'] = $coursesNotInComboId;
                    $itemCourseNotInCombo['user_id'] = $user_id;
                    $orderCourseUserIds[] = $this->orderCourseUserModel->saveItem($itemCourseNotInCombo, ['task' => 'add-item']);
                }
            }
            return $orderCourseUserIds;
        }
    }
    public function createNewUserNotExits($parent_id, $info_order)
    {
        $fullname = $info_order['fullname'] ?? "";
        $email = $info_order['email'] ?? "";
        $phone = $info_order['phone'] ?? "";
        $token = md5($email . time());
        $code = config('obn.prefix.code') . Obn::generateUniqueCode();
        $randomPassword = Str::random(10);
        $user = [
            'password' => md5($randomPassword),
            'name' => $fullname,
            'phone' => $phone,
            'email' => $email,
            'username' => $email,
            'code' => $code,
            'token' => $token,
            'parent_id' => $parent_id,
            'status' => 'active',
            'role' => 'user',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $createUser = $this->userModel->saveItem($user, ['task' => 'add-item']);
        $user_id = $createUser->id;
        Notify::sendMailCreateUser(['email' => $email, 'name' => $fullname, 'password' => $randomPassword]);
        // Notify::sendMailCreateCourse(['email' => $email, 'course' => $courseActive]);
        return $user_id;
    }
    public function checkUser(Request $request)
    {
        $id = $request->id;
        $checkUser = Order::checkUser($id);
        $is_exist = $checkUser['is_exist'];
        $is_affiliate = $checkUser['is_affiliate'];
        $item = Order::getOrderInfo($id);
        $user_id = $item['user_id'] ?? "";
        $infoOrder = Order::getArray($item, 'info_order');
        $popupCreateUser = view('admin.popups.create_user', ['infoOrder' => $infoOrder, 'checkUser' => $checkUser])->render();
        $result = [
            'is_exist' => $is_exist,
            'is_affiliate' => $is_affiliate,
            'popupCreateUser' => $popupCreateUser,
            'order_id' => (int) $id,
            'user_id' => $user_id,
        ];
        return $result;
    }
    public function createUser(Request $request)
    {
        $params = $request->all();
        $error = [];
        $checkUsername = [];
        $checkEmail = [];
        $checkPhone = [];
        $case = null;
        if (!$params['name']) {
            $error['name'] = "Chưa nhập họ tên";
        }
        if (!$params['email']) {
            $error['email'] = "Chưa nhập email";
        } else {
            // Check email tồn tại
            $checkEmail = $this->userModel->getItem($params, ['task' => 'email']);
            if ($checkEmail) {
                $error['email'] = "Đã tồn tại Email trên hệ thống";
            }
        }
        if (!$params['phone']) {
            $error['phone'] = "Chưa nhập số điện thoại";
        } else {
            // Check số điện thoại tồn tại
            $checkPhone = $this->userModel->getItem($params, ['task' => 'phone']);
            if ($checkPhone) {
                $error['phone'] = "Đã tồn tại số điện thoại trên hệ thống";
            }
        }
        if (!$params['username']) {
            $error['username'] = "Chưa nhập tài khoản đăng nhập";
        } else {
            // Check username đã tồn tại
            $checkUsername = $this->userModel->getItem($params, ['task' => 'username']);
            if ($checkUsername) {
                $error['username'] = "Đã tồn tại Tên đăng nhập trên hệ thống";
            }
        }
        if (!$params['password']) {
            $error['password'] = "Chưa nhập mật khẩu đăng nhập";
        }
        if (empty($error)) {
            $has_id = isset($params['has_id']) ? $params['has_id'] : 0;
            $is_affiliate = isset($params['is_affiliate']) ? $params['is_affiliate'] : 0;
            $is_exist = isset($params['is_exist']) ? $params['is_exist'] : 0;
            if ($has_id == 0 && $is_affiliate == 0 && $is_exist == 0) {
                $case = 1;
            } elseif ($has_id == 0 && $is_affiliate == 1 && $is_exist == 0) {
                $case = 2;
            }
            $code = $is_affiliate == 1 ? config('obn.prefix.code') . Obn::generateUniqueCode() : "";
            $params['token'] = md5($params['email'] . time());
            $params['code'] = $code;
            $params['status'] = 'active';
            $params['role'] = 'user';
            $passwordOrigin = $params['password'];
            $password = md5($params['password']);
            $params['password'] = $password;
            $params['created_at'] = date('Y-m-d H:i:s');
            $createUser = $this->userModel->saveItem($params, ['task' => 'add-item']);
            $user_id = $createUser->id;
            $params['password'] = $passwordOrigin;
            // Notify::sendMailCreateUser($params);
            $popupUpdateOrder = view('admin.popups.update_order', [])->render();
            $params['popupUpdateOrder'] = $popupUpdateOrder;
            $params['user_id'] = $user_id;
            $params['case'] = $case;
            $params['route_updateOrder'] = route("admin_order/updateOrder");
            return response()->json($params);
        } else {
            return response()->json(
                $error,
                422,
            );
        }
        return $params;
    }
    public function updateOrder(Request $request)
    {
        $params = $request->all();
        $parents = [];
        $updateParentLevel = null;
        #_Update order status complete
        $order_id = isset($params['order_id']) ? $params['order_id'] : "";
        $user_id = isset($params['user_id']) ? $params['user_id'] : "";
        $is_affiliate = isset($params['is_affiliate']) ? $params['is_affiliate'] : 0;
        $this->model->saveItem(['id' => $order_id, 'status' => 'complete', 'user_id' => $user_id], ['task' => 'edit-item']);
        $order = $this->model->getItem(['id' => $order_id], ['task' => 'id']);
        $parent_id = $order['parent_id'] ?? "";
        $root_id = User::getRootInfo('id');
        $products = Order::getArray($order, 'products');
        #_Update Code is_affiliate = 1
        if ($is_affiliate ==  1) {
            $this->userModel->saveItem(
                [
                    'id' => $user_id,
                    'code' => config('obn.prefix.code') . Obn::generateUniqueCode()
                ],
                [
                    'task' => 'edit-item'
                ]
            );
        }
        #_Add course to user
        if ($order_id && $user_id && $products) {
            $this->addCourseToUser($order_id, $user_id, $products);
        }
        #_Notify by mail
        #_Check and Update Level By User ID
        $updateLevel = Order::updateLevel($order_id, $user_id);
        #_Add Transaction
        $transactionIds = Order::addTransaction($order_id, $user_id);
        #_Check and Update Level By List Parent
        if ($parent_id != $root_id) {
            $parents = Order::getParentByParentId($parent_id);
            
            if (count($parents) > 0) {
                foreach ($parents as $parent) {
                    $updateParentLevel = Order::updateLevel($order_id, $parent['id']);
                }
            }
        }
        $params['products'] = $products;
        $params['order'] = $order;
        $params['updateLevel'] = $updateLevel;
        $params['parents'] = $parents;
        $params['updateParentLevel'] = $updateParentLevel;
        return $params;
    }
    public function checkLevel(Request $request)
    {
        $order_id = 167;
        $user_id = 121;
        return Order::checkLevel($user_id);
        // Order::addTransaction($order_id, $user_id);
    }
}
