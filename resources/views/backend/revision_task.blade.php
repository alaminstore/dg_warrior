@extends('backend.home')
@section('title','DG Warrior | Revision Task')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection
@section('content')
<style>.dark-theme .main-footer {position: fixed;} i.fe.fe-check{font-size: 30px;color: aquamarine;}.dropify-wrapper .dropify-message span.file-icon {font-size: 20px;color: #CCC;}.dropify-wrapper{line-height:30px!important}.detailsForm{display: none;}.togglebtn {-moz-transition: all .5s linear;-webkit-transition: all .5s linear;transition: all .5s linear;}.togglebtn.down {-moz-transform:rotate(180deg);-webkit-transform:rotate(180deg);transform:rotate(180deg);}</style>
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Your Task Revision List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Revision Task</li>
        </ol>
    </div>

</div>
<!-- End Page Header -->
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body submissionDiv">
                        <div>
                            <h6 class="main-content-label mb-1 text-center">Your Revision Task(s)</h6>
                            <p class="text-muted card-sub-title text-center">Acknowledge by clicking the accept button to receive incentive rewards from issuer</p>
                        </div>
                        @if (count($revisionList) > 0)
                        @foreach ($revisionList as $item)
                        <div class="card bg-light text-white">
                            <div class="card-body submittingtask">
                                <div class="col-md-10 col-xs-12 p-0">
                                    <div class="taskcomplete text-left">
                                        Job Title:&nbsp;<span class="namefocus"> {{$item->getJobPost->job_title }}</span>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12  p-0">
                                    <div class="showDetails centerprocess">
                                        <button class="btn btn-sm btn-primary viewInstruction" data-toggle="modal" data-target="#viewInstruction" data-id="{{ $item->id }}"><i class="fa fa-adjust" aria-hidden="true"></i> Instruction</button>
                                        <button class="btn btn-sm btn-secondary viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $item->job_id }}"><i class="fa fa-briefcase"></i> The job</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center positionIcon">
                                <button class="btn togglebtn">
                                    <span><i class="fa fa-angle-double-down"></i></span>
                                </button>
                            </div>
                        </div>
                            <div class="detailsForm">
                                <div class="resubmitTitle"><br>
                                    <h6 class="text-center display-4" style="font-size: 25px;">__Resubmit Your Task-Proof Here__</h6>
                                </div><br>
                                <div class=" offset-md-2 col-md-6 col-sm-12 ">
                                {!!Form::open(['class' => 'form-horizontal','id'=>'jobresubmit'])!!}
                                    @csrf
                                    <div class="clr"></div>
                                    <div class="form-group row">
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
                                    <input type="hidden" name="submittask_id" value="{{ $item->submittask_id }}">
                                    <input type="hidden" name="revision_id" value="{{ $item->id }}">

                                    <div class="form-group row">
                                        <label for="job_price" class="col-sm-3 col-form-label">Proof By Screenshot:</label>
                                        <div class="col-md-9">
                                            <input type="file" name="proof_image" id="proof_image" data-allowed-file-extensions="png jpg jpeg"  class="dropify"/>
                                        </div>
                                    </div>

                                    <div class="form-group submitForm">
                                        <div>
                                            <button type="submit" id="submitPost" class="btn btn-sm btn-primary">
                                                <i class="fa fa-share-square" aria-hidden="true"></i>&nbsp; Submit Here
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-light">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                {!!Form::close()!!}
                                </div>
                            </div>
                        </div><br>
                        @endforeach
                        @else
                          <div class="card bg-light text-white">
                            <div class="card-body text-center display-4" style="font-size: 15px;color:#d49a2d;">
                                No Task Revision is available right now.
                            </div>
                          </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="viewInstruction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Instruction for Resubmission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span style="font-weight: 300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
            <div class="Catname">
                <div class="">
                   <div class="col-md-12 col-sm-12 col-xs-12  p-0">
                      <p style="color: rgb(12, 239, 247)"><b>Instruction:</b></p>
                   </div>
                   <div class="col-md-12 col-sm-12 col-xs-12  p-0">
                      <div id="showInstruction"></div>
                   </div>
                </div>
             </div>
             <br>
            <div class="Catname">
                <div class="d-flex">
                   <div class="col-md-2 col-sm-12 col-xs-12 p-0">
                      <p style="color: rgb(12, 239, 247)"><b>Notify You(Date):</b></p>
                   </div>
                   <div class="col-md-10 col-sm-12 col-xs-12  p-0">
                      <div id="viewDate"></div>
                   </div>
                </div>
             </div>
             <br>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready( function () {
        $('#proof_image').dropify();
        $('.togglebtn').click(function(){
            $('.detailsForm').toggle(500);
            $('.togglebtn').toggleClass("down");
        });
    });
    //View===============================================================
  $(document).on('click', '.viewInstruction', function () {
        let id = $(this).attr('data-id');
        // console.log('id--', id);
        $.ajax({
            url: "{{url('view-instruction')}}/" + id,
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                let url = window.location.origin;
                console.log('data', response.data);
                $('#showInstruction').html(response.data.instruction);
                var checkingDate = new Date(response.data.created_at).toDateString()
                $('#viewDate').html(checkingDate);
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });

    $("#jobresubmit").validate({
        rules: {
            proof_text: {
                required:true,
                maxlength:1000
            }
        }
    });

    //save data
    $('#jobresubmit').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('jobresubmit.store')}}",
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
                    if(response.status == 0){
                        $.each(response.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status = true){
                            toastr.success('Resubmitted your task successfully!');
                            $('#jobresubmit').trigger('reset');
                            setTimeout(function(){
                                window.location.reload();
                            }, 1500);
                        }
                    }

                }

            });

        });

</script>
@endsection
