<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user-management', 'HomeController@userList')->middleware('admincheck');
Route::get('/subscribe-status','SubcriptionColtroller@subscribeStatus')->name('subscribe.status');
Route::get('/unsubscribe-status','SubcriptionColtroller@unSubscribeStatus')->name('unsubscribe.status');
Route::get('/job-post', 'HomeController@jobPost')->name('dashboard.jobpost');
Route::get('/posted-job','HomeController@postedJob')->name('posted.job');
Route::group(['middleware'=>['usercheck']], function(){

    Route::get('available-job','HomeController@availableJob')->name('available.job');

    Route::get('/activity', 'SubcriptionColtroller@show')->name('activity');
});
Route::get('get-jobtype/{id}/{value}','HomeController@quickPass');
Route::post('job-post/store', 'HomeController@store')->name('jobpost.store');
Route::post('job-active/store', 'HomeController@activeJob')->name('activejob.store');
Route::post('submit-task/update', 'HomeController@submitTaskStatus')->name('submittask.update');
Route::post('balance/update', 'HomeController@balanceUpdate')->name('balance.update');
Route::post('job-submit/store', 'HomeController@submitTaskStore')->name('jobsubmit.store');
Route::get('jobdetails/{id}', 'HomeController@viewJob')->name('jobdetails.view');
Route::get('proofOfTask/{id}', 'HomeController@viewProofOfTask')->name('viewProofOfTask.view');
Route::get('revisionSystem/{id}', 'HomeController@viewRevisionSystem')->name('revisionSystem.view');
Route::get('waiting-job', 'HomeController@joblist')->name('joblist.show');
Route::get('taskdelete','HomeController@destroy')->name('task.destroy');
Route::get('userdelete','HomeController@userDestroy')->name('user.destroy');
Route::post('rejecttaskdelete','HomeController@rejectSubmitTask')->name('rejecttask.destroy');
Route::get('available-job/{id}','HomeController@AvailableJobById')->name('availableById.job');
Route::get('submit-job/{id}','HomeController@submitJob')->name('submit.job');
Route::get('/submission-pending','HomeController@submissionPending')->name('submissionpending.job');
Route::get('/job-complete','HomeController@completedJob')->name('completed.job');
Route::get('/my-profile','MyProfileController@myProfile')->name('my.profile');
Route::post('/create-admin', 'AdminRoleController@adminStore')->name('admin.create');
Route::get('/jobdelete-status','AdminRoleController@jobDeleteStatus')->name('jobdelete.status');
Route::get('/jobpower-status','AdminRoleController@jobPowerStatus')->name('jobpower.status');
Route::get('/jobprice-status','AdminRoleController@jobPriceStatus')->name('jobprice.status');
Route::get('admindetails/{id}/edit', 'AdminRoleController@edit');
Route::get('balancedetails/{id}/edit', 'AdminRoleController@balanceEdit');
Route::get('userbalancedetails/{id}/edit', 'AdminRoleController@userBalanceEdit');
Route::post('admindetails/updated', 'AdminRoleController@updated')->name('admin.updated');
Route::post('balance/editing', 'AdminRoleController@balanceEditing')->name('balance.editing');
Route::post('profileInfo/updated', 'MyProfileController@updated')->name('profileInfo.updated');
Route::post('balance/change', 'AdminRoleController@balanceChange')->name('balance.change');
Route::get('portfolio-image/{id}/edit', 'MyProfileController@edit')->name('backend.portfolioimageEdit');
Route::post('image-updated', 'MyProfileController@updatedImage')->name('backend.portfolioimage');
Route::post('withdraw-request/save', 'MyProfileController@withdrawStatus')->name('withdraw.request');
Route::get('withdrawable-req','MyProfileController@acceptWithdrawRequest')->name('withdrawable.req');
Route::get('withdraw-request', 'MyProfileController@withdrawView')->name('withdrawview.request')->middleware('admincheck');
Route::get('withdraw-completed','MyProfileController@acceptWithdrawCompleted')->name('withdraw.complete')->middleware('admincheck');
Route::post('revision-chance', 'HomeController@revisionSubmit')->name('revision.Submit');
Route::get('task-revision', 'HomeController@revisionView')->name('revision.view');
Route::get('view-instruction/{id}', 'HomeController@viewInstruction')->name('viewInstruction.show');
Route::post('job-resubmit/store', 'HomeController@reSubmitTaskStore')->name('jobresubmit.store');
Route::get('/settings','MyProfileController@settings');
Route::post('old-password', 'MyProfileController@oldPass')->name('reset.check');
Route::post('change-password', 'MyProfileController@newPass')->name('newPass.change');

// FrontEnd Controller
Route::get('/', 'FrontEndController@index')->name('frontend');
Route::get('/about-us', 'FrontEndController@aboutUs')->name('frontend');
Route::get('/privacy-policy', 'FrontEndController@privacyPolicy');
Route::get('/terms-conditions', 'FrontEndController@termsCondition');
Route::post('send-email', 'EmailController@send')->name('send.email');

//Payment System
Route::get('/thank-you','ThankYouController@thankYou')->name('thank.you');
Route::get('/webhook','ThankYouController@webHook')->name('web.hook');
Route::post('/webhook-info','ThankYouController@webHookInfo')->name('webHookInfo');
Route::get('/webhook-info','ThankYouController@webHookInfoget')->name('webHookInfo');
Route::get('/pm-info','PaymentController@paymentFile')->name('pm.file');


// another payment(airtm)
Route::get('/canceled','PaymentController@paymentCancel')->name('airtm.cancel');
Route::get('/confirmed','PaymentController@paymentDone')->name('airtm.done');
Route::post('curl','PaymentController@paymentReq')->name('airtm.req');
