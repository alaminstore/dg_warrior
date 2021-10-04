@extends('backend.home')
@section('title','DG Warrior | Available-Job')
@section('content')
<style>.level_recruit {display: flex;flex-wrap: wrap;justify-content:flex-start;align-items:flex-start;}</style>
<div class="main-content pt-0">
   <div class="container">
      <div class="page-header">
         <div>
            <h2 class="main-content-title tx-24 mg-b-5">Choose And Apply The Job</h2>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Available-Job</li>
            </ol>
         </div>
      </div>
      <div class="row row-sm">
         <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="row row-sm  mt-lg-4">
               <div class="col-sm-12 col-lg-12 col-xl-12">
                  <div class="card bg-primary custom-card card-box">
                     <div class="card-body p-4">
                        <div class="row align-items-center">
                           <div class="offset-lg-4 offset-sm-6 col-lg-8 col-sm-6 col-12">
                            <div class="level_recruit">
                                <h4 class="d-flex  mb-3">
                                    <span class="font-weight-bold text-white ">{{Auth::user()->name}}!</span>
                                 </h4>
                                 @if (Auth::user()->subscription == 1)
                                   <span style="background: #15A552;padding: 2px 10px;border: 1px solid #02a346;color: #fff;font-size: 12px;border-radius: 3px;margin-left: 10px;"><i class="fa fa-user"></i> {{ Auth::user()->user_title == 1 ? "DG Executive" : "" }}{{ Auth::user()->user_title == 2 ? "DG Manager" : "" }}{{ Auth::user()->user_title == 3 ? "DG Director" : "" }}</span>
                                 @endif
                            </div>
                              <p class="tx-white-7 mb-1">*Recruit core team and sub team leaders to qualify for higher tasks.
                           </div>
                           <img src="{{asset('backend/assets/img/pngs/work3.png')}}" alt="user-img">
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row row-sm">
               <div class="col-sm-12 col-lg-12 col-xl-12">
                  <div class="card custom-card overflow-hidden">
                     <div class="card-header border-bottom-0">
                        <div>
                           <label class="main-content-label mb-2">These Job Are Available Only For You</label> <span class="d-block tx-12 mb-0 text-muted">Once you have completed the job, take a screenshot as prove.</span>
                        </div>
                     </div>
                     <div class="card-body">
                         {{-- //////////////////////// --}}
                           <ul class="list-group">
                            @if (Auth::user()->subscription == 1)
                              @if (!empty($availableJob))
                                 @foreach ($availableJob as $available )
                                 <?php
                                    $checking =  App\AppliedJobStatus::where('jobpost_id',$available->id)->where('user_id','=',Auth::user()->id)->first();
                                    if($checking != null){?>
                                        @if ($checking->status == 0)
                                        <li class="list-group-item">
                                           @php
                                              $jobType =  $available->job_type == 1 ? "Director Task":"";
                                           @endphp
                                           <div class="card">
                                              <div class="card-body">
                                                 <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }}
                                                    <?php if($available->job_type == 1){ ?> <sup>Required Rank:  {{$jobType }}</sup><?php } ?>
                                                 </div>
                                                 <div class="w_p">
                                                    <div class="jobWorkers">
                                                       <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                    </div>
                                                    <div class="jobPrice">
                                                       <p><b>Reward: </b><span class="bg">${{
                                                         number_format((float)$available->job_price, 2, '.', '')
                                                       }}
                                                       </span></p>
                                                    </div>
                                                 </div>
                                                 <div class="detailsnull text-center">
                                                    Already Applied
                                                 </div>
                                              </div>
                                            </div>
                                        </li>
                                        @endif
                                    <?php }else{?>
                                        @if ($available->job_visibility == 2)
                                         @if ($available->user_id == $thereferrel_id)
                                        @foreach ($totalUsr as $refUser)
                                            {{-- @if ($available->user_id == $refUser) --}}
                                            @if ($refUser == Auth::user()->id)
                                                <li class="list-group-item">
                                                    @php
                                                    $jobType =  $available->job_type == 1 ? "Director Task":"";
                                                    @endphp
                                                    <div class="card">
                                                    <div class="card-body">
                                                        <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }}
                                                            <?php if($available->job_type == 1){ ?> <sup>Required Rank:  {{$jobType }}</sup><?php } ?>
                                                        </div>
                                                        <div class="w_p">
                                                            <div class="jobWorkers">

                                                                <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>

                                                            </div>
                                                            <div class="jobPrice">
                                                                <p><b>Reward: </b><span class="bg">${{
                                                                number_format((float)$available->job_price, 2, '.', '')
                                                                }}
                                                                </span></p>
                                                            </div>
                                                        </div>
                                                        <div class="details text-center">
                                                            <a href="{{ url('available-job', [Crypt::encrypt($available->id)]) }}" type="button" class="btn btn-info btn-sm" >
                                                                View Details
                                                            </a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </li>

                                            @endif
                                        @endforeach
                                         @endif
                                        @else
                                        <li class="list-group-item">
                                            @php
                                               $jobType =  $available->job_type == 1 ? "Director Task":"";
                                            @endphp
                                            <div class="card">
                                               <div class="card-body">
                                                  <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }}
                                                     <?php if($available->job_type == 1){ ?> <sup> Required Rank: {{$jobType }}</sup><?php } ?>
                                                  </div>
                                                  <div class="w_p">
                                                     <div class="jobWorkers">
                                                        <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                     </div>
                                                     <div class="jobPrice">

                                                        <p><b>Reward: </b><span class="bg">${{
                                                          number_format((float)$available->job_price, 2, '.', '')
                                                        }}
                                                        </span></p>
                                                     </div>
                                                  </div>

                                                  <div class="details text-center">
                                                     <a href="{{ url('available-job', [Crypt::encrypt($available->id)]) }}" type="button" class="btn btn-info btn-sm" >
                                                        View Details
                                                     </a>
                                                  </div>
                                                </div>
                                               </div>
                                         </li>
                                        @endif
                                    <?php }
                                 ?>
                                 @endforeach
                                @else
                                <b>At this moment no Director Job is available for you</b>
                              @endif
                            @endif

                               {{--
                                ================================================Normal Job ====================================================
                               --}}
							  <div class="clr"></div>
                              @if (!empty($normalJob))
                                 @foreach ($normalJob as $available)
                                 <?php
                                    $checking =  App\AppliedJobStatus::where('jobpost_id',$available->id)->where('user_id','=',Auth::user()->id)->first();
                                    if($checking != null){?>
                                    @if ($checking->status == 0)
                                    <li class="list-group-item">
                                       @php
                                          $jobType =  $available->job_visibility == 4 ? "DG Manager Task":"";
                                       @endphp
                                       <div class="card">
                                          <div class="card-body">
                                             <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="font-size:9px;color:#000;"> Required Rank:  {{$available->job_visibility==4 ? "DG Manager Task":""}} {{$available->job_visibility==1 ? "DG Warrior Task":""}} {{$available->job_visibility==3 ? "Executive Task":""}}</sup>

                                             </div>
                                             <div class="w_p">
                                                <div class="jobWorkers">
                                                 <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                </div>
                                                @if ($available->job_visibility == 4)
                                                <div class="jobPrice">
                                                    <p><b>Reward: </b><span class="bg">$ Topup Percentage
                                                    </span></p>
                                                 </div>
                                                 @else
                                                 <div class="jobPrice">
                                                    <p><b>Reward: </b><span class="bg">${{
                                                    number_format((float)$available->job_price, 2, '.', '')
                                                    }}
                                                    </span></p>
                                                </div>
                                                @endif



                                             </div>
                                             <div class="detailsnull text-center">
                                                Already Applied
                                             </div>
                                          </div>
                                          </div>
                                    </li>
                                    @endif
                                    <?php }else{?>
{{-- start... --}}
                                    @if ($available->job_issuer_rank == 10)
                                      @if (Auth::user()->subscription == 1)
                                          @if (Auth::user()->manager_task_access == 1)
                                                <li class="list-group-item">
                                                    @php
                                                    $jobType =  $available->job_issuer_rank == 10 ? "DG Manager Task":"";
                                                    @endphp
                                                    <div class="card">
                                                    <div class="card-body">
                                                        <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background: rgb(17, 121, 17);color:#fff;border:1px solid green;">Required Rank:  {{$jobType }}</sup></div>
                                                        <div class="w_p">
                                                            <div class="jobWorkers">
                                                                <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                            </div>
                                                            <div class="jobPrice">
                                                                <p><b>Reward: </b><span class="bg">$ Topup Percentage
                                                                </span></p>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $dueAvailableorNot = App\DgManagerDue::where('user_id',Auth::user()->id)->first();
                                                        @endphp
                                                        @if ($dueAvailableorNot)
                                                        <div class="details text-center">
                                                            <a href="{{ url('available-job', [Crypt::encrypt($available->id)]) }}" type="button" class="btn btn-info btn-sm" >
                                                            View Details
                                                            </a>
                                                        </div>
                                                          @else
                                                          <div class="details text-center">
                                                            <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="No Top Up yet from your team."><i class="fa fa-angle-double-right"></i> View Details</button>
                                                          </div>
                                                        @endif

                                                        </div>
                                                    </div>
                                                </li>
                                            @else
                                            {{-- //after topup --}}

                                                <li class="list-group-item">
                                                    @php
                                                    $jobType =  $available->job_issuer_rank == 10 ? "DG Manager Task":"";
                                                    @endphp
                                                    <div class="card">
                                                    <div class="card-body">
                                                        <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background: rgb(17, 121, 17);color:#fff;border:1px solid green;"> Required Rank:  {{$jobType }}</sup></div>
                                                        <div class="w_p">
                                                            <div class="jobWorkers">
                                                                <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                            </div>
                                                            <div class="jobPrice">
                                                                <p><b>Reward: </b><span class="bg">$ Topup Percentage
                                                                </span></p>
                                                            </div>
                                                        </div>
                                                        <div class="details text-center">
                                                            <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="If anyone topup in your core Referral then you can access"><i class="fa fa-angle-double-right"></i> View Details</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </li>

                                          @endif

                                        @else
                                        {{-- //please subscribee --}}
                                            <li class="list-group-item">
                                                @php
                                                $jobType =  $available->job_issuer_rank == 10 ? "DG Manager Task":"";
                                                @endphp
                                                <div class="card">
                                                <div class="card-body">
                                                    <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background: rgb(17, 121, 17);color:#fff;border:1px solid green;">Required Rank:  {{$jobType }}</sup></div>
                                                    <div class="w_p">
                                                        <div class="jobWorkers">
                                                            <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                        </div>
                                                        <div class="jobPrice">
                                                            <p><b>Reward: </b><span class="bg">$ Topup Percentage
                                                            </span></p>
                                                        </div>
                                                    </div>
                                                    <div class="details text-center">
                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Please Subscribe to apply the job"><i class="fa fa-angle-double-right"></i> View Details</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </li>
                                      @endif

                                      @elseif ($available->job_visibility == 3)
                                        @if (Auth::user()->subscription == 1)
                                            <li class="list-group-item">
                                                @php
                                                $jobType =  $available->job_visibility == 3 ? "DG Executive Task":"";
                                                @endphp
                                                <div class="card">
                                                <div class="card-body">
                                                    <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background: rgb(46, 93, 192);color:#fff;border:1px solid green;">Required Rank: {{$jobType }}</sup></div>
                                                    <div class="w_p">
                                                        <div class="jobWorkers">
                                                            <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                        </div>
                                                        <div class="jobPrice">
                                                            <p><b>Reward: </b><span class="bg">${{
                                                            number_format((float)$available->job_price, 2, '.', '')
                                                            }}
                                                            </span></p>
                                                        </div>
                                                    </div>
                                                    <div class="details text-center">
                                                        <a href="{{ url('available-job', [Crypt::encrypt($available->id)]) }}" type="button" class="btn btn-info btn-sm" >
                                                        View Details
                                                        </a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </li>

                                         @else
                                           {{-- //please subscribe --}}

                                           <li class="list-group-item">
                                                @php
                                                $jobType =  $available->job_visibility == 3 ? "DG Executive Task":"";
                                                @endphp
                                                <div class="card">
                                                <div class="card-body">
                                                    <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background: rgb(46, 93, 192);color:#fff;border:1px solid green;">Required Rank: {{$jobType }}</sup></div>
                                                    <div class="w_p">
                                                        <div class="jobWorkers">
                                                            <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                        </div>
                                                        <div class="jobPrice">
                                                            <p><b>Reward: </b><span class="bg">${{
                                                            number_format((float)$available->job_price, 2, '.', '')
                                                            }}
                                                            </span></p>
                                                        </div>
                                                    </div>
                                                    <div class="details text-center">
                                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Please Subscribe to for the executive job"><i class="fa fa-angle-double-right"></i> View Details</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </li>
                                         @endif
                                     @else
                                       @if ($available->job_visibility == 2)
                                         @if ($available->user_id == $thereferrel_id)
                                        @foreach ($totalUsr as $refUser)
                                            {{-- @if ($available->user_id == $refUser) --}}
                                            @if ($refUser == Auth::user()->id)
                                                <li class="list-group-item">
                                                    @php
                                                    $jobType =  $available->job_visibility == 2 ? "From My Team":"";
                                                    @endphp
                                                    <div class="card">
                                                    <div class="card-body">
                                                        <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background:rgb(143, 99, 99);color:rgb(255, 255, 255)">Required Rank:  {{$jobType }}</sup>

                                                        </div>
                                                        <div class="w_p">
                                                            <div class="jobWorkers">
                                                                <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                            </div>
                                                            <div class="jobPrice">
                                                                <p><b>Reward: </b><span class="bg">${{
                                                                number_format((float)$available->job_price, 2, '.', '')
                                                                }}
                                                                </span></p>
                                                            </div>
                                                        </div>
                                                        <div class="details text-center">
                                                            <a href="{{ url('available-job', [Crypt::encrypt($available->id)]) }}" type="button" class="btn btn-info btn-sm" >
                                                                View Details
                                                            </a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                          @endif
                                        @else
                                        <li class="list-group-item">
                                            @php
                                               $jobType =  $available->job_visibility == 1 ? "DG Warrior Task":"";
                                            @endphp
                                            <div class="card">
                                               <div class="card-body">
                                                  <div class="jobtitle"><span><b>Job Title: </b></span> {{ $available->job_title }} <sup style="background:#fff;color:#000">Required Rank: {{$jobType }}</sup>

                                                  </div>
                                                  <div class="w_p">
                                                     <div class="jobWorkers">
                                                        <p><b>Respondent Needed: </b><span>{{$available->already_applied == null ? "0" : $available->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $available->job_worker + $available->already_applied }}</p>
                                                     </div>
                                                     <div class="jobPrice">
                                                        <p><b>Reward: </b><span class="bg">${{
                                                          number_format((float)$available->job_price, 2, '.', '')
                                                        }}
                                                        </span></p>
                                                     </div>
                                                  </div>

                                                  <div class="details text-center">
                                                     <a href="{{ url('available-job', [Crypt::encrypt($available->id)]) }}" type="button" class="btn btn-info btn-sm" >
                                                        View Details
                                                     </a>
                                                  </div>
                                                </div>
                                               </div>
                                         </li>
                                        @endif
                                    @endif
                                    <?php }
                                 ?>

                                 @endforeach
                                @else
                                <b>At this moment no Job is available for you</b>
                              @endif

							  <div class="clr"></div>
                              <div style="display: flex;justify-content: center;align-items: center;margin-top: 10px;">{{ $normalJob->links() }}</div>
							</ul>

                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
