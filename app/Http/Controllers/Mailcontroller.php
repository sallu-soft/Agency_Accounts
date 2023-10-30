<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Demomail;
class Mailcontroller extends Controller
{
    public function index(Request $request){
        // dd($request->email);
        session_start();
        $randomString = rand(100000, 999999);
        $_SESSION['random_code'] = $randomString;
        $_SESSION['requested_email'] = $request->email;
        $mailData = [
            'title' => 'Mail From Arnab',
            'body'  => 'Password Reset Code',
            'code'  => $randomString,
        ];

        Mail::to($request->email)->send(new DemoMail($mailData));
        return view('resetpass.match');
    }
}
