@extends('backend.home')
@section('title','DG Warrior | Settings')
@section('content')
<style>.level_recruit {display: flex;justify-content: flex-start;align-items: end;}.dark-theme .main-footer {position: fixed;}</style>
<div class="main-content pt-0">
   <div class="container">
      <div class="page-header">
         <div>
            <h2 class="main-content-title tx-24 mg-b-5">You Can Reset Your Password</h2>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('/') }}">Password Option</a></li>
               <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
                     <div class="card-body">
                        <div class="col-md-12">

                            <div class="ms-panel">
                              <div class="ms-panel-body">
                                <h6 class="text-center" style="opacity: 0.6;">For Changing your password, you must have to varify your current password.</h6><br>

                                <div class="col-md-12">
                                {!!Form::open(['class' => 'form-horizontal','id'=>'oldPassForm'])!!}
                                 @csrf
                                 <div class="row flx">
                                    <div class="offset-md-2 col-md-5">
                                        <div class="form-group row">
                                            <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="Enter Current password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="submit" class="btn btn-square btn-primary has-icon" title="Reset">
                                            <i class="fa fa-cogs"></i> Password Change</button>
                                    </div>
                                 </div>
                                {!!Form::close()!!}
                                </div>
                              </div>
                            </div>

                    <div id="myModalSaving" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog passModel">
                       <div class="modal-content">
                           <div class="modal-header">
                               <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Password Change</h5></div>
                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-weight: 300;">&times;</button>
                           </div>
                           <div class="modal-body">
                            <div class="wrapper-page">

                                <div class="p-1">
                                    <h4 class="text-muted font-18 mb-3 text-center">Reset Password</h4>
                                    {!!Form::open(['class' => 'form-horizontal','id'=>'newPassForm'])!!}
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="OldPass">New Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="newPass" name="newPass" placeholder="New password..."required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="OldPass">Confirm Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="confirmPass" id="confirmPass" placeholder="Confirm password..." required>
                                            </div>
                                        </div>

                                        <div class="form-group row m-t-20">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary btn-square btn-sm" type="submit"><i class="fa fa-cogs"></i> Password Reset</button>
                                            </div>
                                        </div>

                                        {!!Form::close()!!}
                                </div>
                            </div>
                           </div>
                       </div>
                    </div>
                    </div>
                            {{-- Modal End--}}

                          </div>
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $("#oldPassForm").validate({
            rules: {
                oldpass: {
                    required:true,
                }
            }
        });
        $("#newPassForm").validate({
            rules: {
                newPass: {
                    required:true,
                    minlength:8
                },
                confirmPass: {
                    required:true,
                    equalTo: "#newPass"
                }
            }
        });
    });

    $('#oldPassForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        if(! $form.valid()) return false;
        $.ajax({
            url: "{{route('reset.check')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('data',data.success);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                    // console.log();
                };
                if (data.success == true) {
                    $("#myModalSaving").modal('show');
                    setTimeout(function () {
                        $('#oldPassForm').trigger('reset');
                        }, 500);
                }else{
                    toastr.error('Please enter the correct password');
                }
            }
        });
    });

    $('#newPassForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        if(! $form.valid()) return false;
        $.ajax({
            url: "{{route('newPass.change')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('data',data.success);
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
                // toastr.error('Password must contain minimum 8 character!');
                $.each(data.error,function(key,value){
                toastr.error(value);
                })
            }else{
                if (data.success == true) {
                toastr.success('Password has been changed');
                $('#newPassForm').trigger('reset');
                $("#myModalSaving").modal('hide');
                }else{
                    toastr.error('Not match with confirmation password');
                }
            }

            }
        });
    });

</script>
@endsection
