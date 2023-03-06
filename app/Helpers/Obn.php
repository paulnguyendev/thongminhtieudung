<?php

namespace App\Helpers;

use App\Models\SettingModel;
use App\Models\UserModel;
use Jenssegers\Agent\Agent;
use Gloudemans\Shoppingcart\Facades\Cart;

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
    public static function showPrice($price)
    {
        $result = number_format($price) . " đ";
        return $result;
    }
    public static function showThumbnail($thumb)
    {
        $result = $thumb ? $thumb : asset('obn-dashboard/img/no-image.png');
        return $result;
    }
    public static function checkDevice()
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $result = 'mobile';
        } elseif ($agent->isDesktop()) {
            $result = 'isTablet';
        } else {
            $result = 'desktop';
        }
        return $result;
    }
    public static function showTime($time)
    {
        $timeFormat = config('obn.format.short_time');
        $xhtml = ($time) ? date($timeFormat, strtotime($time)) : "Chưa xác định";
        return $xhtml;
    }
    public static function searchCartById($id)
    {
        $cart = Cart::instance('frontend')->content()->toArray();
        $result = array_filter($cart, function ($item) use ($id) {
            if ($item['id'] == $id) {
                return $item;
            }
        });
        $result = array_shift($result);
        return $result;
    }
    public static function getSetting($meta_key, $sub_key = '')
    {
        $result = null;
        $model = new SettingModel();
        $item = $model->getItem(['meta_key' => $meta_key], ['task' => 'meta_key']);
        $result = $item ? $item['meta_value'] : "";
        // $result = self::json_validate($result);

        return $result;
    }
    public static function json_validate($string)
    {

        // decode the JSON data

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
                // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }
        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            $result = json_decode($string, true);
        } else {

            $result = $string;
        }
        return $result;

        // everything is OK

    }
    public static function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
        $youtube_id = "";
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }
    public static function convert_vi_to_en($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
}
