<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\SMSMessage;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sms(Request $request){
        $sms = SMSMessage::all();

        return view('admin.notifications.sms')->with(['sms'=>$sms]);
    }

    public function email(Request $request){
        $emails = Email::all();

        return view('admin.notifications.email')->with(['emails'=>$emails]);        
    }
}
