<!-- Main Header-->
<div class="main-header side-header">
	<div class="container">
		<div class="main-header-left">
			<a class="main-header-menu-icon d-lg-none" href="" id="mainNavShow"><span></span></a>
			<a class="main-logo" href="{{ url('/') }}">
				<img src="{{ asset('logo_white.svg') }}" style="height: 66px!important;width: 89px!important;" class="header-brand-img desktop-logo theme-logo" alt="logo">
			</a>
		</div>
		<div class="main-header-center">
			<div class="responsive-logo">
				<a href="{{url('/')}}"><img src="{{asset('logo_white.svg')}}" style="height: 53jpx!important;width: 74px!important;" class="mobile-logo" alt="logo"></a>
				<a href="{{url('/')}}"><img src="{{asset('logo_white.svg')}}" style="height: 53px!important;width: 74px!important;" class="mobile-logo-dark" alt="logo"></a>
			</div>

		</div>
		<div class="main-header-right">
			<div class="dropdown main-header-notification">
				@if (Auth::user()->role_id == 1)
				<a class="nav-link icon" href="">
					<i class="fa fa-bell header-icons"></i>

					<span class="badge badge-danger nav-link-badge">{{count($jobcount)}}</span>
				</a>
				@endif
				<div class="dropdown-menu">
					<div class="header-navheading">
						<p class="main-notification-text"><b>Now you have <span style="color: rgb(255, 255, 255);">{{count($jobcount)}}</span> notifications...</b></p>
					</div>

					<div class="main-notification-list">
						@foreach ($joblists as $list )
						<div class="media new">
							<div class="media-body">
								<a data-toggle="modal" class="viewData" data-target="#myModalSave" data-id="{{$list->id}}">
									<p>Job: {{$list->job_title}}</p> User: "{{$list->user_name}}" <strong>Pending</strong> from {{ \Carbon\Carbon::parse($list->created_at)->format('jS F, Y') }}
								</a>

							</div>
						</div>
						@endforeach
					</div>
					<div class="dropdown-footer">
						<a href="{{ url('/waiting-job') }}">View All Notifications</a>
					</div>
				</div>
			</div>
            @if (count($revisionList) > 0)
            <div class="main-header-notification">
				<a class="nav-link icon" href="{{ url('/task-revision') }}">
					<i class="fa fa-comment header-icons" aria-hidden="true"></i>
					<span class="badge badge-success nav-link-badge">{{ count($revisionList) }}</span>
				</a>
			</div>
            @endif
			<div class="dropdown main-profile-menu">
				<a class="d-flex" href="">
                    @if (Auth::user()->image == null)
                     <span class="main-img-user" ><img alt="avatar" src="{{asset('user.png')}}"></span>
                    @else
                     <span class="main-img-user" ><img alt="avatar" src="{{asset(Auth::user()->image)}}"></span>
                    @endif
				</a>
				<div class="dropdown-menu">
					<div class="header-navheading">
						<h6 class="main-notification-title">{{Auth::user()->name}}</h6>
						{{-- <p class="main-notification-text">Web Designer</p> --}}
					</div>
					<a class="dropdown-item border-top" href="/my-profile">
						<i class="fa fa-user"></i> My Profile
					</a>
					{{-- <a class="dropdown-item" href="profile.html">
						<i class="fe fe-edit"></i> Edit Profile
					</a>
					<a class="dropdown-item" href="profile.html">
						<i class="fe fe-settings"></i> Account Settings
					</a>
					<a class="dropdown-item" href="profile.html">
						<i class="fe fe-settings"></i> Support
					</a> --}}
					@if (Auth::user()->role_id != null)
					<a class="dropdown-item" href="{{ url('/user-management') }}">
						<i class="fa fa-users"></i> User Management
					</a>
					<a class="dropdown-item" href="{{ url('/submission-pending') }}">
						<i class="fa fa-paperclip"></i> Pending Submission
					</a>
					@endif
					{{-- @if (Auth::user()->role_id !=1)
						<a class="dropdown-item" href="{{ url('/activity') }}">
							<i class="fa fa-compass" aria-hidden="true"></i> Activity
						</a>
					@endif --}}
                    <a class="dropdown-item" href="{{ url('/settings') }}">
                        <i class="fa fa-cogs" aria-hidden="true"></i> Settings
                    </a>
					<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
						<i class="fa fa-power-off" aria-hidden="true"></i> {{ __('Sign Out') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</div>
			</div>
			@if (Auth::user()->role_id == null)
			<div class="main-header-notification" id="balanceRefresh">
				<a class="nav-link icon" href="#">
					<div class="balance">
						${{ Auth::user()->balance != null ? Auth::user()->balance : "0"}}
					</div>
				</a>
			</div>
			@endif
			<button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
				aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
				{{-- <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i> --}}
                <i class="fa fa-ellipsis-v header-icons navbar-toggler-icon" aria-hidden="true"></i>
			</button><!-- Navresponsive closed -->
		</div>
	</div>
</div>
<!-- End Main Header-->

<!-- Mobile-header -->
			<div class="mobile-main-header">
				<div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
					<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
						<div class="d-flex order-lg-2 ml-auto">
							<div class="dropdown header-search">
								{{-- <a class="nav-link icon header-search">
									<i class="fe fe-search"></i>
								</a> --}}
								<div class="dropdown-menu">
									<div class="main-form-search p-2">
										<div class="input-group">
											<div class="input-group-btn search-panel">
												<select class="form-control select2-no-search">
													<option label="All categories">
													</option>
													<option value="IT Projects">
														IT Projects
													</option>
													<option value="Business Case">
														Business Case
													</option>
													<option value="Microsoft Project">
														Microsoft Project
													</option>
													<option value="Risk Management">
														Risk Management
													</option>
													<option value="Team Building">
														Team Building
													</option>
												</select>
											</div>
											<input type="search" class="form-control" placeholder="Search for anything...">
											<button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
										</div>
									</div>
								</div>
							</div>
						{{-- <div class="dropdown main-header-notification flag-dropdown">
							<a class="nav-link icon country-Flag">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><circle cx="256" cy="256" r="256" fill="#f0f0f0"/><g fill="#0052b4"><path d="M52.92 100.142c-20.109 26.163-35.272 56.318-44.101 89.077h133.178L52.92 100.142zM503.181 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075 89.076h133.176zM8.819 322.784c8.83 32.758 23.993 62.913 44.101 89.075l89.074-89.075H8.819zM411.858 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177l89.076-89.075zM100.142 459.079c26.163 20.109 56.318 35.272 89.076 44.102V370.005l-89.076 89.074zM189.217 8.819c-32.758 8.83-62.913 23.993-89.075 44.101l89.075 89.075V8.819zM322.783 503.181c32.758-8.83 62.913-23.993 89.075-44.101l-89.075-89.075v133.176zM370.005 322.784l89.075 89.076c20.108-26.162 35.272-56.318 44.101-89.076H370.005z"/></g><g fill="#d80027"><path d="M509.833 222.609H289.392V2.167A258.556 258.556 0 00256 0c-11.319 0-22.461.744-33.391 2.167v220.441H2.167A258.556 258.556 0 000 256c0 11.319.744 22.461 2.167 33.391h220.441v220.442a258.35 258.35 0 0066.783 0V289.392h220.442A258.533 258.533 0 00512 256c0-11.317-.744-22.461-2.167-33.391z"/><path d="M322.783 322.784L437.019 437.02a256.636 256.636 0 0015.048-16.435l-97.802-97.802h-31.482v.001zM189.217 322.784h-.002L74.98 437.019a256.636 256.636 0 0016.435 15.048l97.802-97.804v-31.479zM189.217 189.219v-.002L74.981 74.98a256.636 256.636 0 00-15.048 16.435l97.803 97.803h31.481zM322.783 189.219L437.02 74.981a256.328 256.328 0 00-16.435-15.047l-97.802 97.803v31.482z"/></g></svg>
							</a>
							<div class="dropdown-menu">
								<a href="#" class="dropdown-item d-flex ">
									<span class="avatar  mr-3 align-self-center bg-transparent"><img src="{{asset('backend/assets/img/flags/french_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">French</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar  mr-3 align-self-center bg-transparent"><img src="{{asset('backend/assets/img/flags/germany_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Germany</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar mr-3 align-self-center bg-transparent"><img src="{{asset('backend/assets/img/flags/italy_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Italy</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar mr-3 align-self-center bg-transparent"><img src="{{asset('backend/assets/img/flags/russia_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Russia</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar  mr-3 align-self-center bg-transparent"><img src="{{asset('backend/assets/img/flags/spain_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">spain</span>
									</div>
								</a>
							</div>
						</div> --}}

						<div class="dropdown main-header-notification">
                            @if (Auth::user()->role_id == 1)
                            <a class="nav-link icon" href="">
                                <i class="fa fa-bell header-icons"></i>
                                <span class="badge badge-danger nav-link-badge">{{count($jobcount)}}</span>
                            </a>
                            @endif
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <p class="main-notification-text"><b>Now you have <span style="color: rgb(255, 255, 255);">{{count($jobcount)}}</span> notifications...</b></p>
                                </div>

                                <div class="main-notification-list">
                                    @foreach ($joblists as $list )
                                    <div class="media new">
                                        <div class="media-body">
                                            <a data-toggle="modal" class="viewData" data-target="#myModalSave" data-id="{{$list->id}}">
                                                <p>Job: {{$list->job_title}}</p> User: "{{$list->user_name}}" <strong>Pending</strong> from {{ \Carbon\Carbon::parse($list->created_at)->format('jS F, Y') }}
                                            </a>

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="dropdown-footer">
                                    <a href="{{ url('/waiting-job') }}">View All Notifications</a>
                                </div>
                            </div>
                        </div>
                        @if (count($revisionList) > 0)
                        <div class="main-header-notification">
                            <a class="nav-link icon" href="{{ url('/task-revision') }}">
                                <i class="fa fa-comment header-icons" aria-hidden="true"></i>
                                <span class="badge badge-success nav-link-badge">{{ count($revisionList) }}</span>
                            </a>
                        </div>
                        @endif
						<div class="dropdown main-profile-menu">
                            <a class="d-flex" href="#">
                                @if (Auth::user()->image == null)
                                <span class="main-img-user" ><img alt="avatar" src="{{asset('user.png')}}"></span>
                                @else
                                <span class="main-img-user" ><img alt="avatar" src="{{asset(Auth::user()->image)}}"></span>
                                @endif
                            </a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title">{{Auth::user()->name}}</h6>
								</div>
								<a class="dropdown-item border-top" href="/my-profile">
                                    <i class="fa fa-user"></i> My Profile
                                </a>

								@if (Auth::user()->role_id != null)
									<a class="dropdown-item" href="{{ url('/user-management') }}">
										<i class="fa fa-users"></i> User Management
									</a>
									<a class="dropdown-item" href="{{ url('/submission-pending') }}">
										<i class="fa fa-paperclip"></i> Pending Submission
									</a>
								@endif
								{{-- @if (Auth::user()->role_id !=1)
									<a class="dropdown-item" href="{{ url('/activity') }}">
										<i class="fa fa-compass" aria-hidden="true"></i> Activity
									</a>
								@endif --}}
                                <a class="dropdown-item" href="{{ url('/settings') }}">
                                    <i class="fa fa-cogs" aria-hidden="true"></i> Settings
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> {{ __('Sign Out') }}
                                </a>
							</div>
						</div>
                        <div class="dropdown mail-profile-menu">
                            @if (Auth::user()->role_id == null)
                            <div class="main-header-notification">
                                <a class="nav-link icon" href="#">
                                    <div class="balance">
                                        ${{ Auth::user()->balance != null ? Auth::user()->balance : "0"}}
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>

						</div>
					</div>
				</div>
			</div>

			<!-- Mobile-header closed -->

<!-- Horizonatal menu-->
<div class="main-navbar hor-menu sticky">
	<div class="container">
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link" href="{{url('home')}}"><i class="fa fa-home"></i> Dashboard</a>
			</li>
            @if (Auth::user()->role_id == null)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/job-post')}}"><i class="fa fa-briefcase"></i> Post Task</a>
                </li>
			@endif
            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/job-post')}}"><i class="fa fa-briefcase"></i>Post DG Manager Task</a>
                </li>
                <li class="nav-item" id="postedJobRefresh">
					<a class="nav-link" href="{{url('/posted-job')}}"><i class="fa fa-file"></i> DG Manager Task List <sup style='color:red;'>{{ count($postedJob) }}</sup></a>
				</li>
			@endif
			@if (Auth::user()->role_id != null)
				<li class="nav-item">
					<a class="nav-link" href="{{url('/waiting-job')}}"><i class="fa fa-clock-o"></i> Waiting Job</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/withdraw-request')}}"><span style="font-size:18px;">&#x1F4B0;</span>&nbsp; Withdraw Request <sup style='color:red;'>{{ count($withdrawableList) }}</sup></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/withdraw-completed')}}"><span style="font-size:18px;">&#x1F4B0;</span>&nbsp; Withdraw Completed <sup style='color:red;'>{{ count($withdrawCompleted) }}</sup></a>
				</li>
			@endif
			@if (Auth::user()->role_id == null)
				<li class="nav-item">
					<a class="nav-link" href="{{url('/available-job')}}"><i class="fa fa-clock-o"></i>Available Task</a>
				</li>
				<li class="nav-item" id="postedJobRefresh">
					<a class="nav-link" href="{{url('/posted-job')}}"><i class="fa fa-file"></i> My Posted Job <sup style='color:red;'>{{ count($postedJob) }}</sup></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/submission-pending')}}"><i class="fa fa-clock-o"></i>Applicants Submission <sup style='color:red;'>{{ count($submissionpending) }}</sup></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/job-complete')}}"><i class="fa fa-file-text" aria-hidden="true"></i> Your Job's Completed List <sup style='color:red;'>{{ count($completedJob) }}</sup></a>
				</li>
			@endif
		</ul>
	</div>
</div>
<!--End  Horizonatal menu-->
<!--modal content  Save-->
<div id="myModalSave" class="modal fade"  role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title font-weight-bold mt-0" id="exampleModalLabel">__JOB DETAILS__</h5>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span style="font-weight: 300;">&times;</span></button>
          </div>
          <div class="modal-body">
             <div class="Catname">
                <div class="d-flex">
                   <div class="col-md-4 p-0">
                      <p><b>Job Title:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                      <div id="viewTitle"></div>
                   </div>
                </div>
             </div>
             <br>
             <div class="Catname">
                <div class="d-flex">
                   <div class="col-md-4 p-0">
                      <p><b>Job Types:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                      <div id="viewType"></div>
                   </div>
                </div>
             </div>
             <br>
             <div class="Catname">
                <div class="d-flex">
                   <div class="col-md-4 p-0">
                      <p><b>Rewards Amount:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                      <div>
                        <p><span id="viewPrice"></span></p>
                      </div>
                   </div>
                </div>
             </div>
             <br>
             <div class="Catname">
                <div class="d-flex">
                   <div class="col-md-4 p-0">
                      <p><b>No. of Respondents:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                      <div id="viewWorkers"></div>
                   </div>
                </div>
             </div>
             <br>
             <div class="Catname">
                <div class="d-flex">
                   <div class="col-md-4 p-0">
                      <p><b>Job Visibility:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                      <div id="viewVisibility"></div>
                   </div>
                </div>
             </div>
             <br>
             <div class="Catname">
                <div class="col-md-4 p-0">
                   <b>Job Details:</b>
                </div>
                <div class="col-md-12 p-0">
                   <div id="viewDetails"></div>
                </div>
             </div>
             <br>
             @if (Auth::user()->role_id != null)
             {!!Form::open(['class' => 'form-horizontal','id'=>'ActiveJob'])!!}
             @csrf
             <div class="jobPermit">
                <input type="hidden" name="jobpostId" id="jobpostId" class="form-control">
                <div class="form-group m-b-0">
                   <div>
                      <button type="submit" class="btn btn-sm  btn-primary btn-block">Active The Job</button>
                   </div>
                </div>
             </div>
             {!!Form::close()!!}
             @endif
          </div>
       </div>
    </div>
 </div>
