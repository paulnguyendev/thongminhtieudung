<?php

namespace App\Helpers\Link;

class OrderLink
{
    public static function detail($id)
    {
        return route('user_order/detail', ['id' => $id]);
    }
}
