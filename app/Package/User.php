<?php

namespace App\Helpers;

use App\Models\UserGroupModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Cookie;

class User
{
    public static function getInfo($user_id = "", $key = "")
    {
        $prefix =  request()->route()->getPrefix();
        $prefix = explode("/", $prefix);
        $prefixType = array_shift($prefix);
        if (empty($user_id)) {
            if ($prefixType == 'admin') {
                $userInfo = session()->get('adminInfo');
            } else {
                $userInfo = session()->get('userInfo');
            }
            $userInfo = array_shift($userInfo);
            $user_id = $userInfo['id'];
        }
        $user = UserModel::find($user_id);
        if ($user) {
            if ($key) {
                $result = (isset($user[$key])) ? $user[$key] : "";
            } else {
                $result = $user;
            }
        }
        return $result;
    }
    public static function getAffInfo($key = "aff_user_id")
    {
        $result = null;
       
        if ($key == 'aff_user_id' && Cookie::has('aff_user_id')) {
            $result = Cookie::get('aff_user_id');
        }
        if ($key == 'aff_user_code' && Cookie::has('aff_user_code')) {
            $result = Cookie::get('aff_user_code');
        }
        return $result;
    }
    public static function getGroupName($user_id)
    {
        $group_id = self::getInfo($user_id, 'group_id');
        if ($group_id) {
            $model = new UserGroupModel();
            $group_info = $model::find($group_id);
            $group_name = $group_info['name'] ?? "-";
        } else {
            $group_name = 'CTV';
        }
        $result = sprintf(' <span class="badge badge-primary">%s</span>', $group_name);
        return $result;
    }
    public static function getTotalBalance($user_id, $status = "total") {
        $total = 0;
        $user = UserModel::find($user_id);
        if($status == 'total') {
            $total = $user->payment_history()->where('status','approve_success')->sum('total_commission');
        }
        else {
            $total = $user->payment_history()->where('status','active')->sum('total_commission');
        }
      
        $total = number_format($total) . " đ";
        return $total;
    }
}
