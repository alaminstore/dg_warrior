<?php

namespace App\Http\Controllers;

use App\AdminDetail;
use Illuminate\Support\Facades\Auth;
use App\ReferalTracking;
use App\JobPost;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\SubmitTask;
use App\AppliedJobStatus;
use App\DgManagerDue;
use App\RevisionTask;
use App\SubsNonSubsLimit;
use App\TaskCheck;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
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
    // public $totalUser = [];
    public function index(){
        // return view('home');
        $check = ReferalTracking::with('getUserName')->where('refered_user',Auth::user()->id)
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

 // Algo for finding 2nd-5th tier user list start
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
 //for 3rd tier list
     if($data2nd != null){

        for($range3=0;$range3<count($data2nd);$range3++){
            $check3rdTier = ReferalTracking::where('refered_user',$data2nd[$range3])
            ->select('user')->get();

            foreach($check3rdTier as $val){
                $data3rd[]=$val->user;
                $totalUser[]=$val->user;
            }
            if ($check3rdTier != null) {
                $total3rd+=count($check3rdTier);
             }
         }
 //for 4th tier list
        if($data3rd != null){
            for($range4=0;$range4<count($data3rd);$range4++){
                $check4thTier = ReferalTracking::where('refered_user',$data3rd[$range4])
                ->select('user')->get();

                foreach($check4thTier as $val){
                    $data4th[]=$val->user;
                    $totalUser[]=$val->user;
                }
                if ($check4thTier != null) {
                    $total4th+=count($check4thTier);
                }
             }
        }
    }
 }
    //  return $total2nd;
    //  return $data2nd;
    // return $data3rd;
    // return $data4th;
    // return $totalUser;
    $countUser = count($totalUser);
    session()->put('totalCountUser',$countUser);

        $i=0;
        $total = 0;
        for($i=0;$i<count($data);$i++){
            $ref = ReferalTracking::where('refered_user', '=', $data[$i])->get();
            if ($ref != null) {
               $total+=count($ref);
            }
        }
        // return $check;
        $fiveTiersUsersInfo = User::with('referrer')->whereIn('id',$totalUser)->get();
        $filter = [0,3];
        $AllForSuperAdmin = User::all();
        $sidebarNormalTask = JobPost::where('job_type',2)->whereIn('job_issuer_rank',$filter)->orderBy('id', 'DESC')->get()->take(4);
        $executiveTask = JobPost::where('job_type',2)->where('job_visibility',3)->where('user_id','!=',Auth::user()->id)->orderBy('id', 'DESC')->get()->take(4);
        $managerTask = JobPost::where('job_issuer_rank',10)->orderBy('id', 'DESC')->get()->take(4);
        return view('backend.dashboard',compact('check','total','data','data2nd','data3rd','data4th','data5th','fiveTiersUsersInfo','sidebarNormalTask','executiveTask','managerTask','totalUser','AllForSuperAdmin'));
    }

    public function userList(){
        $DeletePermissionOfAdmin = null;
        if(Auth::user()->role_id == 2){
            $token = AdminDetail::where('user_id','=',Auth::user()->id)->where('user_delete_power','=',1)->first();
            if($token != null){
                $DeletePermissionOfAdmin = true;
            }else{
                $DeletePermissionOfAdmin = false;
            }
        }
        $userLists = User::with('referrer')->where('role_id','=', null)->get();
        $adminInfo = User::with('getAdminRole')->where('role_id','=', 2)->get();
        // return $adminInfo;
        return view('backend.admin.userlist',compact('userLists','adminInfo','DeletePermissionOfAdmin'));
    }
    public function jobPost(){
        return view('backend.jobpost');
    }
    public function quickPass($id, $value)
    {
        if($id == 2){
          if($value > session()->get('totalCountUser')){
              return response()->json([
                'status' => 0,
                'userInTier' => session()->get('totalCountUser'),
                'message' => "You have not enough referral user in your tier!"
            ]);
            Session::forget('totalCountUser');
          }
        }
    }

    //Store Data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'job_title' => 'required | string | max: 80',
            'issue_type' => 'required',
            'job_price' => 'required',
            'job_worker' => 'required',
            'job_visibility' => 'required',
            'job_description' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            if(($request->job_price * $request->job_worker) > Auth::user()->balance){
                return response()->json([
                    'status' => 2,
                    'balanceWarning' => "Sorry You have not enough balance. Try Again with less amount."
                ]);
            }else{
                $jobpost = new JobPost();
                $jobpost->job_title = $request->job_title;
                $jobpost->issue_type = $request->issue_type;
                $jobpost->user_id = Auth::user()->id;
                $jobpost->job_issuer_rank = Auth::user()->user_title == null ? "0":Auth::user()->user_title;
                if($request->job_price>=6.00){
                    $jobpost->job_type = 1;
                }else{$jobpost->job_type = 2;}
                $newBalance = User::find(Auth::user()->id);
                $newBalance->balance = Auth::user()->balance - ($request->job_price * $request->job_worker);
                if($newBalance->balance < $newBalance->withdrawable){
                    $temp = $newBalance->withdrawable - $newBalance->balance;
                    $newBalance->withdrawable -=$temp;
                }
                $newBalance->save();

                $jobpost->job_price = $request->job_price;
                $jobpost->job_worker = $request->job_worker;
                $jobpost->job_visibility = $request->job_visibility;
                $jobpost->job_description = $request->job_description;
                // $jobpost->exp += ($request->job_price * $request->job_worker);
                if(Auth::user()->role_id == 1){
                    $jobpost->job_status = 1;
                }else{
                    $jobpost->job_status = 0;
                }

                $jobpost->user_name = Auth::user()->username;
                $jobpost->save();
                $userId = User::find(Auth::user()->id);
                $userId->exp += ($request->job_price * $request->job_worker);
                $expLastValue = ($userId->exp-50)/3;
                $levelRecheckAgain = pow($expLastValue, (1/3));
                $userId->level = (int) $levelRecheckAgain;
                $userId->save();

                return response()->json([
                    'status' => true,
                    'message' => "Your job posted Successfully!"
                ]);
            }
        }
    }

    public function viewJob($id){
        $data=JobPost::find($id);
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
    public function viewProofOfTask($id){
        $data=SubmitTask::find($id);
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
    public function viewRevisionSystem($id){
        $data=SubmitTask::find($id);
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

    public function joblist(){
        $joblists = JobPost::where('job_status',0)->get();
        $jobPricePermit = null;
        if(Auth::user()->role_id == 2){
            $token = AdminDetail::where('user_id','=',Auth::user()->id)->where('job_price_power','=',1)->first();
            if($token != null){
                $jobPricePermit = true;
            }else{
                $jobPricePermit = false;
            }
        }
        return view('backend.joblist',compact('joblists','jobPricePermit'));
    }
    public function destroy(Request $request){
        $subservice = JobPost::find($request->id);
        if($subservice->delete()){
            return response()->json(['status'=>true,'data' => $subservice]);
        }
    }
    public function userDestroy(Request $request){
        $userDelete = User::find($request->id);
        $availableInReferridIdOrNot = User::where('referrer_id','=',$request->id)->first();
        if($availableInReferridIdOrNot === null){
            if($userDelete->delete()){
                return response()->json(['status'=>true,'data' => $userDelete]);
            }
        }else{
            return response()->json(['status'=>false,'message' =>'Please remove this user\'s tier user\'s first!']);
        }

    }

    public function activeJob(Request $request){
        $jobpostId = JobPost::where('id','=',$request->jobpostId)->first();
        $jobpostId->job_status = 1;
        if($jobpostId->save()){
            return response()->json(['status'=>true,'message'=>"This job is activated successfully"]);
        }
    }

    public function availableJob(){
        $currentUser = Auth::user()->id;
        // ================================================================================================
        // Start
        $check = ReferalTracking::with('getUserName')->where('refered_user',Auth::user()->id)
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
 // Algo for finding 2nd-5th tier user list start
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
 //for 3rd tier list
     if($data2nd != null){

        for($range3=0;$range3<count($data2nd);$range3++){
            $check3rdTier = ReferalTracking::where('refered_user',$data2nd[$range3])
            ->select('user')->get();

            foreach($check3rdTier as $val){
                $data3rd[]=$val->user;
                $totalUser[]=$val->user;
            }
            if ($check3rdTier != null) {
                $total3rd+=count($check3rdTier);
             }
         }
 //for 4th tier list
        if($data3rd != null){
            for($range4=0;$range4<count($data3rd);$range4++){
                $check4thTier = ReferalTracking::where('refered_user',$data3rd[$range4])
                ->select('user')->get();

                foreach($check4thTier as $val){
                    $data4th[]=$val->user;
                    $totalUser[]=$val->user;
                }
                if ($check4thTier != null) {
                    $total4th+=count($check4thTier);
                 }
             }
        }
    }
 }

        $secondCount = count($data);
        $thirdCount = count($data2nd);
        if($secondCount>=5){
            if($thirdCount>=2){
                $thirdRemainder = $thirdCount % 2;
                if($thirdRemainder == 0){
                    $secondTierShould = ($thirdCount * 5)/2;
                    if($secondCount>=$secondTierShould){
                        $viewJob=0;
                        $viewJob = $thirdCount / 2;
                    }else{
                        $secondRemainder = $secondCount % 5;
                        $eligibleSecondTier = $secondCount - $secondRemainder; //5
                        $viewJob = 0;
                        $doubleJob = (2 * $eligibleSecondTier) / 5;
                        $viewJob = $doubleJob / 2;
                    }
                }else{
                    $eligibleThirdTier = $thirdCount - 1;
                    $secondTierShould2 = ($eligibleThirdTier * 5)/2;
                    if($secondCount>=$secondTierShould2){
                        $viewJob = 0;
                        $viewJob = $thirdCount/2;
                    }else{
                        $secondRemainder2 = $secondCount % 5;
                        $eligibleSecondTier2 = $secondCount - $secondRemainder2;
                        $viewJob = 0;
                        $doubleJob = (2 * $eligibleSecondTier2) / 5;
                        $viewJob = $doubleJob / 2;
                    }

                }
            }
        }else{
            $viewJob = 0;
        }
        // return count($totalUser);

        $availableJob = JobPost::where('job_status',1)->where('job_type',1)->where('job_worker','!=',0)->where('user_id','!=',Auth()->user()->id)->get()->take($viewJob);
        $normalJob = JobPost::where('job_status',1)->where('job_worker','!=',0)->where('user_id','!=',Auth()->user()->id)->where('job_type',2)->orderBy('id', 'DESC')->paginate(5);
        $appliedjobStatus = new AppliedJobStatus();
        return view('backend.availablejob',compact('availableJob','appliedjobStatus','totalUser','normalJob'));
    }
    public function AvailableJobById($id){
        $availableJobId = JobPost::find(Crypt::decrypt($id));
        // return $availableJobId;
        return view('backend.availablejobDetails',compact('availableJobId'));
    }
    public function submitJob($id){
        $submitJob = JobPost::find(Crypt::decrypt($id));
        // return $submitJob;
        return view('backend.submitJob',compact('submitJob'));
    }

    public function submitTaskStore(Request $request){
        $request->validate([
            'proof_text'        => 'required | string| max:500',
            'proof_image'        => 'max:800'
        ]);
        DB::beginTransaction();
        try {
            $submitTask                  = new SubmitTask();
            $submitTask->user_id         = $request->user_id;
            $submitTask->client_id       = $request->client_id;
            $submitTask->job_id          = $request->job_id;
            $submitTask->proof_text      = $request->proof_text;
            $submitTask->job_price      = $request->job_price;
            if ($request->hasFile('proof_image')) {
                $path = 'images/proofImage/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $image = $request->proof_image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();
                $image->move($path, $imageName);
                $submitTask->proof_image = $path . $imageName;
            }
            $alreadySubmitOrNot = SubmitTask::where('user_id','=',$request->user_id)->where('job_id','=',$request->job_id)->first();
            if(!$alreadySubmitOrNot){
                $submitTask->save();
                $executiveNormalLimit = JobPost::where('id',$request->job_id)->first();
                if($executiveNormalLimit){
                    if($executiveNormalLimit->job_type == 2 && $executiveNormalLimit->job_issuer_rank != 10){
                        $limitTask = SubsNonSubsLimit::where('user_id',Auth::user()->id)->first();
                        if($limitTask){
                            if(Auth::user()->subscription == 1){
                               if($limitTask->limit >= 12){
                                $notification = array('message' => 'Sorry Your today\'s job applied limit is over.', 'alert-type'=> 'warning');
                                return redirect()->back()->with($notification);
                               }else{
                                $limitTask->limit += 1;
                                $limitTask->save();
                               }
                            }else{
                                if($limitTask->limit >= 6){
                                 $notification = array('message' => 'Sorry Your today\'s job applied limit is over.Subscribe to increase the limit', 'alert-type'=> 'warning');
                                 return redirect()->back()->with($notification);
                                }else{
                                 $limitTask->limit += 1;
                                 $limitTask->save();
                                }
                            }
                        }else{
                            $limitTask = new SubsNonSubsLimit();
                            $limitTask->user_id = Auth::user()->id;
                            $limitTask->limit = 1;
                            $limitTask->save();

                        }

                    }
                }

            }else{
                $notification = array('message' => 'You already submitted the task, try another job!', 'alert-type'=> 'error');
                return redirect()->back()->with($notification);
            }
            $appliedjobstatus = new AppliedJobStatus();
            $appliedjobstatus->user_id = $request->user_id;
            $appliedjobstatus->jobpost_id = $request->job_id;
            $appliedjobstatus->status = 0;
            $appliedjobstatus->save();

            $jobpostWorkersNumberUpdate = JobPost::find($request->job_id);
            $jobpostWorkersNumberUpdate->job_worker = $jobpostWorkersNumberUpdate->job_worker-1;
            $jobpostWorkersNumberUpdate->already_applied +=1;
            $jobpostWorkersNumberUpdate->save();

            if($request->job_type == 1){
                $dailyTask = TaskCheck::where('user_id', Auth::user()->id)->first();
                $OfferValidity = new TaskCheck();
                $OfferValidity->user_id = Auth::user()->id;
                if($dailyTask){$OfferValidity->condition = 2;}else{$OfferValidity->condition = 1;}
                $OfferValidity->save();
            }
            DB::commit();
            $notification = array('message' => 'Your Job Submitted Successfully.', 'alert-type'=> 'success');
            return redirect()->route('available.job')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
            return redirect()->route('jobsubmit.store')->with($notification);
        }
    }

    public function postedJob(){
        $postedJob = JobPost::where('user_id',Auth::user()->id)->get();
        return view('backend.postedjob',compact('postedJob'));
    }
    public function submissionPending(){
        $jobPower = null;
        if(Auth::user()->role_id != null){
            $submissionpending = SubmitTask::with("getUserName")->where('revision',null)->where('status',null)->get();
        if(Auth::user()->role_id == 2){
            $token = AdminDetail::where('user_id','=',Auth::user()->id)->where('job_power','=',1)->first();
            if($token != null){
                $jobPower = true;
            }else{
                $jobPower = false;
            }
        }
        }else{
           $submissionpending = SubmitTask::with("getUserName")->where('client_id',Auth::user()->id)
                                                                ->where('revision',null)
                                                                ->where('status',null)->get();
        }
        // return $submissionpending;
        return view('backend.submissionpending',compact('submissionpending','jobPower'));
    }
    public function submitTaskStatus(Request $request){
        $statusCondition = SubmitTask::find($request->hiddenAccept);
        $jobPostId = JobPost::find($request->hiddenJobId);

        $candidateUser = User::find($request->hiddenUserId);
        if($statusCondition){
            $statusCondition->status = 1;
            $statusCondition->save();
            // $request->hiddenUserId
            $HrPostOrNot = TaskCheck::where('user_id',$request->hiddenUserId)->first();
            if($HrPostOrNot){
                $freeCuponSbmission = TaskCheck::where('user_id',$request->hiddenUserId)->where('condition','=',1)->first();
                $fromSecondSubmissionDaily = TaskCheck::where('user_id',$request->hiddenUserId)->where('condition','=',2)->first();
                if($freeCuponSbmission && $fromSecondSubmissionDaily === null){
                   //   user get full payment(1st unlocked hR free in a day)

                  $candidateUser->exp += $statusCondition->job_price;
                  $expLastAmount = ($candidateUser->exp-50)/3;
                  $levelRecheckAfterTaskApprove = pow($expLastAmount, (1/3));
                  $candidateUser->level = (int) $levelRecheckAfterTaskApprove;

                  $candidateUser->balance =$candidateUser->balance + $statusCondition->job_price + ($candidateUser->level * .01);
                  $candidateUser->completed_job+=1;
                  $candidateUser->withdrawable+=$statusCondition->job_price + ($candidateUser->level * .01);
                  $candidateUser->save();
                }
                if($fromSecondSubmissionDaily){
                //  Deduct 1$
                  $candidateUser->exp += $statusCondition->job_price-1;
                  $expLastAmount = ($candidateUser->exp-50)/3;
                  $levelRecheckAfterTaskApprove = pow($expLastAmount, (1/3));
                  $candidateUser->level = (int) $levelRecheckAfterTaskApprove;

                  $candidateUser->balance =$candidateUser->balance + $statusCondition->job_price-1 + ($candidateUser->level * .01);
                  $candidateUser->completed_job+=1;
                  $candidateUser->withdrawable+=$statusCondition->job_price-1 + ($candidateUser->level * .01);
                  $candidateUser->save();
                }
            }else{

                if($jobPostId->	job_issuer_rank == 10){
                    $dgTableOrNot = DgManagerDue::where('user_id',$candidateUser->id)->orderBy('id', 'DESC')->first();
                    if($dgTableOrNot){
                        $candidateUser->balance += $dgTableOrNot->manager_due_payment;
                        $candidateUser->completed_job+=1;
                        $candidateUser->withdrawable+=$dgTableOrNot->manager_due_payment;
                        if($candidateUser->save()){
                            $dgTableOrNot->delete();
                        }
                    }
                }else{
                    // normal task complete's rules
                    $candidateUser->balance += $statusCondition->job_price;
                    $candidateUser->completed_job+=1;
                    $candidateUser->withdrawable+=$statusCondition->job_price;
                    $candidateUser->save();
                }
            }
            return response()->json([
                'status'=>true,
                'message' =>"You allowed the 'submitted task' of your job"
            ]);
        }
    }
    public function rejectSubmitTask(Request $request){
        $statusCondition = SubmitTask::find($request->hiddenReject);
        $statusCondition->status = 2;
        $statusCondition->save();
        $jobpostWorkersNumberUpdate = JobPost::find($statusCondition->job_id);
        $jobpostWorkersNumberUpdate->job_worker +=1;
        $jobpostWorkersNumberUpdate->already_applied -=1;
        $jobpostWorkersNumberUpdate->save();
        return response()->json([
            'status'=>true,
            'message' =>"You reject the 'submitted task' of your job"
        ]);
    }

    public function completedJob(){

        $completedJob = SubmitTask::with("getUserName")->where('client_id',Auth::user()->id)
                                                       ->where('status',1)->get();
        return view('backend.completedtask',compact('completedJob'));
    }

    public function balanceUpdate(Request $request){
        $theUser = User::find(Auth::user()->id);
        $theUser->balance+=$request->balance;
        $theUser->exp+=$request->balance;
        $expLast = ($theUser->exp-50)/3;
        $levelRecheck = pow($expLast, (1/3));
        $theUser->level = (int) $levelRecheck;

        $referrerUser = User::find($theUser->referrer_id);
        if($referrerUser){
            $referrerUser->balance += $request->balance * 0.1;
            $referrerUser->save();
        }
        if($theUser->save()){
            return response()->json([
                'status'=>true,
                'message'=>'Rehearse successfully!'
            ]);
        }
    }

    public function revisionSubmit(Request $request){

        $validator = Validator::make($request->all(),[
            'instruction' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $submitTask = SubmitTask::find($request->submit_id);
            $submitTask->revision = "1";
            $submitTask->save();
            $revision = new RevisionTask();
            $revision->user_id = $request->user_id;
            $revision->client_id = $request->client_id;
            $revision->job_id = $request->job_id;
            $revision->submittask_id = $request->submit_id;
            $revision->instruction = $request->instruction;
            if($revision->save()){
                return response()->json([
                    'status' => true,
                    'message' => "You provided the resubmission chance!"
                ]);
            }
        }
    }
    public function revisionView(){
        $revisionList = RevisionTask::with('getJobPost')->where('user_id', Auth::user()->id)->get();
        return view('backend.revision_task',compact('revisionList'));
    }
    public function viewInstruction($id){
        $data=RevisionTask::find($id);
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

    public function reSubmitTaskStore(Request $request){
        $validator = Validator::make($request->all(),[
            'proof_text' => 'required|max:1000',
            'proof_image'        => 'max:800'

        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $resubmit = SubmitTask::Find($request->submittask_id);
            $resubmit->proof_text = $request->proof_text;
            $resubmit->revision = null;
            if ($request->hasFile('proof_image')) {
                $path = 'images/proofImage/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $image = $request->proof_image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();
                $image->move($path, $imageName);
                $resubmit->proof_image = $path . $imageName;
            }
            $resubmit->save();
            $revisionDelete = RevisionTask::find($request->revision_id);
            if($revisionDelete->delete()){
                return response()->json(['status'=>true]);
            }



        }
    }
}
