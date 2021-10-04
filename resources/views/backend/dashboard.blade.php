@extends('backend.home')
@section('title','DG Warrior | Dashboard')
@section('style')
{{-- datatable --}}
<link href="{{ asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection
@section('content')
<style>
    .topup{display:flex;justify-content: inherit;align-items:baseline;padding-bottom:15px;}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#fff}.level_recruit{display:flex;flex-wrap:wrap;justify-content:space-around;align-items:baseline}button.btn.btn-sm.btn-success.btn-flex{display:flex;justify-content:space-between;align-items:center}.subsPortion{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center}.card-item{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center}a.carousel-control-prev{display:flex;flex-direction:column;justify-content:center;align-items:flex-start}a.carousel-control-next{display:flex;flex-direction:column;justify-content:center;align-items:flex-end}button.recBtn{border:#ffdead;background:0 0;padding:0 10px}i.fa.fa-question-circle-o{font-size:22px;color:#fff}i.fa.fa-angle-left,i.fa.fa-angle-right{font-size:38px}.divBalnceTopup {width: 118%;display: flex;justify-content: space-between;align-items: baseline;margin-top: -8px;margin-bottom: -13px;}button.btn.btn-sm.btn-warning.rechargetop{font-size:11px;padding:2px 10px;margin:0}.visible-print svg{background:#fff;padding:3px}.swal2-modal .swal2-title{color:#595959;font-size:24px;text-align:center;font-weight:600;text-transform:none;position:relative;margin:0 0 .4em;padding:0;display:block;word-wrap:break-word}.imp.text-white ul li{font-size:13px;font-weight:300}.dropify-wrapper .dropify-message span.file-icon{font-size:20px;color:#ccc}.dropify-wrapper{line-height:30px!important}
    @media only screen and (max-width:330px) {
        .m_view_portion {
            display:none;
        }
    }
</style>
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
                                 <span>[{{Auth::user()->level == null ? "0" : Auth::user()->level}}]</span> <sup>level<sup><button type="button" class="recBtn" data-toggle="tooltip" data-placement="top" title="Increase level by completing job / posting job.Higher level entitled to higher rewards!">
                                    <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                    </button></sup></sup> </span>
                                 @else
                                 <span style="background:rgba(0, 128, 0, 0.466);padding:2px 5px;">{{Auth::user()->role_id == 2 ? "Admin" : ""}}</span></span>
                                 @endif
                            </h4>
                            @if (Auth::user()->subscription == 1)
                            <span style="background:#15A552;padding: 4px 11px;border: 1px solid #02a346;color: #fff;font-size: 12px;border-radius: 3px;"><i class="fa fa-user"></i> {{ Auth::user()->user_title == 1 ? "DG Executive" : "" }}{{ Auth::user()->user_title == 2 ? "DG Manager" : "" }}{{ Auth::user()->user_title == 3 ? "DG Director" : "" }}</span>
                            @endif

                            @if (Auth::user()->role_id == null)
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#referanceCode"><i class="fa fa-copy"></i> My Reference Code</button>
                            @endif
                        <div class="modal fade" id="referanceCode" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">My Reference Code & URL</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="visible-print text-center">
                                        {!! QrCode::size(150)->generate(Auth::user()->referral_link); !!}
                                        <br><br>
                                        <p class="text-white">Your Invitation Code: <span style="color:gold;">{{ Auth::user()->username }}</span></p>
                                        <p class="text-white" style="font-size: 13px;">Url Link: <span style="color:gold;">{{ Auth::user()->referral_link }}</span></p>
                                        OR <br>
                                        <span id="ref" style="display: none">{{ Auth::user()->referral_link }}</span>
                                        <button type="button" class="btn  btn-sm btn-primary" id="btn_cop" onclick="copyToClipboard('#ref')">
                                            <i class="fa fa-copy"></i> Copy Referral Link
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                       {{-- End --}}
                        </div>
                           <p class="tx-white-7 mb-1">
                               ***Recruitment of team qualify you for higher reward job.
                            </p>
                        </div>
                        <img src="{{asset('backend/assets/img/pngs/work3.png')}}" alt="user-img">
                     </div>
                  </div>
               </div>
            </div>
         </div>
        {{-- Carousel Start --}}
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            <li data-target="#demo" data-slide-to="3"></li>
            <li data-target="#demo" data-slide-to="4"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('backend/assets/banners/DG_Banner_ 01_(Invite).png') }}" alt="banner">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('backend/assets/banners/DG_banner_02_(Ranking).png') }}" alt="banner">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('backend/assets/banners/DG_Banner_03_(welcome).png') }}" alt="banner">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('backend/assets/banners/DG_banner_04_(12x).png') }}" alt="banner">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('backend/assets/banners/DG_banner_05_(12x).png') }}" alt="banner">
            </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            {{-- <span class="carousel-control-prev-icon"></span> --}}
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            {{-- <span class="carousel-control-next-icon"></span> --}}
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
        {{-- Carousel End --}}
        <br><br>
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
                              <span class="d-block tx-11 mb-0 text-muted">Rewards since <span style="color: gold;">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('jS F, Y') }}</span></span>
                           </div>
                           <div class="card-item-body">
                              <div class="card-item-stat">
                                 <h4 class="font-weight-bold">${{ Auth::user()->withdrawable == null ? "0" : number_format((float)Auth::user()->withdrawable, 2, '.', '')}}</h4>
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
                              <label class="main-content-label tx-13 font-weight-bold mb-1">{{ Auth::user()->role_id == null ? "Your Participants" : "All Employee" }} </label>
                              <span class="d-block tx-11 mb-0 text-muted">Build up ultimate dream team</span>
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
                              <div class="divBalnceTopup">
                                <label class="main-content-label tx-13 font-weight-bold mb-1 rechargeTopup">
                                    Sales achieved
                                  </label>
                                  <div class="divTopup">
                                    {{-- @if (Auth::user()->role_id == null) --}}
                                        <div class="topup">
                                            {{-- <button type="button" class="btn btn-sm btn-warning rechargetop" style="color:#000;" data-toggle="modal" data-target="#staticBackdrop"> --}}
                                            <button type="button" class="btn btn-sm btn-warning rechargetop" style="color:#000;" data-toggle="modal" data-target="#ChoosePayment">
                                                <i class="fa fa-plus"></i> Topup
                                            </button>
                                        </div>
                                    {{-- @endif --}}
                                </div>

                              </div>
                              <span class="d-block tx-11 mb-0 text-muted">From core recharged</span>
                           </div>
                           <div class="card-item-body">
                              <div class="card-item-stat">
                                 <h4 class="font-weight-bold">${{ Auth::user()->sales_achieved == null ? "0": number_format((float)Auth::user()->sales_achieved, 2, '.', '') }}</h4>
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
                                    <div class="teamMemberInfo">
                                        <div class="subsPortion">
                                            <h4 class="font-weight-bold">Team Member</h4>
                                            <div class="subscribe_btn text-center" id="subscriptionStatus">
                                               @if (Auth::user()->role_id == null)
                                                @if (Auth::user()->balance < 1)
                                                <p>Topup to Subscribe</p>
                                                @else
                                                    @if (Auth::user()->subscription == 1)
                                                        {{-- <button class="btn btn-sm btn-dark unsubscribe" data-id="{{Auth::user()->id}}"> UnSubscribe </button> --}}
                                                        @else
                                                        <button class="btn btn-sm btn-secondary subscribe" data-id="{{Auth::user()->id}}"> <i class="fa fa-snowflake-o" aria-hidden="true"></i> Subscribe </button>
                                                    @endif
                                                @endif
                                              @endif
                                            </div>
                                        </div>
                                        <p class="font-weight-bold">All recruited team members basic information will be displayed.</p>
                                    </div>
                                    @if (Auth::user()->subscription != 1)
                                       <h4 class="font-weight-bold text-center">Subscribe as Executive to view all</h4><br>
                                    @endif
                                    <div class="table-responsive">
                                        <table id="example2" class="table table-striped table-bordered text-nowrap">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>UserName</th>
                                                    <th>Team Status
                                                        <sup><button type="button" class="recBtn" data-toggle="tooltip" data-placement="top" title= "Recruited via my invitation link = CORE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recruited via my team member  = SUB" >
                                                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                                            </button>
                                                        </sup>
                                                    </th>
                                                    <th>Joined Date</th>
                                                    <th>TEAM CORE</th>
                                                    <th>Completed Job</th>
                                                    @if (Auth::user()->subscription == 1)
                                                    <th>User Type</th>
                                                    <th>Level</th>
                                                    <th>Last Login</th>
                                                    @endif
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
                                                        @if (Auth::user()->subscription == 1)
                                                        <td>{{ $activity2 }}</td>
                                                        <td>{{ $first->level == null ? "0" : $first->level }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($first->last_login)->format('jS F, Y') }}</td>
                                                        @endif

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
               <label class="main-content-label mb-2 pt-1">Daily Jobs Available <sup><button type="button" class="recBtn" data-toggle="tooltip" data-placement="top" title="Subscribe as DG Executive entitled you to 12 daily job and higher rewards job">
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                </button></sup></label>
               <span class="d-block tx-12 mb-2 text-muted">Compete to receive job’s rewards</span>
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
                                        <span><i class="fa fa-angle-double-right"></i></span> More <span class="m_view_portion">Info</span>
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
                           <span class="d-block tx-12 mb-0 text-muted">Job Opportunity Reset At UTC 00:00:00 <br> <b class="text-white tx-13">Time Now</b></span>
                        </div>
                        <span class="mb-0 tx-24 mt-2"><b class="text-primary" id="utcTime"></b></span>
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
                               {{-- <small class="tx-10 text-primary font-weight-semibold">{{\Carbon\Carbon::parse($etask->created_at)->format('jS F, Y')}}</small> --}}
                               <small class="tx-10 text-primary font-weight-semibold">Rewards: ${{$etask->job_price}}</small>
                               <div></div>
                               <small class="tx-10 text-primary font-weight-semibold">Respondent: {{$etask->already_applied == null ? "0" : $etask->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $etask->job_worker + $etask->already_applied }}</small>
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
                            <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Subscribe to qualify for job"><i class="fa fa-angle-double-right"></i> Accept</button>
                        </div>
                        @endif
                     </div>
                     <div style="height: 5px;background: #3c3cef8c;margin: 6px 0;"></div>
                     @endforeach
                    @endif
                  </div>
                  <div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
                    <div>
                         <h5>DG Manager Task</h5>
                      </div>
                   </div>

                  @if (count($managerTask) > 0)

                  <div class="list-card mb-0">
                    @foreach ($managerTask as $etask )
                    <div class="card-item">
                       <div class="card-item-body">
                           <div class="card-item-stat">
                            <h6 class=""> <i class="fa fa-share" aria-hidden="true"></i> {!! \Illuminate\Support\Str::limit($etask->job_title, 15, $end='...') !!}</h6>
                              <small class="tx-10 text-primary font-weight-semibold">Rewards : PRP</small>
                              <div></div>
                              <small class="tx-10 text-primary font-weight-semibold">Respondent: {{$etask->already_applied == null ? "0" : $etask->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $etask->job_worker + $etask->already_applied }}</small>
                           </div>
                        </div>
                       @if (Auth::user()->subscription == 1 && Auth::user()->manager_task_access == 1)
                       @php
                           $dueAvailableorNot = App\DgManagerDue::where('user_id',Auth::user()->id)->first();
                       @endphp
                        @if ($dueAvailableorNot)
                            <div>
                                <button class="btn btn-sm btn-info viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                                <a href="{{ url('available-job', [Crypt::encrypt($etask->id)]) }}" type="button" class="btn btn-success btn-sm" >
                                    <i class="fa fa-angle-double-right"></i> Accept
                                </a>
                            </div>
                            @else
                            <div>
                                <button class="btn btn-sm btn-secondary viewData" disabled data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                                <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="No Top Up yet from your team."><i class="fa fa-angle-double-right"></i> Accept</button>
                            </div>
                        @endif
                       @else
                       <div>
                           <button class="btn btn-sm btn-secondary viewData" disabled data-toggle="modal" data-target="#myModalSave" data-id="{{ $etask->id }}"><i class="fa fa-briefcase"></i> Details</button>
                           <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Recruit core DG executive to qualify for job"><i class="fa fa-angle-double-right"></i> Accept</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready( function () {
        $('#screenShotimage').dropify();
        $('#screenShotimage2').dropify();
    });
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
        $("#btn_cop").mouseover(function(){
          $('#btn_cop').tooltip({title: 'copy'}).tooltip('show');
        });
    });
   function copyToClipboard(element) {
   	var $temp = $("<input>");
   	$("body").append($temp);
   	$temp.val($(element).text()).select();
    $temp.focus();
   	document.execCommand("copy");
   	$temp.remove();
    $('#btn_cop').tooltip('dispose').tooltip({title: 'Copied'}).tooltip('show');

   }
   function copyUsdtAddress(element) {
   	var $temp = $("<input>");
   	$("body").append($temp);
   	$temp.val($(element).text()).select();
    $temp.focus();
   	document.execCommand("copy");
   	$temp.remove();
    $('#btnUsdt_cop').tooltip('dispose').tooltip({title: 'Copied'}).tooltip('show');
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
                title: 'Confirm subscription ?',
                html:
                        'Subscription fee of $1 daily will be deducted from your account balance <br>' +
                        'Note: Subscription will be suspended once balance is insufficient',
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
                                // console.log('tt',response);
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
