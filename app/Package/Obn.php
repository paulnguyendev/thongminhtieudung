<?php

namespace App\Helpers;

use App\Models\UserModel;
use Jenssegers\Agent\Agent;
class Obn
{
    public static function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (UserModel::where("code", "=", $code)->first());
        return $code;
    }
    public static function get_logo()
    {
        return asset('obn-dashboard/img/logo.png');
    }
    public static function showStatus($status)
    {
        $xhtml_status = null;
        $status = $status ? $status : 'default';
        $tpl_status = config('obn.status.template');
        $current_status = isset($tpl_status[$status]) ? $tpl_status[$status] : $tpl_status['default'];
        $xhtml_status = sprintf('<span class = "badge %s">%s</span>', $current_status['class'], $current_status['name']);
        return $xhtml_status;
    }
    public static function showTicketStatus($status)
    {
        $xhtml_status = null;
        $status = $status ? $status : 'default';
        $tpl_status = config('obn.ticket.status');
        $current_status = isset($tpl_status[$status]) ? $tpl_status[$status] : $tpl_status['default'];
        $xhtml_status = sprintf('<span class = "badge %s">%s</span>', $current_status['class'], $current_status['name']);
        return $xhtml_status;
    }
    public static function showPrice($price) {
        $result = number_format($price) . " đ";
        return $result;
    }
    public static function showThumbnail($thumb) {
        $result = $thumb ? $thumb : asset('obn-dashboard/img/no-image.png');
        return $result;
    }
    public static function checkDevice() {
        $agent = new Agent();
        if($agent->isMobile()) {
            $result = 'mobile';
        }
        elseif($agent->isDesktop()) {
            $result = 'isTablet';
        }
        else {
            $result = 'desktop';
        }
        return $result;
    }
}
