<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function send(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:80',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|max:500',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            Mail::send('Email.sendmail',[
                'data'=>$request->message,
                'email'=>$request->email,
                'user'=>$request->name,
            ],function($message) use ($request){
                $message->to('support@dgwarrior.com');
                $message->subject($request->subject);
            });
            return response()->json(['status'=>true]);
        }


        // return back()->with('success','Mail send successfully!');
    }
}
