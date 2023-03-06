<?php
namespace App\Helpers\Package;

use App\Helpers\Obn;
use App\Helpers\User;
use App\Models\AffiliateLevelModel;
use App\Models\AffiliateSettingModel;
use App\Models\TaxonomyModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
class AffiliatePackage
{
    private static $taxnomyModel;
    public static function listSettings($level_id, $commission_type = "", $options = [])
    {
        $model = new AffiliateLevelModel();
        $level = $model::find($level_id);
        $settings = $level->settings();
        $settings = $commission_type ? $settings->where('commission_type', $commission_type) : $settings;
        if (isset($options['type'])) {
            $settings = $settings->where('type', $options['type']);
        }
        $settings = $settings->get()->toArray();
        return $settings;
    }
    public static function getCommissionDirect($user_id)
    {
        $result = 0;
        $user = UserModel::find($user_id);
        if ($user) {
            $level_id = isset($user['level_id']) ? $user['level_id'] : [];
            $item = ($level_id) ?  self::listSettings($level_id, 'direct') : [];
            $item = array_shift($item);
            $result = $item['commission'] ?? 0;
        }
        return $result;
    }
    public static function getCommissionIndirect($user_id)
    {
        $model = new UserModel();
        $user = $model::find($user_id);
        $user_level_id = $user['level_id'];
        $user_level_indirect = self::listSettings($user_level_id, 'indirect', ['type' => 'personal']);
        $childs =  $model::defaultOrder()->where('level_id', '!=', '')->descendantsOf($user_id);
        $child_settings = [];
        $child_level_info = [];
        $child_level_indirects = [];
        $result = [];
        foreach ($childs as $childKey => $child) {
            $child_id = $child['id'];
            $child_level_id = $child['level_id'];
            $child_level_indirect = array_filter($user_level_indirect, function ($item) use ($child_level_id) {
                if ($child_level_id == $item['indirect_level_id']) {
                    return $item;
                }
            });
            $child_level_indirect  = array_shift($child_level_indirect);
            $commission = $child_level_indirect['commission'] ?? 0;
            if ($commission > 0) {
                $result[$childKey]['user_id'] = $child_id;
                $result[$childKey]['commission'] = $commission;
                $result[$childKey]['orders'] = UserModel::find($child_id)->order()->get()->toArray();
            }
        }
        return $result;
    }
    public static function checkAffiliate($user_id)
    {
        $userModel = new UserModel();
        $user = $userModel::find($user_id);
        $level_id = $user['level_id'] ?? "";
        $orders = $user->order()->where('status', 'complete')->get()->toArray();
        $orders = array_map(function ($item) {
            $products = isset($item['products']) ?  json_decode($item['products'], true) : [];
            $priceAffiliate = 5000000;
            $totalCheck = 0;
            $item['products'] = $products;
            if (count($products) > 0) {
                foreach ($products as $product) {
                    $type = isset($product['type']) ? $product['type'] : "";
                    $price = isset($product['price']) ? $product['price'] : "";
                    $check = $type == 'combo' && $price >= $priceAffiliate ? 1 : 0;
                    $totalCheck += $check;
                }
            }
            $item['totalCheck'] = $totalCheck;
            return $item;
        }, $orders);
        $checkOrder = array_filter($orders, function ($item) {
            $totalCheck = isset($item['totalCheck']) ? $item['totalCheck'] : 0;
            if ($totalCheck == 1) {
                return $item;
            }
        });
        $result = count($checkOrder) > 0 ? 1 : 0;
        return $result;
    }
    public static function updateLevel($user_id)
    {
        #_Điều kiện: CheckAffiliate = 1 AND có 1 user trong cấp trực tiếp có CheckAffiliate = 1
        #_Level nâng lên: Đại sứ tri thức 1 sao.
        $userModel = new UserModel();
        $user = $userModel::find($user_id);
        $levelModel = new AffiliateLevelModel();
        $levelDefault = $levelModel->getItem([],['task' => 'is_default'])->toArray();
        $levelDefaultId = $levelDefault['id'];
        $level_id = $user['level_id'] ?? "";
        #_Danh sách thành viên cấp trực tiếp
        $childsDirect = $user->child()->get()->toArray();
        #_Check điều kiện update
        $is_update = 0;
        if (count($childsDirect) > 0) {
            $childsDirect = array_map(function ($item) {
                $checkAffiliate = self::checkAffiliate($item['id']);
                $item['checkAffiliate'] = $checkAffiliate;
                return $item;
            }, $childsDirect);
            $childsDirect = array_filter($childsDirect,function($item) {
                $checkAffiliate = isset($item['checkAffiliate']) ? $item['checkAffiliate'] : 0;
                if($checkAffiliate == 1) {
                    return $item;
                }
            });
            $is_update = count($childsDirect) > 0 ? 1 : 0;
        }
        #Level hiện tại của user đang đăng nhập
        $levelCurrent = $level_id ? $levelModel::find($level_id) : [];
        $levelCurrentAutoUpdate = $levelCurrent['auto_update'] ?? 0;
        #level có thể tự động update
        $levelAutoUpdate = $levelModel->getItem([],['task' => 'auto_update'])->toArray();
        $levelAutoUpdateId = $levelAutoUpdate['id'] ?? "";
        #_Chỉ update khi level có autoupdate && đạt điều kiện update.
        if($is_update == 1 && $levelCurrentAutoUpdate == 1) {
            $userModel->saveItem(['level_id' => $levelAutoUpdateId,'id' => $user_id],['task' => 'edit-item']);
        }
        // echo $levelCurrentAutoUpdate . "<br>";
        // echo $level_id . "<br>";
        // echo $is_update;
        return $is_update;
    }
    public static function updateLevel2($user_id)
    {
        #_Điều kiện: CheckAffiliate = 1 AND có 1 user trong cấp trực tiếp có CheckAffiliate = 1
        #_Level nâng lên: Đại sứ tri thức 1 sao.
        $userModel = new UserModel();
        $user = $userModel::find($user_id);
        $levelModel = new AffiliateLevelModel();
        $levelDefault = $levelModel->getItem([],['task' => 'is_default'])->toArray();
        $levelDefaultId = $levelDefault['id'];
        $level_id = $user['level_id'] ?? "";
        #_Danh sách thành viên cấp trực tiếp
        $childsDirect = $user->child()->get()->toArray();
        #_Check điều kiện update
        $is_update = 0;
       
        if (count($childsDirect) > 0) {
            $childsDirect = array_map(function ($item) {
                $checkAffiliate = self::checkAffiliate($item['id']);
                $item['checkAffiliate'] = $checkAffiliate;
                return $item;
            }, $childsDirect);
            $childsDirect = array_filter($childsDirect,function($item) {
                $checkAffiliate = isset($item['checkAffiliate']) ? $item['checkAffiliate'] : 0;
                if($checkAffiliate == 1) {
                    return $item;
                }
            });
            $is_update = count($childsDirect) > 0 ? 1 : 0;
        }
        
        #Level hiện tại của user đang đăng nhập
        $levelCurrent = $level_id ? $levelModel::find($level_id) : [];
        $levelCurrentAutoUpdate = $levelCurrent['auto_update'] ?? 0;
        echo $user_id . " - " . $user['email'] . " - Is update:  " . $is_update . " - Level Auto update:  " . $levelCurrentAutoUpdate . "<br>";
        #level có thể tự động update
        $levelAutoUpdate = $levelModel->getItem([],['task' => 'auto_update'])->toArray();
        $levelAutoUpdateId = $levelAutoUpdate['id'] ?? "";
        #_Chỉ update khi level có autoupdate && đạt điều kiện update.
        if($is_update == 1 && $levelCurrentAutoUpdate == 1) {
            $userModel->saveItem(['level_id' => $levelAutoUpdateId,'id' => $user_id],['task' => 'edit-item']);
        }
        // echo $levelCurrentAutoUpdate . "<br>";
        // echo $level_id . "<br>";
        // echo $is_update;
        return $is_update;
    }
    public static function getCurrentLevel($level_id, $key = "") {
        $levelModel = new AffiliateLevelModel();
        $levelDefault = ['name' => "-"];
        $result = $level_id ? $levelModel->getItem(['id' => $level_id],['task' => 'id'])->toArray() : $levelDefault;
        $resultKey = isset($result[$key]) ? $result[$key] : "";
        $result = $key ? $resultKey : $result;
        return $result;
    }
    public static function getBalance($user_id = "", $status = "active", $type = "in") {
        $userLoginId = User::getInfo('','id');
        $user_id = $user_id ? $user_id : $userLoginId;
        $model = new TransactionModel();
        $result = 0;
        if($type == 'in' && $status == "active") {
           $result = $model->sumItems(['user_id' => $user_id],['task' => 'get_balance']);
        }
        elseif($type == 'in' && $status == 'pending') {
            $result = $model->sumItems(['user_id' => $user_id],['task' => 'get_balance_pending']);
        }
        $result = Obn::showPrice($result);
        return $result;
    }
}
