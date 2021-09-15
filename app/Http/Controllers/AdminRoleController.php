<?php

namespace App\Http\Controllers;

use App\AdminDetail;
use App\JobPost;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminRoleController extends Controller
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

    //Store Data
    public function adminStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required | string | max: 80',
            'username' => ['required', 'string', 'min:3', 'max:30','unique:users',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required', 'string'],
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->country = $request->country;
            $user->password = bcrypt($request->password);
            $user->role_id = 2;
            $user->email_verified_at = Carbon::now();
            $user->save();
            if($user->save()){
                $adminInfo = $user->id;
                $adminData = new AdminDetail();
                $adminData->user_id = $adminInfo;
                $adminData->user_delete_power = "0";
                $adminData->job_power = "1";
                $adminData->job_price_power = "0";
                if($adminData->save()){
                    return response()->json(['status'=>true,'message'=>'Admin created successfully!']);
                }
            }
        }
    }
    public function edit($id)
    {
        $data  = User::find($id);
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
    public function balanceEdit($id)
    {
        $data  = JobPost::find($id);
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
    public function userBalanceEdit($id)
    {
        $data  = User::find($id);
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

    public function jobDeleteStatus(Request $request){
        $findJob = AdminDetail::where('user_id','=',$request->jobid)->first();
        $findJob->user_delete_power = $request->id;
        if($findJob->save()){
            return response()->json(['status'=>true]);
        }
    }
    public function jobPowerStatus(Request $request){
        $findJob = AdminDetail::where('user_id','=',$request->jobid)->first();
        $findJob->job_power = $request->id;
        if($findJob->save()){
            return response()->json(['status'=>true]);
        }
    }
    public function jobPriceStatus(Request $request){
        $findJob = AdminDetail::where('user_id','=',$request->jobid)->first();
        $findJob->job_price_power = $request->id;
        if($findJob->save()){
            return response()->json(['status'=>true]);
        }
    }
    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:80',
            'username' => 'required|unique:users,username,'.$request->admin_id.',id',
            'email' => 'required|unique:users,email,'.$request->admin_id.',id',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $admin = User::find($request->admin_id);
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            if($admin->save()){
                return response()->json(['status'=>true]);
            }
        }
    }

    public function balanceChange(Request $request){

        $validator = Validator::make($request->all(),[
            'job_price' => 'required',
            'job_title' => 'required|max:80',
            'job_description' => 'required'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $jobprice = JobPost::find($request->job_id);
            $jobprice->job_title = $request->job_title;
            $jobprice->job_description = $request->job_description;
            $jobprice->job_price = $request->job_price;
            $jobprice->job_worker = $request->job_worker;
            if($request->job_price>=6.00){
                $jobprice->job_type = 1;
            }else{$jobprice->job_type = 2;}
            if($jobprice->save()){
                return response()->json(['status'=>true,'message'=>'You changed the job requirements.']);
            }
        }
    }
    public function balanceEditing(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'balance' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $new_balance = (float) $request->balance;
            $old_balance = (float) $request->old_balance;
            $balance = User::find($request->user_id);
            if($new_balance < $old_balance){
                if($new_balance < $request->old_withdrawable){
                    $minusAmount = (float) $request->old_withdrawable - (float) $new_balance;
                    $balance->withdrawable -=  (float) $minusAmount;
                    $balance->balance = (float) 0;
                }else{
                    $minusBalance = (float) $balance->balance -  (float) $new_balance;
                    $balance->balance -= (float) $minusBalance;
                }
            }else{$balance->balance = $new_balance;}
            if($balance->save()){
                return response()->json(['status'=>true]);
            }
        }
    }
}
