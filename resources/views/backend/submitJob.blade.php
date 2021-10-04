@extends('backend.home')
@section('title','DG Warrior | Submit Task')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection
@section('content')
<style>.alert-dismissible .close {top: 21%;}</style>
<style>.list-group-item {border-bottom: 2px solid #f2e9e9;}.dropify-wrapper .dropify-message span.file-icon {font-size: 20px;color: #CCC;}.dropify-wrapper{line-height:30px!important}</style>
<div class="main-content pt-0">
   <div class="container">
      <!-- Page Header -->
      <div class="page-header">

         <div>
            <h2 class="main-content-title tx-24 mg-b-5">Submit Your Task</h2>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Task Submission</li>
            </ol>
         </div>
      </div>
      <!-- End Page Header -->
      <!--Row-->
      <div class="row row-sm">
         <div class="col-sm-12 col-lg-12 col-xl-12">
            <!--row-->
            <div class="row row-sm">
               <div class="col-sm-12 col-lg-12 col-xl-12">
                  <div class="card custom-card overflow-hidden">
                     <div class="card-header border-bottom-0">
                        <div>
                           <label class="main-content-label mb-2">Job Title: <br> <span style="font-weight: 400;font-size:13px;">{{ $submitJob->job_title }}</span></label> <span class="d-block tx-12 mb-0 text-muted">
                            Job client: <span class="bg">{{ $submitJob->user_name }}</span>
                           </span>
                        </div>
                     </div>

                     <div class="card-body">
                        <div class=" offset-md-2 col-md-6 col-sm-12 ">
                        @if ($submitJob->job_type == 1 )
                            @php
                               $exitOrNot = App\TaskCheck::where('user_id','=', Auth::user()->id)->first();
                            @endphp
                            @if ($exitOrNot)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>Hey {{ Auth::user()->username }}!</strong><br>You already fillup the free cupon, now according to rules, $1 will be deducted per task acceptance.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @endif
                        @endif

                            <form action="{{route('jobsubmit.store')}}" method="post" id="submitJobOption" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row flex_css">
                                <label for="job_title" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input class="form-control" readonly type="hidden"  name="client_id" value="{{ $submitJob->user_id }}">
                                    <input class="form-control" readonly type="hidden"  name="user_id" value="{{ Auth::user()->id }}">
                                    <input class="form-control" readonly type="hidden"  name="job_id" value="{{ $submitJob->id }}">
                                    <input class="form-control" readonly type="hidden"  name="job_type" value="{{ $submitJob->job_type }}">
                                    <input class="form-control" readonly type="hidden"  name="job_price" value="{{ $submitJob->job_price }}">
                                </div>
                            </div>

                            <div class="form-group row flex_css">
                                <label for="job_type" class="col-sm-3 col-form-label">Proof By Writing:</label>
                                <div class="col-sm-9">
                                    <textarea name="proof_text" class="form-control" id="proof_text" cols="30" rows="7" placeholder="Write the proof here..."></textarea>
                                </div>
                            </div>
                            <div class="form-group row text-center">

                                <label for="job_type" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9" style="display: flex;justify-content:center;">
                                 <b>__Or__</b>
                                </div>
                            </div>

                            <div class="form-group row flex_css">
                                <label for="proof_image" class="col-sm-3 col-form-label">Proof By Screenshot:</label>
                                <div class="col-md-9">
                                    <input type="file" name="proof_image" id="proof_image" data-max-file-size="1M" data-allowed-file-extensions="png jpg jpeg jfif"  class="dropify"/>
                                </div>
                            </div>

                            <div class="form-group submitForm">
                                <div>
                                    <button type="submit" id="submitPost" class="btn btn-primary my-2 btn-icon-text btn-sm">
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit Here
                                    </button>
                                    <button type="reset" class="btn btn-square btn-light waves-effect m-l-5 btn-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                           </form>
                        </div>
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

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready( function () {
        $('#proof_image').dropify();
    });
    $("#submitJobOption").validate({
            rules: {
                proof_text: {
                    required:true,
                    minlength: 10,
                    maxlength: 1000
                }
            }
        });
</script>
@endsection
