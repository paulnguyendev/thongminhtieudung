<?php

namespace App\Helpers;

use App\Mail\RegisterUserMail;
use App\Mail\CreateUserMail;
use App\Mail\CreateCourseMail;
use Illuminate\Support\Facades\Mail;

class Notify
{
    public static function sendMailRegisterUser($params)
    {
        Mail::to($params['email'])->send(new RegisterUserMail($params));
    }
    public static function sendMailCreateUser($params)
    {
        Mail::to($params['email'])->send(new CreateUserMail($params));
    }
    public static function sendMailCreateCourse($params)
    {
        Mail::to($params['email'])->send(new CreateCourseMail($params));
    }
}
