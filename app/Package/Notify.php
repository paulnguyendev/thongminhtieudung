<?php

namespace App\Helpers;

use App\Mail\RegisterUserMail;
use Illuminate\Support\Facades\Mail;

class Notify
{
    public static function sendMailRegisterUser($params)
    {
        Mail::to($params['email'])->send(new RegisterUserMail($params));
    }
}
