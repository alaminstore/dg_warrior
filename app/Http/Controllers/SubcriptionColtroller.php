<?php

namespace App\Http\Controllers;

use App\ReferalTracking;
use App\SubcribeCheck;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class SubcriptionColtroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function show(){
        return view('backend.subscription');
    }

    public function subscribeStatus(Request $request){
        $subscribe = User::where('id','=',$request->id)->first();
        $subscribe->subscription = 1;
        $subscribe->balance -= 1;
        $beforSubsorNot = SubcribeCheck::where('user_id','=',$request->id)->first();
        if($beforSubsorNot === null){
            $newsubs = new SubcribeCheck();
            $newsubs->user_id = $request->id;
            $newsubs->save();
            $referrer_found = User::where('id','=',$subscribe->referrer_id)->first();
            if($referrer_found){
                $referrer_found->exp +=1;
                $expLast = ($referrer_found->exp-50)/3;
                $levelRecheck = pow($expLast, (1/3));
                $referrer_found->level = (int) $levelRecheck;
                $referrer_found->save();
            }
        }
        if($subscribe->save()){
           //Start
        $leader = User::where('id',Auth::user()->id)->first();
        $currentUser = $leader->id;
        // ================================================================================================
        if($leader->subscription == 1){

         // Start
        $check = ReferalTracking::with('getUserName')->where('refered_user', $currentUser)
        ->select('user')->get();
        // return $check;
        $data = [];
            $totalUser = [];
            $total2nd = 0;
            $range2 = 0;
            $data2nd = [];
                $total3rd = 0;
                $data3rd = [];
                $range3 = 0;
                    $total4th = 0;
                    $data4th = [];
                        $range4= 0;
                        $total5th = 0;
                        $data5th = [];
                        $range5= 0;
        if($check != null){
            foreach($check as $val){
                $data[]=$val->user;
                $totalUser[]=$val->user;
            }
        }

        // return $data;
        //For 2nd tier list
        if($data != null){

        for($range2=0;$range2<count($data);$range2++){
            $check2ndTier = ReferalTracking::where('refered_user',$data[$range2])
            ->select('user')->get();

        foreach($check2ndTier as $val){
            $data2nd[]=$val->user;
            $totalUser[]=$val->user;
        }
        if ($check2ndTier != null) {
            $total2nd+=count($check2ndTier);
        }
        }
        //  return $data2nd;
        }

        $secondCount = count($data);
        $thirdCount = count($data2nd);
        if($secondCount>=5){
            if($thirdCount < 2){
//Manager
             $leader->user_title = 2;
            }else{
                if($thirdCount >= 2){
//Director
                 $leader->user_title = 3;
                }
            }
        }else{
            if($secondCount < 5){
//Executive
                $leader->user_title = 1;
            }
        }
    }

        //End
        $leader->save();

           return response()->json(['status'=>true,'message' =>'Welcome to our subscription panel']);
        }
    }

    public function unSubscribeStatus(Request $request){
        $unsubscribe = User::where('id','=',$request->id)->first();
        $unsubscribe->subscription = 0;
        $unsubscribe->user_title = null;
        if($unsubscribe->save()){
            return response()->json(['status'=>true,'message' =>'You unsubscribe from our premium services!']);
        }
    }
}
