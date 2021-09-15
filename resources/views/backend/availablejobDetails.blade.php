@extends('backend.home')
@section('title','Project-M | Available-Job')
@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
   <div class="container">
      <!-- Page Header -->
      <div class="page-header">

         <div>
            <h2 class="main-content-title tx-24 mg-b-5">Choose And Apply The Job</h2>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Available-Job</li>
            </ol>
         </div>

      </div>
      <!-- End Page Header -->
      <!--Row-->
      <div class="row row-sm">
         <div class="col-sm-12 col-lg-12 col-xl-12">
            <!--Row-->
            <div class="row row-sm  mt-lg-4">
               <div class="col-sm-12 col-lg-12 col-xl-12">
                  <div class="card bg-primary custom-card card-box">
                     <div class="card-body p-4">
                        <div class="row align-items-center">
                           <div class="offset-lg-4 offset-sm-6 col-lg-8 col-sm-6 col-12">
                              <h4 class="d-flex  mb-3">
                                 <span class="font-weight-bold text-white ">{{Auth::user()->name}}!</span>
                              </h4>
                              <p class="tx-white-7 mb-1">You have two projects to finish, you had completed <b class="text-warning">57%</b> from your montly level,
                                 Keep going to your level
                           </div>
                           <img src="{{asset('backend/assets/img/pngs/work3.png')}}" alt="user-img">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--Row -->
            <!--row-->
            <div class="row row-sm">
               <div class="col-sm-12 col-lg-12 col-xl-12">
                  <div class="card custom-card overflow-hidden">
                     @php
                       $jobType =  $availableJobId->job_type == 1 ? "Director Task":"";
                     @endphp
                     <div class="card-body">
                           <div class="jobtitle">
                               Job Title: <br>
                               <b>{{ $availableJobId->job_title }}</b><sup>{{$jobType }}</sup>
                           </div><br>
                           <div class="d-flex">
                            <div class="">
                                No. of Respondents:
                                <span class="bg">{{ $availableJobId->job_worker }}</span>
                            </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="">
                                Reward:
                                @if ($availableJobId->user_id == 1)
                                    @if (Auth::user()->manager_task_access == 1)
                                    <span class="bg">After completing the task you'll get your team member's top-up percentage...</span>
                                    @endif
                                @else
                                   <span class="bg">${{ $availableJobId->job_price }}</span>
                                @endif
                            </div>
                           </div><br>
                           <div class="">
                               Details Here: <br>
                               {!!$availableJobId->job_description !!}
                           </div>
                           @if ($availableJobId->job_worker == 0)
                           <div class="submit_task text-center"> <span class="bg"><i class="fa fa-frown-o" aria-hidden="true"></i> Sorry, Already FillUp</span></div>
                           @else
                           <div class="submit_task text-center"><br>
                              <a href="{{ url('submit-job', [Crypt::encrypt($availableJobId->id)]) }}" class="btn btn-sm  btn-primary">
                                 Submit The Task <i class="fa fa-arrow-right"></i>
                              </a>
                          </div>
                           @endif

                     </div>
                  </div>
               </div>
               <!-- col end -->
            </div>
            <!-- Row end -->
         </div>
         <!-- col end -->
      </div>
      <!-- Row end -->
   </div>
</div>
<!-- End Main Content-->
@endsection
@section('js')

@endsection
