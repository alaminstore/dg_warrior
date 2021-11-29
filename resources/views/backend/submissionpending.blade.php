@extends('backend.home')
@section('title','DG Warrior | Pending Submission')
<style>.swal2-icon.swal2-warning {font-size: 15px!important;}.media-body:hover {background: #141313;}.modal-footer {display: flex;align-items: center!important;justify-content: center!important;padding: 1rem;border-top: 1px solid #e8e8f7;border-bottom-right-radius: 0.3rem;border-bottom-left-radius: 0.3rem;}.showDetails {display: flex;flex-wrap: wrap;justify-content: center;align-items: center;}.paginateMiddle {display: flex;justify-content: center;align-items: baseline;}</style>
@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Verify Applicant Submission</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pending Submission</li>
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
                                <h6 class="main-content-label mb-1">{{Auth::user()->role_id != null ? "User's Job's Task waiting list": "My Issued Task Submission : "}}</h6>
                                <p class="text-muted card-sub-title">
                                    Inspect and accept the task submitted, leave a comment if the requirement is not met. <br>
                                    Reject the task if it has not been carried out in due diligence (respondent will not receive task rewards).
                                </p>
                            </div>
                            @if (count($submissionpending) != 0)
                              @foreach ($submissionpending as $item)
                                <div class="card bg-light text-white">
                                  <div class="card-body submittingtask">
                                      <span class="namefocus">{{ $item->getUserName->name }}</span> from <span class="secondaryfocus">{{ $item->getUserName->country }}</span>  submitted the task's proof of your job.
                                      <div class="showDetails">
                                        @if(Auth::user()->role_id == 1)
                                        <button type="button" class="proofOfTask btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $item->id }}"><i class="fa fa-link"></i> Proof Of Task</button>&nbsp;
                                        <button type="button" class="revisionSystem btn btn-sm  btn-success" data-toggle="modal" data-target="#revisionChance" data-id="{{ $item->id }}"><i class="fa fa-folder"></i> Revision</button>&nbsp;
                                        @else
                                        @if (Auth::user()->role_id == 2 && $jobPower == true)
                                        <button type="button" class="proofOfTask btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $item->id }}"><i class="fa fa-link"></i> Proof Of Task</button>&nbsp;
                                        <button type="button" class="revisionSystem btn btn-sm  btn-success" data-toggle="modal" data-target="#revisionChance" data-id="{{ $item->id }}"><i class="fa fa-folder"></i> Revision</button>&nbsp;
                                        @endif
                                        @endif
                                        @if (Auth::user()->role_id == null)
                                        <button type="button" class="proofOfTask btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $item->id }}"><i class="fa fa-link"></i> Proof Of Task</button>&nbsp;
                                        <button type="button" class="revisionSystem btn btn-sm  btn-success" data-toggle="modal" data-target="#revisionChance" data-id="{{ $item->id }}"><i class="fa fa-folder"></i> Revision</button>&nbsp;
                                        @endif
                                      <button class="btn btn-sm btn-secondary viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $item->job_id }}"><i class="fa fa-briefcase"></i> The job</button>
                                      </div>
                                  </div>
                                </div><br>
                              @endforeach
                               <div class="paginateMiddle">{{ $submissionpending->links() }}</div>
                            @else
                            <div class="card bg-light text-white">
                              <div class="card-body text-center display-4" style="font-size: 15px;color:#d49a2d;">
                                No Submission From Respondent Now
                              </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
<!-- End Main Content-->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Proof of the Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span style="font-weight: 300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="taskproof">
            <h3 class="text-center display-4" style="font-size: 18px;">Proof By Screenshot:</h3>
            <div id="viewScreenshot"></div><br>
            <h3 class="text-center display-4" style="font-size: 18px;">Proof By Message:</h3>
            <div id="viewTextMessage"></div>
          </div>
        </div>
        <div class="modal-footer">
        {!!Form::open(['class' => 'form-horizontal','id'=>'acceptSubmission'])!!}
          @csrf
          <input type="hidden" name="hiddenAccept" id="hiddenAccept" class="form-control">
          <input type="hidden" name="hiddenUserId" id="hiddenUserId" class="form-control">
          <input type="hidden" name="hiddenJobId" id="hiddenJobId" class="form-control">
          <div class="form-group m-b-0">
            <div>
              <button type="submit" class="btn btn-square btn btn-primary btn-block">
                Accept
              </button>
            </div>
          </div>
		{!!Form::close()!!}

        {!!Form::open(['class' => 'form-horizontal','id'=>'rejectSubmission'])!!}
          @csrf
          <input type="hidden" name="hiddenReject" id="hiddenReject" class="form-control">
          <div class="form-group m-b-0">
            <div>
              <button type="submit" class="btn btn-square btn btn-danger btn-block">
                Reject
              </button>
            </div>
          </div>
		{!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="revisionChance" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Resubmission Instructions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-weight: 300;font-size:30px;"><span style="font-weight: 300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
          {!!Form::open(['class' => 'form-horizontal','id'=>'revisionSubmit'])!!}
            @csrf
            <input type="hidden" name="user_id" id="userid" class="form-control">
            <input type="hidden" name="client_id" id="clientid" class="form-control">
            <input type="hidden" name="job_id" id="jobid" class="form-control">
            <input type="hidden" name="submit_id" id="submitid" class="form-control">
            <div class="form-group row">
            <label for="instruction font-weight-bold" class="col-sm-12 col-form-label"><b>Instruction:</b></label>
            <div class="col-sm-12">
                <textarea name="instruction" class="form-control" id="" cols="30" rows="12" placeholder="Write here the reason/instruction for resubmission..."></textarea>
            </div>
            </div>
            <div class="form-group  m-b-0">
                <button type="submit" class="btn btn-sm btn btn-success btn-block">
                    Revision Chance
                </button>
            </div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>



@endsection
@section('js')
<script>
  $(document).on('click', '.proofOfTask', function () {
        let id = $(this).attr('data-id');
        // console.log('id--', id);
        $.ajax({
            url: "{{url('proofOfTask')}}/" + id,
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                let url = window.location.origin;
                console.log('data', response.data);
                $('#viewTextMessage').html(response.data.proof_text);
                $('#viewScreenshot').empty();
                if(response.data.proof_image != null){
                    $('#viewScreenshot').html(`<img class="img-fluid"  src="${url}/${response.data.proof_image}"/>`);
                }else{
                    $('#viewScreenshot').html(`No Screenshot available from this user, you have to justify by only investigate text proof.`);
                }
                $('#hiddenAccept').val(response.data.id);
                $('#hiddenReject').val(response.data.id);
                $('#hiddenUserId').val(response.data.user_id);
                $('#hiddenJobId').val(response.data.job_id);
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });
  $(document).on('click', '.revisionSystem', function () {
    let id = $(this).attr('data-id');
    // console.log('id--', id);
    $.ajax({
        url: "{{url('revisionSystem')}}/" + id,
        method: "get",
        data: {},
        dataType: 'json',
        success: function (response) {
            let url = window.location.origin;
            console.log('data', response.data);
            $('#jobid').val(response.data.job_id);
            $('#clientid').val(response.data.client_id);
            $('#userid').val(response.data.user_id);
            $('#submitid').val(response.data.id);
        },
        error: function (error) {
            if (error.status == 404) {
                toastr.error('Not found!');
            }
        }
    });
});

$('#acceptSubmission').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
          url: "{{route('submittask.update')}}",
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
              toastr.success(response.message);
              setTimeout(function(){
                window.location.reload();
              }, 1500);
            //   $("#submissionDiv").load(location.href + " #submissionDiv>*", "");
            }
          }
      });

  });
$('#rejectSubmission').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
          url: "{{route('rejecttask.destroy')}}",
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
              toastr.success(response.message);
              setTimeout(function(){
                window.location.reload();
              }, 1500);
            //   $("#submissionDiv").load(location.href + " #submissionDiv>*", "");

            }
          }

      });

  });
$('#revisionSubmit').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
          url: "{{route('revision.Submit')}}",
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
              $('#revisionChance').modal('hide');
              toastr.success(response.message);
              setTimeout(function(){
                window.location.reload();
              }, 1500);
            }
          }

      });

  });
</script>
@endsection
