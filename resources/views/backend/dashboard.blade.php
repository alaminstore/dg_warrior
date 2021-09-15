@extends('backend.home')
@section('title','DG Warrior | Dashboard')
@section('style')
{{-- datatable --}}
<link href="{{ asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<style>.topup {display: flex;justify-content: center;align-items: baseline;padding-bottom: 15px;}.select2-container--default .select2-selection--single .select2-selection__rendered {color: #fff;}.level_recruit {display: flex;flex-wrap: wrap;justify-content: space-around;align-items: baseline;}.form-group.payment_lay {display: flex;flex-wrap: wrap;justify-content: space-between;align-items: center;}button.btn.btn-sm.btn-success.btn-flex {display: flex;justify-content: space-between;align-items: center;}.subsPortion {display: flex;flex-wrap: wrap;justify-content: space-between;align-items: center;}.card-item {display: flex;flex-wrap: wrap;justify-content: space-between;align-items: center;}</style>
<!-- Main Content-->
<div class="main-content pt-0">
   <div class="container">

      <!-- Page Header -->
      <div class="page-header">
         <div>
            <h2 class="main-content-title tx-24 mg-b-5">Welcome To DG WARRIOR</h2>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
         </div>
      </div>
      <!-- End Page Header -->
      <!--Row-->
      <div class="row row-sm">
         <div class="col-sm-12 col-lg-12 col-xl-8">
           <!--Row-->
           <div class="row row-sm  mt-lg-4">
            <div class="col-sm-12 col-lg-12 col-xl-12">
               <div class="card bg-primary custom-card card-box">
                  <div class="card-body p-4">
                     <div class="row align-items-center">
                        <div class="offset-lg-4 offset-sm-6 col-lg-8 col-sm-6 col-12">

                        <div class="level_recruit">
                            <h4 class="d-flex  mb-3">
                              <span class="font-weight-bold text-white ">{{Auth::user()->username}} &nbsp;&nbsp;&nbsp;
                                 @if (Auth::user()->role_id == null)
                                 <span class="bg">[{{Auth::user()->level == null ? "0" : Auth::user()->level}}]</span> <sup>level</sup> </span>
                                 @else
                                 <span style="background:rgba(0, 128, 0, 0.466);padding:2px 5px;">{{Auth::user()->role_id == 2 ? "Admin" : ""}}</span></span>
                                 @endif
                            </h4>
                            @if (Auth::user()->subscription == 1)
                            <span style="background:#15A552;padding: 4px 11px;border: 1px solid #02a346;color: #fff;font-size: 12px;border-radius: 3px;"><i class="fa fa-user"></i> {{ Auth::user()->user_title == 1 ? "DG Executive" : "" }}{{ Auth::user()->user_title == 2 ? "DG Manager" : "" }}{{ Auth::user()->user_title == 3 ? "DG Director" : "" }}</span>
                            @endif
                            @if (Auth::user()->role_id == null)
                            <span id="ref" style="display: none">{{ Auth::user()->referral_link }}</span>
                            <button type="button" class="btn  btn-sm btn-success" id="btn_cop" onclick="copyToClipboard('#ref')">
                                <i class="fa fa-copy"></i> Recruit Now
                            </button>
                            @endif
                        </div>
                           <p class="tx-white-7 mb-1">
                               ***Complete objective task to level up or issue a task of your own.
                            </p>
                        </div>
                        <img src="{{asset('backend/assets/img/pngs/work3.png')}}" alt="user-img">
                     </div>
                  </div>
               </div>
            </div>
         </div>

            <div class="row row-sm">
               <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                  <div class="card custom-card">
                     <div class="card-body">
                        <div class="card-item">
                           <div class="card-item-icon card-icon">
                              <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect height="14" opacity=".3" width="14" x="5" y="5"/><g><rect fill="none" height="24" width="24"/><g><path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z"/><rect height="5" width="2" x="7" y="12"/><rect height="10" width="2" x="15" y="7"/><rect height="3" width="2" x="11" y="14"/><rect height="2" width="2" x="11" y="10"/></g></g></g></svg>
                           </div>
                           <div class="card-item-title mb-2">
                              <label class="main-content-label tx-13 font-weight-bold mb-1">Total Revenue</label>
                              <span class="d-block tx-12 mb-0 text-muted">Previous month vs this months</span>
                           </div>
                           <div class="card-item-body">
                              <div class="card-item-stat">
                                 <h4 class="font-weight-bold">${{ Auth::user()->balance }}</h4>
                                 <small style="color:#000;"><b class="text-success"></b> DG WARRIOR</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                  <div class="card custom-card">
                     <div class="card-body">
                        <div class="card-item">
                           <div class="card-item-icon card-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
                           </div>
                           <div class="card-item-title mb-2">
                              <label class="main-content-label tx-13 font-weight-bold mb-1">{{ Auth::user()->role_id == null ? "Your Perticipent" : "All Employee" }} </label>
                              <span class="d-block tx-12 mb-0 text-muted">Employees joined this month</span>
                           </div>
                           <div class="card-item-body">
                              <div class="card-item-stat">
                                 <h4 class="font-weight-bold">{{ Auth::user()->role_id == null ? count($totalUser) : count($AllForSuperAdmin) }}</h4>
                                 <small style="color:#000;"><b class="text-success"></b> DG WARRIOR</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                  <div class="card custom-card">
                     <div class="card-body">
                        <div class="card-item">
                           <div class="card-item-icon card-icon">
                              <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/></svg>
                           </div>
                           <div class="card-item-title  mb-2">
                              <label class="main-content-label tx-13 font-weight-bold mb-1">Recharged</label>
                              <span class="d-block tx-12 mb-0 text-muted">Recharge Account Balance</span>
                           </div>
                           <div class="card-item-body">
                              <div class="card-item-stat">
                                 <h4 class="font-weight-bold">${{ Auth::user()->recharge == null ? "0": Auth::user()->recharge }}</h4>
                                 <small style="color:#000;"><b class="text-danger"></b> DG WARRIOR</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             @if(Auth::user()->role_id == null)
            <div class="row row-sm">
               <div class="col-sm-12 col-lg-12 col-xl-12">
                  <div class="card custom-card overflow-hidden">

                     <div class="card-body p-0">
                        <div class>
                           <div class="container">
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                @if (Auth::user()->role_id == null)
                                    <div class="topup">
                                        <button type="button" class="btn btn-sm btn-warning" style="color:#000;" data-toggle="modal" data-target="#staticBackdrop">
                                            <i class="fa fa-plus"></i> Topup
                                        </button>
                                    </div>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            <span class="font-weight-bold">Topup</span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                        </button>
                                        </div>
                                        {{-- <div class="modal-body">
                                            {!!Form::open(['class' => 'form-horizontal','id'=>'topupMoney'])!!}
                                            @csrf
                                            <input class="form-control" type="number" min="1"  name="balance" placeholder="Balance Add..." required>
                                            </div>
                                            <div class="modal-footer">
                                                <button  type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Topup</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        {!!Form::close()!!} --}}
                                        <div class="modal-body">
                                            {{-- <select class="form-control topupBalance" style="width:80%;" id="select-id">
                                                <option value="">Amount Select...</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=5&type=digital&qty=1&signature=8b4c894b157fb3170de13f43c406bfaa58fd5947a19152e115850036262c6343">$5</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=http%3A%2F%2Fdgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=10&type=digital&qty=1&signature=1570e7b18da7dd34e145898da448413e29b271cde74a254aab075ee76185097e&DOTEST=1">$10</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=15&type=digital&qty=1&signature=336985aa785b64691a1736ed7eaee042002fd91f5280f89158dfd589c71d2c4f">$15</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=25&type=digital&qty=1&signature=20fa97805b3e23da5f7a0ea63650acecaa7a3520d9230270cde9185e161958d6">$25</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=50&type=digital&qty=1&signature=561de637a1f7f734c9f517aa7b90d2a40b9083c3b3ca7842fe579e76b68e7baa">$50</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=75&type=digital&qty=1&signature=c08711c04780e3efce9d91e1d7d5e5ef2315a2e397fc7b9f174a604e244e4825">$75</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=100&type=digital&qty=1&signature=264b0e4bf2652b683cf62736b2d7eed930970e892e766dac3e449ae5a2cc3f31">$100</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=200&type=digital&qty=1&signature=23e65e6aa9d572a74dd522ef2e08eb8ed4091224819b0ef5390f0c85a441a2cd">$200</option>
                                                <option value="https://secure.2checkout.com/checkout/buy?merchant=251369464878&dynamic=1&currency=USD&return-url=https%3A%2F%2Fwww.dgwarrior.com%2Fthank-you&return-type=redirect&tpl=default&prod=Topup&price=500&type=digital&qty=1&signature=6abeb3f90daba21d553154f728dbeeb038644113c9a4a78dad7d1ec27da76b5e">$500</option>
                                            </select>
                                            <button class="btn btn-sm btn-success" style="letter-spacing:2px;" onclick="siteRedirect()"> Next <i class="fas fa-arrow-right"></i></button>
                                            --}}
                                            <form action="{{route('airtm.req')}}" method="post" class="w-100">
                                              @csrf
                                              <div class="form-group payment_lay">
                                                <select class="form-control topupBalance" name="amount" style="width:80%;" id="amount" required>
                                                    <option value="">Amount Select...</option>
                                                    <option value="5">$5</option>
                                                    <option value="10">$10</option>
                                                    <option value="15">$15</option>
                                                    <option value="25">$25</option>
                                                    <option value="50">$50</option>
                                                    <option value="75">$75</option>
                                                    <option value="100">$100</option>
                                                    <option value="200">$200</option>
                                                    <option value="500">$500</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-success btn-flex">Next &nbsp; <i class="fa fa-arrow-right"></i></button>
                                              </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                               {{-- @if (Auth::user()->subscription == 1) --}}
                                    <div class="teamMemberInfo">
                                        <div class="subsPortion">
                                            <h4 class="font-weight-bold">Team Member</h4>
                                            <div class="subscribe_btn text-center" id="subscriptionStatus">
                                               @if (Auth::user()->role_id == null)
                                                @if (Auth::user()->balance < 1)
                                                <p>You must have to top up some balance in your wallet.</p>
                                                @else
                                                    @if (Auth::user()->subscription == 1)
                                                        <button class="btn btn-sm btn-dark unsubscribe" data-id="{{Auth::user()->id}}"> UnSubscribe </button>
                                                        @else
                                                        Subscribe Here <button class="btn btn-sm btn-secondary subscribe" data-id="{{Auth::user()->id}}"> Subscribe </button>
                                                    @endif
                                                @endif
                                              @endif
                                            </div>
                                        </div>
                                        <p class="font-weight-bold">All recruited teammembers basic information will be disolayed (within 5 tier beneath)</p>
                                    </div>
                                    @if (Auth::user()->subscription != 1)
                                       <h4 class="font-weight-bold text-center">Subscribe as Team Leader to view all</h4><br>
                                    @endif
                                    <div class="table-responsive">
                                        <table id="example2" class="table table-striped table-bordered text-nowrap" >
                                            <thead>
                                                <tr class="text-center">
                                                    <th>UserName</th>
                                                    <th>Team Status</th>
                                                    <th>Joined Date</th>
                                                    <th>TEAM CORE</th>
                                                    <th>Completed Job</th>
                                                    <th>User Type</th>
                                                    <th>Level</th>
                                                    <th>Last Login</th>
                                                </tr>
                                            </thead>
                                            <tbody id="loadnow">
                                            @foreach (Auth::user()->subscription == 1 ? $fiveTiersUsersInfo : $check as $first)
                                            @php
                                                $activity = $first->subscription == 0 ? "Normal User" : "Premium User";
                                                $completedJob = $first->completed_job  == null ? "0" : $first->completed_job;
                                            @endphp
                                                @if (Auth::user()->subscription == 1)
                                                    <tr class="text-center">
                                                        <td>{{ $first->username }}</td>
                                                        <td>{{ $first->referrer->username == Auth::user()->username ? "CORE" : "SUB"}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($first->created_at)->format('jS F, Y')}}</td>
                                                        <td>{{ $first->core == null ? "0" : $first->core}}</td>
                                                        <td>{{ $completedJob }}</td>
                                                        <td>{{ $activity }}</td>
                                                        <td>{{ $first->level == null ? "0" : $first->level }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($first->last_login)->format('jS F, Y') }}</td>
                                                    </tr>
                                                @else
                                                @php
                                                    $activity2 = $first->getUserName->subscription == 0 ? "Normal User" : "Premium User";
                                                    $completedJob2 = $first->getUserName->completed_job  == null ? "0" : $first->getUserName->completed_job;
                                                @endphp
                                                    <tr class="text-center">
                                                        <td>{{ $first->getUserName->username}}</td>
                                                        <td>CORE</td>
                                                        <td>{{ \Carbon\Carbon::parse($first->created_at)->format('jS F, Y')}}</td>
                                                        <td>{{ $first->core == null ? "0" : $first->core}}</td>
                                                        <td>{{ $completedJob2 }}</td>
                                                        <td>{{ $activity2 }}</td>
                                                        <td>{{ $first->level == null ? "0" : $first->level }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($first->last_login)->format('jS F, Y') }}</td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                               {{-- @endif --}}
                            </div>
                           </div>
                           <div class="container">
                              {{-- <canvas id="chartLine" class="ht-250"></canvas> --}}
                           </div>
                        </div>
                     </div>
                  </div>
               </div><!-- col end -->
            </div>
            @endif
         </div>
         <div class="col-sm-12 col-lg-12 col-xl-4 mt-xl-4">
            <div class="card custom-card card-dashboard-calendar pb-0">
               <label class="main-content-label mb-2 pt-1">Daily Jobs Available</label>
               <span class="d-block tx-12 mb-2 text-muted">Complete to receive Task’s incentives</span>
               <table class="table table-hover m-b-0 transcations mt-2">
                  <tbody>
                      @if (count($sidebarNormalTask) > 0)
                      @foreach ($sidebarNormalTask as $task)
                        <tr>
                            <td class="w-75">
                                <div class="d-flex align-middle mr-3">
                                    <div class="d-inline-block">
                                        <h6 class="mb-1">{!! \Illuminate\Support\Str::limit($task->job_title, 30, $end='...') !!}</h6>
                                        <p class="mb-0 tx-13 text-muted">Types: {{ $task->issue_type == 1 ? "Objective Task":"" }}{{ $task->issue_type == 2 ? "Survey" : "" }}{{ $task->issue_type == 3 ? "Polls" : "" }}{{ $task->issue_type == 4 ? "Quiz" : "" }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-left">
                            <div class="d-inline-block">
                                <h6 class="mb-2 tx-15 font-weight-semibold" style="font-size: 12px;">Reward: ${{ $task->job_price }}<i class="fas fa-level-up-alt mr-2 text-success m-r-10"></i></h6>
                                <p class="mb-0 tx-11 text-muted">
                                    <a href="{{ url('available-job', [Crypt::encrypt($task->id)]) }}" type="button" class="btn btn-primary btn-sm" >
                                        <span><i class="fa fa-angle-double-right m_view"></i></span> More <span class="m_view">Info</span>
                                    </a>
                                </p>
                            </div>
                            </td>
                        </tr>
                      @endforeach
                      @else
                      <tr><td class="w-75"><h6 class="text-center">No job available right now...</h6></td></tr>
                      @endif
                  </tbody>
               </table>
            </div>
            <div class="card custom-card">
               <div class="card-body">
                  <div class="row row-sm">
                     <div class="col-6">
                        <div class="card-item-title">
                           <label class="main-content-label tx-13 font-weight-bold mb-2">Schedule Job</label>
                           <span class="d-block tx-12 mb-0 text-muted">Your Daily Job Countdown Limit Within 24 HR</span>
                        </div>
                        <p class="mb-0 tx-24 mt-2"><b class="text-primary" id="utcTime"></b><b> HR</b></p>
                        <a href="#" class="text-muted">{{ \Carbon\Carbon::now()->format('jS F, Y')}}</a>
                     </div>
                     <div class="col-6">
                        <img src="backend/assets/img/pngs/work.png" alt="image" class="best-emp">
                     </div>
                  </div>
               </div>
            </div>
            <div class="card custom-card">
               <div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
                <div>
                     <label class="main-content-label mb-2 pt-2">Criteria Required Jobs</label>
                     <span class="d-block tx-12 mb-2 text-muted">Jobs will be available once qualifys</span>
                     <h5>DG Executive Task</h5>
                  </div>
               </div>
               <div class="card-body pt-2 mt-0">
                @if (count($executiveTask) > 0)
                  <div class="list-card">
                     @foreach ($executiveTask as $etask )
                     <div class="card-item">
                        <div class="card-item-body">
                            <div class="card-item-stat">
                             <h6 class=""> <i class="fa fa-share" aria-hidden="true"></i> {!! \Illuminate\Support\Str::limit($etask->job_title, 15, $end='...') !!}</h6>
                               <small class="tx-10 text-primary font-weight-semibold">{{\Carbon\Carbon::parse($etask->created_at)->format('jS F, Y')}}</small>
                               <div></div>
                               <small class="tx-10 text-primary font-weight-semibold">Remain Till: {{$etask->already_applied == null ? "0" : $etask->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $etask->job_worker + $etask->already_applied }}</small>
                            </div>
                         </div>
                        @if (Auth::user()->subscription == 1)
                        <div>
                            <button class="btn btn-sm btn-secondary viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                            <a href="{{ url('available-job', [Crypt::encrypt($etask->id)]) }}" type="button" class="btn btn-primary btn-sm" >
                                <i class="fa fa-angle-double-right"></i> Accept
                            </a>
                        </div>
                        @else
                        <div>
                            <button class="btn btn-sm btn-secondary viewData" disabled data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                            <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Please Subscribe to Accept the job"><i class="fa fa-angle-double-right"></i> Accept</button>
                        </div>
                        @endif
                     </div>
                     <div style="height: 5px;background: #3c3cef8c;margin: 6px 0;"></div>
                     @endforeach
                    @endif
                  </div>
                  <h5>DG Manager Task</h5>
                  @if (count($managerTask) > 0)
                  <div class="list-card mb-0">
                    @foreach ($managerTask as $etask )
                    <div class="card-item">
                       <div class="card-item-body">
                           <div class="card-item-stat">
                            <h6 class=""> <i class="fa fa-share" aria-hidden="true"></i> {!! \Illuminate\Support\Str::limit($etask->job_title, 15, $end='...') !!}</h6>
                              <small class="tx-10 text-primary font-weight-semibold">{{\Carbon\Carbon::parse($etask->created_at)->format('jS F, Y')}}</small>
                              <div></div>
                              <small class="tx-10 text-primary font-weight-semibold">Remain Till: {{$etask->already_applied == null ? "0" : $etask->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $etask->job_worker + $etask->already_applied }}</small>
                           </div>
                        </div>
                       @if (Auth::user()->subscription == 1 && Auth::user()->manager_task_access == 1)
                       <div>
                           <button class="btn btn-sm btn-info viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                           <a href="{{ url('available-job', [Crypt::encrypt($etask->id)]) }}" type="button" class="btn btn-success btn-sm" >
                               <i class="fa fa-angle-double-right"></i> Accept
                           </a>
                       </div>
                       @else
                       <div>
                           <button class="btn btn-sm btn-secondary viewData" disabled data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                           <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="If anyone topup in your core Referral then you can access"><i class="fa fa-angle-double-right"></i> Accept</button>
                       </div>
                       @endif
                    </div>
                    <div style="height: 5px;background: #0dbd36c5;margin: 6px 0;"></div>
                    @endforeach
                   @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@section('js')
<script src="{{asset('backend/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/js/table-data.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function siteRedirect() {
        var selectbox = document.getElementById("select-id");
        var selectedValue = selectbox.options[selectbox.selectedIndex].href;
        window.location.href = selectedValue;
    }
    var getUtcTime = function(){
        document.getElementById('utcTime').innerHTML = new Date().toLocaleString('en-us',{timeZone:
        "UTC",timeStyle:'medium',hourCycle:'h24'});
    }
    getUtcTime();
    setInterval(getUtcTime,1000);
</script>
<script>
    $(document).ready(function() {
        $('.topupBalance').select2();
        $("#btn_cop").mouseover(function(){
          $('#btn_cop').tooltip({title: 'copy'}).tooltip('show');
        });
    });
   function copyToClipboard(element) {
   	var $temp = $("<input>");
   	$("body").append($temp);
   	$temp.val($(element).text()).select();
   	document.execCommand("copy");
   	$temp.remove();
    $('#btn_cop').tooltip('dispose').tooltip({title: 'copied!'}).tooltip('show');

   }
   $('#topupMoney').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
          url: "{{route('balance.update')}}",
          method: "POST",
          data: new FormData(this),
          dataType: 'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: function (response) {
              console.log('save', response);
              toastr.options = {
                  "debug": false,
                  "positionClass": "toast-bottom-right",
                  "onclick": null,
                  "fadeIn": 300,
                  "fadeOut": 1000,
                  "timeOut": 5000,
                  "extendedTimeOut": 1000
              };
            if(response.status = true){
              $('#staticBackdrop').modal('hide');
              $("#topupMoney").trigger("reset");
              toastr.success(response.message);
              setTimeout(function(){
                $("#balanceRefresh").load(location.href + " #balanceRefresh>*", "");
              }, 500);
            }
          }
      });

  });
    $(document).ready( function () {
    //Subscribe
    $(document).on('click', '.subscribe', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You are able to use the premium sevices by this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Subscribe',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('subscribe.status') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "fadeIn": 200,
                                    "fadeOut": 3000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000,
                                };
                                if (response.status === true) {
                                    // toastr.success(response.message);
                                    // Swal.fire(
                                    // 'Welcome!',
                                    // 'You are now eligible to access premium services.!',
                                    // 'success'
                                    // )

                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'You are now eligible to access premium services.!',
                                    showConfirmButton: false,
                                    timer: 2000
                                    })

                                    $("#subscriptionStatus").load(location.href + " #subscriptionStatus>*", "");

                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 1500);
                                }
                                // $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });
    //Unsubscribe
    $(document).on('click', '.unsubscribe', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You are unable to use our premium services by this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Unsubscribe',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('unsubscribe.status') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "fadeIn": 200,
                                    "fadeOut": 3000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000,
                                };
                                if (response.status === true) {
                                    // toastr.success(response.message);
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'You unsubscribe from our premium services!',
                                    showConfirmButton: false,
                                    timer: 2000
                                    })

                                    setTimeout(function(){
                                        $("#subscriptionStatus").load(location.href + " #subscriptionStatus>*", "");
                                    }, 1000);
                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 2500);
                                }
                                // $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });
    });
</script>
@endsection
