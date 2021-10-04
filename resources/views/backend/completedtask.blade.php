@extends('backend.home')
@section('title','DG Warrior | Completed Task')
@section('content')
<style>.dark-theme .main-footer {position: fixed;}</style>
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Approved Records</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Completed Task</li>
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
                            <h6 class="main-content-label mb-1 text-center">Applicants Completed Job(s)</h6> <br>
                        </div>
                        @if (count($completedJob) > 0)
                        @foreach ($completedJob as $item)
                        <div class="card bg-light text-white">
                            <div class="card-body submittingtask">
                                <div class="taskcomplete"><span style="color:aquamarine;font-size:25px;">&check;</span>
                                @php
                                     $completeTime = App\SubmitTask::where('user_id',$item->user_id)->where('job_id',$item->job_id)->where('status',1)->first();
                                @endphp
                                    </i> <span class="namefocus">{{ $item->getUserName->name }}(<span style="color: rgb(225, 252, 185)">{{ $item->getUserName->user_title == 1 ? "DG Executive" : "" }} {{ $item->getUserName->user_title == 2 ? "DG Manager" : "" }}{{ $item->getUserName->user_title == 3 ? "DG Director" : "" }}</span>)</span> from <span class="secondaryfocus">{{ $item->getUserName->country }}</span> had applied your &nbsp; <span style="color: rgb(133, 164, 255);">{{ $item->getJob->job_title}}</span> &nbsp; job at <span style="color: rgb(255, 170, 170);"> {{ $completeTime != null ? \Carbon\Carbon::parse($completeTime->updated_at)->format('g:i A -  jS F, Y') : ""}}</span>.
                                </div>
                                <div class="showDetails">
                                    <button type="button" class="proofOfTask btn btn-sm btn-success" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $item->id }}"><i class="fa fa-link"></i> Proof Of Task</button>&nbsp;
                                    <button class="btn btn-sm btn-secondary viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $item->job_id }}"><i class="fa fa-briefcase"></i> The job</button>
                                </div>
                            </div>
                        </div><br>
                        @endforeach
                        @else
                          <div class="card bg-light text-white">
                            <div class="card-body text-center display-4" style="font-size: 15px;color:#d49a2d;">
                                No Approved Records at this moment...
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
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Completed Task Proof</h5>
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
</script>
@endsection
