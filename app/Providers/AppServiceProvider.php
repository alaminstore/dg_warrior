<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\JobPost;
use App\RevisionTask;
use App\SubmitTask;
use App\WithdrawStatus;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('backend.inc.header',function($view){
            // $joblists = JobPost::orderBy('id', 'DESC')->get()->take(4);
            $joblists = JobPost::where('job_status',0)->orderBy('id', 'DESC')->get()->take(4);
            $view->with('joblists',$joblists);
        });
        View::composer('backend.inc.header',function($view){
            $jobcount = JobPost::where('job_status',0)->get();
            $view->with('jobcount',$jobcount);
        });
        View::composer('backend.inc.header',function($view){
            $postedJob = JobPost::where('user_id',Auth::user()->id)->get();
            $view->with('postedJob',$postedJob);
        });
        View::composer('backend.inc.header',function($view){
            $submissionpending = SubmitTask::where('client_id',Auth::user()->id)->where('revision',null)->where('status',null)->get();
            $view->with('submissionpending',$submissionpending);
        });
        View::composer('backend.inc.header',function($view){
            $completedJob = SubmitTask::with("getUserName")->where('client_id',Auth::user()->id)->where('status',1)->get();
            $view->with('completedJob',$completedJob);
        });
        // View::composer('backend.inc.header',function($view){
        //     if(Auth::user()->role_id != null){
        //         $pending = SubmitTask::with("getUserName")->where('status',null)->get();
        //     }
        //     $view->with('pending',$pending);
        // });

        View::composer('backend.inc.header',function($view){
            $withdrawableList = WithdrawStatus::with('getUser')->where('withdraw_status', 0)->paginate(10);
            $view->with('withdrawableList',$withdrawableList);
        });
        View::composer('backend.inc.header',function($view){
            $withdrawCompleted = WithdrawStatus::with('getUser')->where('withdraw_status', 1)->paginate(10);
            $view->with('withdrawCompleted',$withdrawCompleted);
        });
        View::composer('backend.inc.header',function($view){
            $revisionList = RevisionTask::where('user_id',Auth::user()->id)->get();
            $view->with('revisionList',$revisionList);
        });

    }
}
