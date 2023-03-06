<?php

namespace App\Helpers\Template;

use App\Helpers\User;
use App\Models\OrderModel;
use App\Models\SupplierModel;
use App\Models\UserGroupModel;

class Count
{
  public static function countOrder($status) {
    $model = new OrderModel();
    $number = $model->where('status',$status)->count();
    $total_money = $model->where('status',$status)->sum('total');
    $result = [
        'number' => $number,
        'total_money' => sprintf('<span>%s</span>đ', number_format($total_money)),
    ];
    return $result;
  }
}
