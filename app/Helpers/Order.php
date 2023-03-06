<?php
namespace App\Helpers;
use App\Helpers\Package\AffiliatePackage;
use App\Models\UserGroupModel;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Cookie;
class Order
{
    public static function getOrderInfo($id, $columns = [])
    {
        $model = new OrderModel();
        $result = $model::find($id);
        $result = $result ? $result->toArray() : [];
        return $result;
    }
    public static function getUserInfo($key, $value)
    {
        $result = [];
        $model = new UserModel();
        if ($key == 'email') {
            $result = $model->getItem(['email' => $value], ['task' => 'email']);
        } elseif ($key == 'id') {
            $result = $model->getItem(['id' => $value], ['task' => 'id']);
        }
        return $result;
    }
    public static function getArray($item, $key)
    {
        $result = null;
        $result  = isset($item[$key]) ? $item[$key] : "";
        $result = $result ? json_decode($result, true) : [];
        return $result;
    }
    public static function checkUserExist($user)
    {
        $result = $user ? 1 : 0;
        return $result;
    }
    public static function checkUserHasId($user)
    {
        $code = isset($user['code']) ? $user['code'] : "";
        $code = $code ? $code : "";
        $result = $code ? 1 : 0;
        return $result;
    }
    public static function checkAffiliate($products)
    {
        $totalMin = 5000000;
        $result = 0;
        $check = 0;
        if (count($products) > 0) {
            foreach ($products as $product) {
                $type = isset($product['type']) ? $product['type'] : "";
                $price = isset($product['price']) ? $product['price'] : "";
                $check = $type == 'combo' && $price >= $totalMin ? 1 : 0;
                $result += $check;
            }
        }
        return $result;
    }
    public static function checkUser($order_id)
    {
        $result = null;
        $item = self::getOrderInfo($order_id, ["'id'", "'user_id'"]);
        # Thông tin đơn hàng
        $info_order = self::getArray($item, 'info_order');
        $products = self::getArray($item, 'products');
        $user_id = isset($item['user_id']) ? $item['user_id'] : "";
        $parent_id = isset($item['parent_id']) ? $item['parent_id'] : "";
        # Thông tin user
        $email = isset($info_order['email']) ? $info_order['email'] : "";
        // $email = "anhnnd.hotro@gmail.com";
        $user = self::getUserInfo('email', $email);
        #_1 Check exist
        $is_exist  = self::checkUserExist($user);
        #_2 Check has id
        $checkHasId = self::checkUserHasId($user);
        $has_id = $is_exist == 0 ? 0 : $checkHasId;
        #_3 Check Affiliate
        $is_affiliate = self::checkAffiliate($products);
        $result = [
            'is_exist' => $is_exist,
            'has_id' => $has_id,
            'is_affiliate' => $is_affiliate,
            'parent_id' => $parent_id,
        ];
        return $result;
    }
    public static function createUser($info_order)
    {
        $params = [];
        $params['name'] = isset($info_order['fullname']) ? $info_order['fullname'] : "";
        $params['email'] = isset($info_order['email']) ? $info_order['email'] : "";
        $params['phone'] = isset($info_order['phone']) ? $info_order['phone'] : "";
        echo '<pre>';
        print_r($params);
        echo '</pre>';
    }
    public static function getBalance($user_id)
    {
        $model = new TransactionModel();
        $result = $model->sumItems(['user_id' => $user_id], ['task' => 'get_balance']);
        return $result;
    }
    public static function getChildsDirect($user_id) {
        $model = new UserModel();
        
        $result = $model->listItems(['parent_id' => $user_id],['task' => 'parent_id']);
        $result = $result ? $result->toArray() : [];
        return $result;
    }
    public static function getChilds($user_id, $depth = "")
    {
       
        $model = new UserModel();
        $result = $model::withDepth()->defaultOrder()->descendantsOf($user_id)->where('status', 'active');
        $result = $result ? $result->toArray() : [];
        if ($depth && count($result) > 0) {
            $result = array_filter($result, function ($item) use ($depth) {
                if ($item['depth'] == $depth) {
                    return $item;
                }
            });
        }
        return $result;
    }
    public static function countLevel($items, $level = "dstt")
    {
        $result = [];
        if (count($items) > 0) {
            $result = array_filter($items, function ($item) use ($level) {
                if ($item['level'] == $level) {
                    return $item;
                }
            });
        }
        $total = count($result);
        return $total;
    }
    public static function checkLevel($user_id)
    {
        $childsDirect = self::getChildsDirect($user_id,1);
        $number_dstt = self::countLevel($childsDirect);
        $balance = self::getBalance($user_id);
        $level = null;
        $currentLevel = User::getInfo($user_id, 'level');
        if ($balance >= 250000000 && $currentLevel == 'dstt_2sao') {
            $level = "dstt_3sao";
        } elseif ($balance >= 50000000 && $currentLevel == 'dstt_1sao') {
            $level = "dstt_2sao";
        } elseif ($number_dstt >= 5 && $currentLevel == 'dstt') {
            $level = "dstt_1sao";
        } else {
            $level = $currentLevel;
        }
        return $level;
    }
    public static function updateLevel($order_id, $user_id)
    {
        $checkUser = self::checkUser($order_id);
        $isAffiliate = isset($checkUser['is_affiliate']) ? $checkUser['is_affiliate'] : 0;
        $checkLevel = self::checkLevel($user_id);
        $isUpdate = 0;
        $levelUpdate = null;
        if ($isAffiliate == 1) {
            $model = new UserModel();
            if (empty($checkLevel)) {
                $levelUpdate = "dstt";
            } else {
                $levelUpdate = $checkLevel;
            }
            $model->saveItem(['id' => $user_id, 'level' => $levelUpdate], ['task' => 'edit-item']);
        }
        $result = [
            'checkLevel' => $checkLevel,
            'levelUpdate' => $levelUpdate,
            'isAffiliate' => $isAffiliate,
        ];
        return $result;
    }
    public static function getParentByParentId($parent_id, $level = 1)
    {
        $result = array();
        $model = new UserModel();
        $data = $model->listItems([], ['task' => 'parent'])->toArray();
        foreach ($data as $item) {
            if ($parent_id == $item['id']) {
                $item['depth'] = $level;
                $result[] = $item;
                unset($data[$item['id']]);
                $over = self::getParentByParentId($item['parent_id'], $level + 1);
                $result = array_merge($result, $over);
            }
        }
        $maxParent = 3;
        foreach ($result as $key => $value) {
            $id = $value['id'];
            if ($value['depth'] > $maxParent) {
                unset($result[$key]);
            }
        }
        return $result;
    }
    public static function getConditions()
    {
        $conditions = [
            'level_1' => [
                'dstt' => [
                    'percent' => 20,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_1sao' => [
                    'percent' => 30,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_2sao' => [
                    'percent' => 35,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_3sao' => [
                    'percent' => 40,
                    'has_condition' => 0,
                    'conditions' => []
                ],
            ],
            'level_2' => [
                'dstt_1sao' => [
                    'percent' => 10,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_2sao' => [
                    'percent' => 35,
                    'has_condition' => 1,
                    'conditions' => [
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt',
                            'percent' => 15,
                        ],
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt_1sao',
                            'percent' => 5,
                        ],
                    ]
                ],
                'dstt_3sao' => [
                    'percent' => 35,
                    'has_condition' => 1,
                    'conditions' => [
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt_1sao',
                            'percent' => 10,
                        ],
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt',
                            'percent' => 20,
                        ],
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt_2sao',
                            'percent' => 5,
                        ],
                    ]
                ],
            ],
            'level_3' => [
                'dstt_1sao' => [
                    'percent' => 10,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_2sao' => [
                    'percent' => 5,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_3sao' => [
                    'percent' => 35,
                    'has_condition' => 1,
                    'conditions' => [
                        [
                            'level_depth' => 2,
                            'level_key' => 'dstt_1sao',
                            'percent' => 10,
                        ],
                        [
                            'level_depth' => 2,
                            'level_key' => 'dstt_2sao',
                            'percent' => 5,
                        ],
                    ]
                ],
            ],
        ];
        return $conditions;
    }
    public static function getParentBefore($parents, $depth)
    {
        $depthBefore = $depth - 1;
        $parentBefore = array_filter($parents, function ($item) use ($depthBefore) {
            $depthParent = $item['depth'] ?? "";
            if ($depthParent == $depthBefore) {
                return $item;
            }
        });
        $parentBefore = array_shift($parentBefore);
        return $parentBefore;
    }
    public static function getPercentByCondition($parents, $parent)
    {
        # Khai báo
        $parentBefore = [];
        $conditionsOfLevel = [];
        $result = 0;
        # Get List Condition
        $conditions = self::getConditions();
        # Get Item Parent
        $depth = $parent['depth'];
        $level = $parent['level'] ?? "";
        # Get Item Condition
        $itemCondition = $conditions["level_{$depth}"] ?? [];
        $dataOfLevel = $itemCondition[$level] ?? [];
        $conditionsOfLevel = $dataOfLevel['conditions'] ?? [];
        $hasConditionOfLevel = $dataOfLevel['has_condition'] ?? 0;
        # Get info before level
        $depthBefore = $depth - 1;
        $parentBefore = self::getParentBefore($parents, $depth);
        # Get Condition Info
        $conditionInfo = array_filter($conditionsOfLevel, function ($item) use ($depthBefore, $parentBefore) {
            $levelKeyParentBefore = $parentBefore['level_key'] ?? "";
            if ($item['level_depth'] == $depthBefore && $item['level_key'] == $levelKeyParentBefore) {
                return $item;
            }
        });
        $conditionInfo = array_shift($conditionInfo);
        # Percent by level
        $percentAffiliate = $dataOfLevel['percent'] ?? 0;
        # Percent by Condition
        $percentCondition = $conditionInfo['percent'] ?? 0;
        $result = $hasConditionOfLevel == 1 ? $percentCondition :  $percentAffiliate;
        return $result;
    }
    public static function getTransactions($order_id, $user_id)
    {
        $model = new UserModel();
        $item = $model::find($user_id);
        $parent_id = User::getInfo($user_id, 'parent_id');
        $parents = self::getParentByParentId($parent_id);
        $conditions = self::getConditions();
        $parentsNew = [];
        foreach ($parents as $key => $parent) {
            $depth = $parent['depth'];
            $level = $parent['level'] ?? "";
            $parents[$key]['level_key'] = $level;
            $percent = self::getPercentByCondition($parents, $parent);
            $parents[$key]['percent'] = $percent;
        }
        $parents = array_filter($parents, function ($item) {
            $percent = isset($item['percent']) ? $item['percent'] : 0;
            if ($percent > 0) {
                return $item;
            }
        });
        $percents = array_column($parents, 'percent');
        $totalPercent = array_sum($percents);
        $result = [
            'data' => $parents,
            'total_percent' => $totalPercent,
            'order_id' => $order_id,
            'user_id' => $user_id,
        ];
        return $result;
    }
    public static function addTransaction($order_id, $user_id)
    {
        $model = new TransactionModel();
        $items = self::getTransactions($order_id, $user_id);
        // Get data order
        $orderModel = new OrderModel();
        $order = $orderModel::find($order_id);
        $orderTotal = $order['total'] ?? 0;
        #_Is affiliate = 1, total order > 2
        $userModel = new UserModel();
        $user = $userModel::find($user_id);
        $totalOrderOfUser = $user->order()->count();
        $checkUser = self::checkUser($order_id);
        $is_affiliate = $checkUser['is_affiliate'] ?? 0;
        $code = config('obn.prefix.code') . Obn::generateUniqueCode();
        if ($is_affiliate == 1 && $totalOrderOfUser >= 2) {
            $checkTransactionOfUser = $model->getItem(['user_id' => $user_id, 'order_id' => $order_id], ['task' => 'checkExist']);
            if (!$checkTransactionOfUser) {
                $percentOfUser = 20;
                $transactionTotalOfUser = round($percentOfUser * $orderTotal  / 100);
                $transactionId = $model->saveItem(
                    [
                        'code' => $code,
                        'user_id' => $user_id,
                        'order_id' => $order_id,
                        'total' => $transactionTotalOfUser,
                        'type' => 'in',
                        'status' => 'pending',
                        'created' => date('Y-m-d H:i:s'),
                    ],
                    ['task' => 'add-item']
                );
            }
        }
        $data = $items['data'] ?? [];
        $checkTransaction = [];
        $ids = [];
        if (count($data) > 0) {
            foreach ($data as $item) {
                $transactionUserId = $item['id'];
                $percent = $item['percent'] ?? 0;
                $transactionTotal = round($percent * $orderTotal  / 100);
                $checkTransaction = $model->getItem(['user_id' => $transactionUserId, 'order_id' => $order_id], ['task' => 'checkExist']);
                if (!$checkTransaction) {
                    $transactionId = $model->saveItem(
                        [
                            'code' => $code,
                            'user_id' => $transactionUserId,
                            'order_id' => $order_id,
                            'total' => $transactionTotal,
                            'type' => 'in',
                            'status' => 'pending',
                            'created' => date('Y-m-d H:i:s'),
                        ],
                        ['task' => 'add-item']
                    );
                    $ids[] = $transactionId;
                }
            }
        }
        return $ids;
    }
}
