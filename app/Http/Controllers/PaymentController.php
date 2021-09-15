<?php

namespace App\Http\Controllers;

use App\DgManagerDue;
use App\User;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function paymentFile(Request $request){
        $reqPost = $request->all();
        $file = fopen("1560750.txt","a");
        //Output lines until EOF is reached
        fwrite($file,json_encode( $reqPost ) );

        fclose($file);
    }

    public function paymentCancel(){
        return view('payment.payment_cancel');
    }
    public function paymentDone(Request $request){
        $theUser = User::where('waiting_load_code','=',$request->code)->first();

        if($theUser && $theUser->waiting_load_balance != null){

            if($theUser->referrer_id != null){
                $theLeader = User::where('id','=',$theUser->referrer_id)->first();
                if($theLeader){
                    $theLeader->manager_task_access = 1;
                    $DgManagerDue = new DgManagerDue();
                    $DgManagerDue->user_id = $theLeader->id;
                    $DgManagerDue->manager_due_payment	= .08*$theUser->waiting_load_balance;
                    if($DgManagerDue->save()){
                        $theLeader->save();
                    }
                }
            }
            $theUser->balance+= $theUser->waiting_load_balance;
            $theUser->recharge+= $theUser->waiting_load_balance;
            $theUser->waiting_load_code = null;
            $theUser->waiting_load_balance = null;
            $theUser->save();

        }else{
            return "Already Balance Stored.";
        }
        return view('payment.payment_done');
    }
    public function paymentReq(Request $request){

        try {
            $random = Str::random(40).Carbon::now();
        $waiting_amount = $request->amount;
        $activeUser = User::find(Auth::user()->id);
        $activeUser->waiting_load_code = $random;
        $activeUser->waiting_load_balance = $waiting_amount;
            if($activeUser->save()){
                $vars = '{
                    "code": "'.$random.'",
                    "description": "Test purchase ",
                    "cancel_uri": "http://127.0.0.1:8000/canceled",
                    "confirmation_uri": "http://127.0.0.1:8000/confirmed",
                    "amount": '.$request->amount.',
                    "items": [
                    {
                        "description": "Purchase Item 1",
                        "amount": '.$request->amount.',
                        "quantity": 1
                    }
                    ]
                }';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://payments.air-pay.io/purchases");
                curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $headers = [
                    'Content-Type: application/json',
                    'Authorization: Basic "MWYzZWM5ZGQtOWU4ZC00MzQ3LTg0NjYtNjY3ZjMxMDE2NDA5OnpkZmZaRGtscDNVV3dZcnkzOU9wUHlyanRoUnllcjdoOHZLdXZ5Mm51MTg0Ymw4U2ttejBTSGptc3JTQ0lBdnFZY0RHb2NRY1dwM2F5ampV"',
                ];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $server_output = curl_exec ($ch);
                curl_close ($ch);
                // echo  $server_output ;
                $result = json_decode($server_output,true);
                // echo $result['id'];
                $destination = "https://payments.air-pay.io/checkout/".$result['id'];
                return redirect($destination);
            }
        } catch(\Exception $e) {

            return "Something wrong, Please check your Internet Connection";
        }


    }
}
