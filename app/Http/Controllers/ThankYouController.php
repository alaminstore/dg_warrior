<?php

namespace App\Http\Controllers;

use App\User;
use App\WebhookInfo;
use Illuminate\Http\Request;


class ThankYouController extends Controller
{
    public function thankYou(){
        return view('backend.thankyou');
    }
    public function webHook(){

        return view('backend.webhook');
    }

    public function webHookInfo(Request $request){

        $reqEmail = $request->CUSTOMEREMAIL;
        $reqAmount = $request->PAYABLE_AMOUNT;
        $reqRefInfo = $request->REFNO;
        $checkEmail = User::where('email','=',$reqEmail)->first();
        if($checkEmail){
            $checkEmail->balance += (float) $reqAmount;
            $checkEmail->save();
        }
        // $file = fopen("webhook.txt","a");
        // fwrite($file ,"executed!" );
        // fclose($file);
        return http_response_code(201);
    }


    public function webHookInfoget(Request $request){

        $reqPost = $request->all();
        $file = fopen("test.txt","w");
        //Output lines until EOF is reached

        fwrite($file,json_encode( $reqPost ) );


        fclose($file);

        return http_response_code(201);

    }
}
