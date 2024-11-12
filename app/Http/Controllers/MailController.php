<?php

namespace App\Http\Controllers;
use App\Jobs\SendMail;
use Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    function sendMail(){
        $data = "Hello Ilyas this is Moin this side I am sendin you this mail from the Laravel JobQueue functionality. I hope that you are fine there I am also fine here, thanks!";

        dispatch(new SendMail($data));
        return "Email Sent Successfully";
    }
}
