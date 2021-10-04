<?php

namespace App\Http\Controllers;

use App\AdminDetail;
use App\DgManagerDue;
use App\SubmitTask;
use App\TrxId;
use App\User;
use App\WithdrawStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function myProfile(){
        return view('backend.profile.myprofile');
    }

    public function updated(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:80',
            'birth_date' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $admin = User::find($request->user_id);
            $admin->name = $request->name;
            $admin->birth_date = $request->birth_date;
            $admin->address = $request->address;
            $admin->city = $request->city;
            $admin->zipcode = $request->zipcode;
            $admin->state = $request->state;
            if($admin->save()){
                return response()->json(['status'=>true]);
            }
        }
    }
    public function edit($id){
        $data = User::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }
    public function updatedImage(Request $request){

        $profileImage = User::find($request->user_id);
        if ($request->hasFile('image')) {
            $path = 'images/users/';
            @unlink($profileImage->image);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $profileImage->image = $path . $imageName;
        }
        if($profileImage->save()){
            return response()->json(['status'=>true]);
        }
    }

    public function withdrawStatus(Request $request){

        $validator = Validator::make($request->all(),[
            'wallet_address' => 'required',
            'withdraw_amount' => 'required'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $withdraw = new WithdrawStatus();
            $withdraw->wallet_name = $request->wallet_name;
            $withdraw->user_id = $request->user_id;
            $withdraw->wallet_address = $request->wallet_address;
            $withdraw->request_time = Carbon::now();
            $withdraw->withdraw_status = 0;
            if($request->withdraw_amount >= 15){
                if(Auth::user()->withdrawable >= $request->withdraw_amount){
                    $withdraw->withdraw_amount = $request->withdraw_amount;
                    $usr = User::find($request->user_id);
                    $usr->withdrawable -=$request->withdraw_amount;
                    $usr->save();
                    if($withdraw->save()){
                        return response()->json(['status'=>true]);
                    }
                }else{
                    return response()->json(['status'=> 2,'notification'=>'Sorry You have not enough withdrawable amount!']);
                }
            }else{
                return response()->json(['status'=> 3,'message'=>'Sorry! Minimum withdrawable amount is, $15']);
            }
        }
    }
    public function withdrawView(){

        $jobPower = null;
        if(Auth::user()->role_id != null){
            $withdrawableList = WithdrawStatus::with('getUser')->where('withdraw_status', 0)->paginate(10);
        if(Auth::user()->role_id == 2){
            $token = AdminDetail::where('user_id','=',Auth::user()->id)->where('job_power','=',1)->first();
            if($token != null){
                $jobPower = true;
            }else{
                $jobPower = false;
            }
        }
        }else{
            $withdrawableList = WithdrawStatus::with('getUser')->where('withdraw_status', 0)->paginate(10);
        }
        // return $withdrawableList;
        return view('backend.withdrawable.withdraw_req',compact('withdrawableList','jobPower'));
    }

    public function topupReq(){
        $jobPower = null;
        if(Auth::user()->role_id != null){
            if(Auth::user()->role_id == 2){
                $token = AdminDetail::where('user_id','=',Auth::user()->id)->where('user_delete_power','=',1)->first();
                if($token != null){
                    $jobPower = true;
                }else{
                    $jobPower = false;
                }
            }
            $topupReq = TrxId::with('getUser')->where('status',0)->orderBy('id', 'DESC')->get();
            return view('backend.TopupUsd.topup_req',compact('topupReq','jobPower'));
        }
    }
    public function acceptWithdrawCompleted(){
        $withdrawableList = WithdrawStatus::with('getUser')->where('withdraw_status', 1)->paginate(10);
        // return $withdrawableList;
        return view('backend.withdrawable.withdraw_complete',compact('withdrawableList'));
    }
    public function acceptWithdrawRequest(Request $request){
        $acceptRequest = WithdrawStatus::find($request->id);
        $acceptRequest->withdraw_status = 1;
        $acceptRequest->accept_time = Carbon::now();
        if($acceptRequest->save()){
            return response()->json(['status'=>true,'message' =>'You accept the withdrawable Request!']);
        }
    }
    public function trxidAcceptRequest(Request $request){
        $trxid = TrxId::find($request->id);
        $theUser = User::find($trxid->user_id);
        $theUser->balance+=$trxid->balance;
        $theUser->recharge+=$trxid->balance;
        $theUser->exp+=$trxid->balance;
        $expLast = ($theUser->exp-50)/3;
        $levelRecheck = pow($expLast, (1/3));
        $theUser->level = (int) $levelRecheck;

        $referrerUser = User::find($theUser->referrer_id);
        if($referrerUser){
            $referrerUser->manager_task_access = 1;
            $referrerUser->sales_achieved+= $trxid->balance;
            $DgManagerDue = new DgManagerDue();
            $DgManagerDue->user_id = $referrerUser->id;
            $DgManagerDue->manager_due_payment = (float) .08*$trxid->balance;
            if($DgManagerDue->save()){
                $referrerUser->save();
            }
        }
        if($theUser->save()){
            $trxid->status = 1;
            $trxid->accept_time = Carbon::now();
            $trxid->save();
            return response()->json([
                'status'=>true,
                'notice'=>'Sucessfully approved the topup request!'
            ]);
        }
    }
    public function settings(){
        return view('backend.reset.passchange');
    }

    public function oldPass(Request $request){
        $request->validate([
            'oldpass' => 'required|string',
        ]);
        // $oldPass = bcrypt($request->oldpass);
        $oldPass = $request->oldpass;
        $user = Auth::user();
        $userInfo = $user->password;
        if($userInfo){
           if(Hash::check($request->oldpass, $userInfo)){
            return response()->json(['success'=>true]);
           }else{
            return response()->json(['success'=>false]);
           }
        }
    }

    public function newPass(Request $request){
        $validator = Validator::make($request->all(),[
            'newPass' => 'required|string|min:8',
            'confirmPass' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = Auth::user();
            $available = $user->id;
            if($available){
                $newpass = $request->newPass;
                $confirmpass = $request->confirmPass;
                if($newpass == $confirmpass ){
                    $user->password = bcrypt($newpass);
                    // dd($newpass);
                    $user->save();
                    // $pass = $request->newPass;
                    return response()->json([
                        'success'=>true,
                    ]);
                }else{
                    return response()->json(['success'=>false]);
                }
            }
        }

    }
    public function topupAccepted(){
        $trxid = TrxId::where('status',1)->orderBy('id', 'DESC')->get();
        return view('backend.TopupUsd.topup_accepted',compact('trxid'));
    }

}
