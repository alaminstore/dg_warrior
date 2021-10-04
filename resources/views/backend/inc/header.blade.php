<!-- Main Header-->
<style>.paymentBtn {border: 1px solid #fff;border-radius: 5px;box-shadow: 0px 0px 3px 3px #3e612d;}input#cnyValue {background: #b2c6eb;color: #000;border-radius: 1px;}.form-group.payment_lay{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center}.tooltip{z-index:100000000}</style>
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
				<a class="nav-link icon bellReff" href="">
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

					@if (Auth::user()->role_id != null)
					<a class="dropdown-item" href="{{ url('/user-management') }}">
						<i class="fa fa-users"></i> User Management
					</a>
					<a class="dropdown-item" href="{{ url('/topup-request') }}">
						<i class="fa fa-usd" aria-hidden="true"></i> Top Up Request
					</a>
                    <a class="dropdown-item" href="{{ url('/topup-usdt-completed') }}">
                        <i class="fa fa-usd" aria-hidden="true"></i> Accepted Top Up
                    </a>
					<a class="dropdown-item" href="{{ url('/submission-pending') }}">
						<i class="fa fa-paperclip"></i> Pending Submission
					</a>
					@endif
                    @if(Auth::user()->role_id == 1)
                    <a class="dropdown-item" href="{{ url('/all-jobs') }}">
						<i class="fa fa-briefcase"></i>All Jobs
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

					<button class="btn btn-sm dollarBtnview" style="border:none;" data-toggle="modal" data-target="#ChoosePayment">
                    <a class="nav-link icon">
                        <div class="balance">
                            ${{ Auth::user()->balance != null ? Auth::user()->balance : "0"}}
                        </div>
                    </a>
                    </button>

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
                                    <a class="dropdown-item" href="{{ url('/topup-request') }}">
                                        <i class="fa fa-usd" aria-hidden="true"></i> Top Up Request
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/topup-usdt-completed') }}">
                                        <i class="fa fa-usd" aria-hidden="true"></i> Accepted Top Up
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
                                <button class="btn btn-sm dollarBtnview" style="border:none;" data-toggle="modal" data-target="#ChoosePayment">
                                    <a class="nav-link icon">
                                        <div class="balance">
                                            ${{ Auth::user()->balance != null ? Auth::user()->balance : "0"}}
                                        </div>
                                    </a>
                                    </button>
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
                    <a class="nav-link" href="{{url('/job-post')}}"><i class="fa fa-briefcase"></i> Post Job</a>
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
					<a class="nav-link" href="{{url('/available-job')}}"><i class="fa fa-clock-o"></i>Available Job</a>
				</li>
				<li class="nav-item" id="postedJobRefresh">
					<a class="nav-link" href="{{url('/posted-job')}}"><i class="fa fa-file"></i> My Posted Job <sup style='color:red;'>{{ count($postedJob) }}</sup></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/submission-pending')}}"><i class="fa fa-clock-o"></i>Applicants Submission <sup style='color:red;'>{{ count($submissionpending) }}</sup></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{url('/job-complete')}}"><i class="fa fa-file-text" aria-hidden="true"></i> Approved Records <sup style='color:red;'>{{ count($completedJob) }}</sup></a>
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


 {{-- Start --}}
                                <!-- Modal -->
                                <div class="modal fade" id="ChoosePayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Choose Your Payment Method </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="paymentWay row">

                                            <div class="col-sm-4 text-center">
                                                <button class="usdt_pay paymentBtn"><img class="img-fluid" src="{{ asset('/images/wallets/usdt.png') }}" alt="USDT"> </button>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <button class="alipay_pay paymentBtn"><img class="img-fluid" src="{{ asset('/images/wallets/alipay.png') }}" alt="Alipay"></button>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <button class="airtm_pay paymentBtn"><img class="img-fluid" src="{{ asset('/images/wallets/airtm.png') }}" alt="Airtm"></button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- USDT Modal -->
                                <div class="modal fade" id="usdtQrModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Deposit USDT (TRC-20) </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="qrcodeScanning">
                                            <div class="visible-print text-center">
                                                {!! QrCode::size(150)->generate('TEPR9JcPwy7ANmhKyhe8zwAyXSKS7vVp8i'); !!}
                                                <br>
                                                <p class="text-white">USDT wallet address.</p>

                                                <p class="text-white" style="font-size: 14px">Wallet Address: <span style="color:rgb(10, 236, 78);">TEPR9JcPwy7ANmhKyhe8zwAyXSKS7vVp8i</span> &nbsp;&nbsp;
                                                    <button type="button" class="btn  btn-sm btn-outline-primary text-white" id="btnUsdt_cop" onclick="copyUsdtAddress('#usdtAddress')"><i class="fa fa-copy"></i></button>
                                                    <span id="usdtAddress" style="display: none">TEPR9JcPwy7ANmhKyhe8zwAyXSKS7vVp8i</span>
                                                </p>
                                            </div>

                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label text-white tx-12">TopUp Amount</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" min=10 step="any" name="usdtbalanceCopy" id="usdtbalanceCopy" placeholder="Minimum Topup amount 10 USD">
                                                </div>
                                            </div>
                                            <p class="text-white" style="font-size: 13px;text-align:center">Screenshot and submit your transaction receipt</p>
                                            <div class="imp text-white">
                                                Important:
                                                <ul>
                                                    <li>Send only TRC20 USDT to this deposit address. Sending any other coin or token to this address may result in the lose of your deposit permanently</li>
                                                    <li>Ensure the wallet address is correct before you do any transaction. Sending to the incorrect address may result in the lose of your deposit permanently.</li>
                                                    <li>Depositing to the above address requires confirmations of the entire network. It will arrive after your network confirmation.</li>
                                                </ul>
                                            </div>

                                            <div class="text-center"><button  class="btn btn-secondary btn-sm transactionIdSubmission" style="color: #000;"> <i class="fa fa-grav" aria-hidden="true"></i> Submit Proof</button></div>

                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Alipay Modal -->
                                <div class="modal fade" id="alipayQrModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold text-center" style="font-size: 12px" id="staticBackdropLabel">Deposit By Alipay <br>Exchange rate: 6.8 CNY to 1 DG USD </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="qrcodeScanning">
                                            <div class="visible-print text-center">
                                                {!! QrCode::size(150)->generate('https://qr.alipay.com/tsx18266erap1rbtbzv4h0f'); !!}
                                                <br>
                                                <p class="text-white">Scan QR Code Above</p>
                                                <p class="text-white" style="font-size: 13px">Screenshot and submit your transaction receipt</p>
                                            </div>
                                            <div class="imp text-white">
                                                Important:
                                                <ul>
                                                    <li>Send only CNY to this deposit address. Sending any other coin or token to this address may result in the lose of your deposit permanently</li>
                                                    <li>Ensure the wallet address is correct before you do any transaction. Sending to the incorrect address may result in the lose of your deposit permanently.</li>
                                                    <li>Depositing to the above address requires confirmations of the payment gateway. Credits will be added after confirmation.</li>
                                                </ul>
                                            </div>
                                            <div class="text-center"><button class="btn btn-secondary btn-sm alipaytransactionIdSubmission"> <i class="fa fa-grav" aria-hidden="true"></i> Click Here...</button></div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- USDT SUBMIT Modal -->
                                <div class="modal fade" id="usdtAmountVerify" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Transaction ID</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="qrcodeScanning">
                                            {!!Form::open(['class' => 'form-horizontal','id'=>'trxidWithBalance'])!!}
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label text-white">TrxID</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="trxid" id="trxidvalue" placeholder="649EWFEXXXX...">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="hidden"  step="any" name="balance" id="balance" placeholder="The amount of $_balance you sent from app...">
                                                </div>
                                            </div>
                                            <input type="hidden" name="payment_method" value="USDT(TRC-20)">
                                            <div class="form-group row">
                                                <label for="image" class="col-sm-3 col-form-label text-white">Screenshot:</label>
                                                <div class="col-md-9">
                                                    <input type="file" name="image" id="screenShotimage" data-max-file-size="1M" data-allowed-file-extensions="png jpg jpeg jfif"  class="dropify"/>
                                                </div>
                                            </div>

                                            <div class="form-group m-b-0">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-sm  btn-primary">
                                                        <i class="fa fa-dollar"></i> Submit Transaction ID...
                                                    </button>
                                                </div>
                                            </div>
                                            {!!Form::close()!!}
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Alipay SUBMIT Modal -->
                                <div class="modal fade" id="alipayAmountVerify" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Transaction Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="qrcodeScanning">
                                            {!!Form::open(['class' => 'form-horizontal','id'=>'trxidWithBalanceTwo'])!!}
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label text-white">Alipay Account</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="trxid" id="trxid" placeholder="User ID">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label text-white">Amount</label>
                                                <div class="col-sm-9">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <input class="form-control" type="number" min="10" step="any" name="balance" id="balanceTop" placeholder="USD" onkeyup="cnyCalculator()" >
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input class="form-control" readonly type="text"  id="cnyValue">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="payment_method" value="Alipay">
                                            <div class="form-group row">
                                                <label for="image" class="col-sm-3 col-form-label text-white">Screenshot:</label>
                                                <div class="col-md-9">
                                                    <input type="file" name="image" id="screenShotimage2" data-max-file-size="1M" data-allowed-file-extensions="png jpg jpeg jfif"  class="dropify"/>
                                                </div>
                                            </div>

                                            <div class="form-group m-b-0">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-sm  btn-primary">
                                                        <i class="fa fa-dollar"></i> Submit Receipt
                                                    </button>
                                                </div>
                                            </div>
                                            {!!Form::close()!!}
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="airtmTopupSectionM" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            <span class="font-weight-bold">Topup Through Airtm</span>
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
                                {{-- End --}}
