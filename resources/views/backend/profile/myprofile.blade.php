@extends('backend.home')
@section('title','DG Warrior | Profile')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection
@section('content')
<style>#icon{cursor:pointer;display:none}button#icon{position:absolute;top:33%;left:87%}@media screen and (max-width:768px){button#icon{position:absolute;top:39%;left:64%}}.list-group-item{border-bottom:2px solid #f2e9e9}.dropify-wrapper{line-height:30px!important}.dropify-wrapper .dropify-message span.file-icon {font-size: 20px!important;color: #CCC;}.col-sm-3{display:flex;justify-content:flex-end;align-items:center}nav.nav.main-nav-line.p-3.tabs-menu.profile-nav-line.bg-gray-100{display:flex;flex-wrap:wrap!important;justify-content:space-between;align-items:baseline}h4.tx-15.mb-3 {display: flex;flex-wrap: wrap;justify-content: space-between;align-items: baseline;border: 2px solid #826a6a;border-radius: 5px;padding: 8px 7px;background: #826a6a;}.profile-cover__action {background-size: cover;background-position: center;width: 100%;height: auto;}</style>
<div class="main-content pt-0">
    <div class="container">
       <!-- Page Header -->
       <div class="page-header">
          <div>
             <h2 class="main-content-title tx-24 mg-b-5">Profile Page</h2>
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
             </ol>
          </div>
       </div>
       <!-- End Page Header -->
       <!--Row-->
       <div class="row row-sm">
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="row square">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="panel profile-cover">
                                <div class="layout_center">
                                    <div class="profile-cover__img" id="profileImageReview">
                                        <img src="{{asset(Auth::user()->image == null ? "/user.png" : Auth::user()->image )}}" alt="img" />
                                        <button id="icon" class="btn btn-sm btn-primary imagechange" title="change image" data-id="{{ Auth::user()->id }}" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-camera"></i>
                                        </button>
                                        <h3 class="h3">{{ Auth::user()->name }}</h3>
                                    </div>
                                    <div class="btn-profile">
                                        <button class="btn btn-rounded btn-danger" id="withdrawableamountUpdated">
                                            <i class="fa fa-dollar"></i>
                                            <span>{{ Auth::user()->withdrawable == null ? "0" : number_format((float)Auth::user()->withdrawable, 2, '.', '')}}</span>
                                        </button>
                                        <button class="btn btn-rounded btn-success" data-toggle="modal" data-target="#widrawable">
                                            <span style='font-size:20px;'>&#9839;</span><span> Withdraw Request</span>
                                        </button>
                                    </div>
                                    <div class="profile-cover__action bg-img"></div>
                                    <div class="gap"></div><br>
                                </div>
                            </div>
                            <div class="profile-tab tab-menu-heading">
                                <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                                    <a class="nav-link  active" id="hideEdit" data-toggle="tab" href="#about">Information in Detail </a>
                                    <a class="nav-link" id="editprofile" data-toggle="tab" href="#edit">Edit Profile</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card main-content-body-profile">
									<div class="tab-content">
										<div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
											<div class="card-body p-0 border p-0 rounded-10">
												<div class="p-4">
													<h4 class="tx-15 mb-3">UserName: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->username }}</span></h4>
													<h4 class="tx-15 mb-3">Gender: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->gender }}</span></h4>
													<h4 class="tx-15 mb-3">Email: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->email }}</span></h4>
													<h4 class="tx-15 mb-3">Birthday: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ \Carbon\Carbon::parse(Auth::user()->birth_date)->format('jS F, Y') }}</span></h4>
													<h4 class="tx-15 mb-3">Address: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->address}}</span></h4>
													<h4 class="tx-15 mb-3">City: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->city}}</span></h4>
                                                    <h4 class="tx-15 mb-3">Zipcode: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->zipcode }}</span></h4>
													<h4 class="tx-15 mb-3">State / Region: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->state}}</span></h4>
                                                    <h4 class="tx-15 mb-3">Country of Residence: <span style="font-weight: 400;font-size:13px;background: #364d77;padding: 0 10px;border-radius: 4px;">{{ Auth::user()->country }}</span></h4>
												</div>
											</div>
										</div>
										<div class="main-content-body tab-pane p-4 border-top-0" id="edit">
											<div class="card-body border">
												<div class="mb-4 main-content-label">Personal Information</div>
												{!!Form::open(['class' => 'form-horizontal','id'=>'profileUpdate'])!!}
                                                @csrf
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Name</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" name="name" placeholder="Name..." value="{{ Auth::user()->name }}">
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Birth Date</label>
															</div>
															<div class="col-md-9">
																<input type="date" class="form-control" name="birth_date" placeholder="Birth Date" value="{{ Auth::user()->birth_date }}">
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Address</label>
															</div>
															<div class="col-md-9">
																<textarea class="form-control" name="address" rows="2" placeholder="Address">{{ Auth::user()->address }}</textarea>
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">City</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" name="city" placeholder="City..." value="{{ Auth::user()->city }}">
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Zipcode</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" name="zipcode" placeholder="zipcode..." value="{{ Auth::user()->zipcode }}">
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">State / Region</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control"  name="state" placeholder="State..." value="{{ Auth::user()->state }}">
															</div>
														</div>
													</div>
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
													<div class="form-group submitForm">
                                                        <div>
                                                            <button type="submit" id="submitPost" class="btn btn-sm btn-primary my-2 btn-icon-text">
                                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Update Here
                                                            </button>
                                                            <button type="reset" class="btn btn-sm btn-square btn-light waves-effect m-l-5">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div><br><br>
                                                {!!Form::close()!!}
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->
                </div>
            </div>
            </div>
        </div>
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span style="font-weight: 300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
            {!!Form::open(['class' => 'form-horizontal','id'=>'changeProfileImage'])!!}
                @csrf
                <div class="form-group row flex_css">
                    <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="image" id="image" class="dropify">
                        <input type="hidden" name="user_id"  id="user_id">
                    </div>
                </div>
                <div class="form-group m-b-0 text-right">
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary" id="btn-loading">
                        <span  id="pre-loading" class="spinner-border-sm" role="status" aria-hidden="true"></span>
                            Update Here...
                        </button>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="widrawable" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel"> Withdraw Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span class="font-weight:300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
          {!!Form::open(['class' => 'form-horizontal','id'=>'withdrawRequest'])!!}
            @csrf
            <div id="withdrawableamountUpdatedModal">
                <h6 class="text-center font-weight-bold">Your Current Widrable amount : <span class="bg">${{ Auth::user()->withdrawable == null ? "0" : Auth::user()->withdrawable}}</span></h6>
            </div><br>

             <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                    <input class="form-control" type="number" min="15"  name="withdraw_amount" placeholder="$ amount...">
                    <input class="form-control" type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="withdraw_user_id">
                </div>
            </div>
            <div class="form-group row">
                <label for="wallet_name" class="col-sm-3 col-form-label">Wallet</label>
                <div class="col-sm-9">
                    <select name="wallet_name" id="" class="form-control">
                        <option value="USDT (TRC-20)" selected>USDT (TRC-20)</option>
                        <option value="Airtm">Airtm</option>
                    </select>
                </div>
            </div>
             <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">WalletAddress</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text"  name="wallet_address" placeholder="wallet address here...">
                </div>
            </div>
            <div class="form-group m-b-0 text-right">
                <div>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Send Request
                    </button>
                </div>
            </div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
 @endsection
 @section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
 <script>
     $(document).ready( function () {
        $('.dropify').dropify();
    });
    $("#editprofile").click(function(){
      $("#icon").show();
    });
    $("#hideEdit").click(function(){
      $("#icon").hide();
    });

    //Get Image
    $(document).on('click', '.imagechange', function () {
        let id = $(this).attr('data-id');

        $.ajax({
            url: "{{url('portfolio-image')}}/" + id + '/edit',
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                console.log('response',response);
                $('#user_id').val(response.data.id);
                if (response.data.image) {
                    var img_url = '{!!URL::to('/')!!}' + "/" + response.data.image;
                    console.log(img_url);
                    $("#image").attr("data-height", 100);
                    $("#image").attr("data-default-file", img_url);
                    $(".dropify-wrapper").removeClass("dropify-wrapper").addClass("dropify-wrapper has-preview");
                    $(".dropify-preview").css('display', 'block');
                    $('.dropify-render').html('').html('<img src=" ' + img_url + '" style="max-height: 100px;">')
                } else {
                    $(".dropify-preview .dropify-render img").attr("src", "");
                }
                $("#image").dropify();
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });


     //Update Profile Image
     $('#changeProfileImage').on('submit', function (e) {
            e.preventDefault();
            $( "#btn-loading" ).prop( "disabled", true );
            $( "#pre-loading" ).addClass( "spinner-border");
            $.ajax({
                url: "{{route('backend.portfolioimage')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log('update', data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if(data.status = true){
                        $('#exampleModal').modal('hide');
                        $( "#btn-loading" ).prop( "disabled", false );
                        $( "#pre-loading" ).removeClass( "spinner-border");
                        toastr.success('Your Profile Image Updated Successfully!');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    }
                }
            });
        });
        $("#withdrawRequest").validate({
            rules: {
                withdraw_amount: {
                    required:true,
                    maxlength: 10,
                },
                wallet_address: {
                    required:true,
                }
            }
        });

        //save data
        $('#withdrawRequest').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('withdraw.request')}}",
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
                    if(response.status == 3){
                        toastr.error(response.message);
                    }else{
                        if(response.status == 2){
                            toastr.error(response.notification);
                        }else{
                            if(response.status == 0){
                                $.each(response.error,function(key,value){
                                    toastr.error(value);
                                })
                            }else{
                                if(response.status == true){
                                    $('#withdrawRequest').trigger('reset');
                                    $('#widrawable').modal('hide');
                                    toastr.success('Withdraw request sent Successfully!');
                                    setTimeout(function () {
                                        $("#withdrawableamountUpdated").load(location.href + " #withdrawableamountUpdated>*", "");
                                        $("#withdrawableamountUpdatedModal").load(location.href + " #withdrawableamountUpdatedModal>*", "");
                                    }, 1500);
                                }
                            }
                        }
                    }
                }

            });

        });
     //Update Profile Informations
     $('#profileUpdate').on('submit', function (e) {
            e.preventDefault();
            // var $form = $(this);
            // if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('profileInfo.updated')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log('update', data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if(data.status == 0){
                        $.each(data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(data.status = true){
                            toastr.success('Your Information Updated Successfully!');
                        }
                    }
                }
            });
        });
 </script>
 @endsection
