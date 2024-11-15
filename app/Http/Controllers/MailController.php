<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BubbleMail;

class MailController extends Controller
{
    public function send_register_mail(Request $request){
        Mail::to($request->email)->send(new BubbleMail($request->email,$request->name,$request->message));
        
    }

    public function send_login_mail(Request $request){
        Mail::to($request->email)->send(new BubbleMail($request->email,$request->name,$request->message));
    }
}
