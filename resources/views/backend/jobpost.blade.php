@extends('backend.home')
@section('style')
{{-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.css')}}"> --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('title','DG Warrior | Job Post')
@section('content')

<style>.col-sm-3 {display: flex;justify-content: flex-end;align-items: center;}.level_recruit {display: flex;flex-wrap: wrap;justify-content:flex-start;align-items:flex-start;}.dark-theme .note-btn-group .btn {color: #fbfbfb!important;background: #252542;}.panel-default>.panel-heading {border: 1px solid #8e8e8e;}.note-placeholder {opacity: 0.7;font-weight: 300;font-size: 13px;}</style>
<div class="main-content pt-0">
    <div class="container">
       <!-- Page Header -->
       <div class="page-header">
          <div>
             <h2 class="main-content-title tx-24 mg-b-5">Post A Job</h2>
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Job Post</li>
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
                               <div class="level_recruit">
                                <h4 class="d-flex  mb-3">
                                    <span class="font-weight-bold text-white ">{{Auth::user()->name}}!</span>
                                 </h4>
                                  @if (Auth::user()->subscription == 1)
                                   <span style="background: #15A552;padding: 2px 10px;border: 1px solid #02a346;color: #fff;font-size: 12px;border-radius: 3px;margin-left: 10px;"><i class="fa fa-user"></i> {{ Auth::user()->user_title == 1 ? "DG Executive" : "" }}{{ Auth::user()->user_title == 2 ? "DG Manager" : "" }}{{ Auth::user()->user_title == 3 ? "DG Director" : "" }}</span>
                                  @endif
                               </div>
                               <p class="tx-white-7 mb-1">*  Post your job to get more exposure worldwide in our community.</p>
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
                            <label class="main-content-label mb-2">FILL UP the form </label> <span class="d-block tx-12 mb-0 text-muted">Fill up form to post and issue jobs based on your requirements.</span>
                         </div>
                      </div>
                      <div class="card-body offset-md-1 col-md-9 col-xs-12">
                        <div class="form_portion">
                            {!!Form::open(['class' => 'form-horizontal','id'=>'jobPost'])!!}
                            @csrf
                            <div class="form-group row flex_css">
                                <div class="col-sm-3"><label for="job title">Issue Types</label></div>
                                <div class="col-sm-9">
                                    <select class="form-control" name="issue_type" id="issue_type">
                                        <option value="">Issue Types...</option>
                                        <option value="1">Objective Task</option>
                                        <option value="2" disabled>Survey</option>
                                        <option value="3" disabled>Polls</option>
                                        <option value="4" disabled>Quiz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row flex_css">
                                <div class="col-sm-3"><label for="job title">Issue Title</label></div>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text"  name="job_title"
                                            placeholder="Job Title...">
                                </div>
                            </div>

                            @if (Auth::user()->role_id == null)
                                <div class="form-group row flex_css">
                                    <div class="col-sm-3"><label for="job_price">Rewards Amount</label></div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" min="0.5" id="perRewards"  name="job_price" placeholder="Rewards Amount For Each Respondent...">
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->role_id == 1)
                            <input type="hidden" class="form-control" readonly type="number" value="0" id="perRewards"  name="job_price">
                            <input type="hidden" class="form-control" readonly id="uaid" value="{{ Auth::user()->id }}">
                            @endif
                            <div class="form-group row flex_css">
                                <div class="col-sm-3"><label for="job title">No. of Respondents</label></div>
                                <div class="col-sm-9">
                                    <input type="number" oninput="this.value = Math.round(this.value);" min="1" class="form-control" name="job_worker" id="job_worker"  placeholder="Number of Respondent..."/>
                                </div>
                            </div>
                            <div class="form-group row flex_css">
                                <div class="col-sm-3"><label for="job title">Visibility</label></div>
                                <div class="col-sm-9">
                                    <select class="form-control" name="job_visibility" id="job_visibility">
                                        @if (Auth::user()->role_id == null)
                                            <option value="">Choose Visibility...</option>
                                            <option value="1">All Public</option>
                                            @if (Auth::user()->subscription == 1)
                                            <option value="2">Only My Team</option>
                                            <option value="3">Subscribed Users Only</option>
                                            @endif
                                        @else
                                          @if (Auth::user()->role_id == 1)
                                           <option value="4">DG Manager task Only</option>
                                          @endif
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row flex_css">
                                <div class="col-sm-3"><label for="job title">Descriptions</label></div>
                                <div class="col-sm-9">
                                    <textarea name="job_description" id="summernote" class="summernote" cols="30" rows="20"></textarea>
                                </div>
                            </div>

                            <div class="form-group submitForm">
                                <div>
                                    <button  id="reviewPost" class="btn  btn-sm btn-primary my-2 btn-icon-text">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Post Now
                                    </button>
                                    <button type="reset" class="btn btn-sm  btn-light waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                             <!-- Modal -->
                        <div class="modal fade" id="confirmationSub" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmationSubLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="confirmationSubLabel">Issue Confirmation!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div id="reviewPortion"></div>
                                    <div class="confirmationBtn text-right">
                                        <button type="submit"  id="submitPost" class="btn btn-sm btn-success my-2 btn-icon-text">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Confirm
                                            <span  id="pre-loading" class="spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-sm  btn-light m-l-5" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                            {!!Form::close()!!}
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
<script src="{{asset('backend/assets/plugins/summernote/summernote-bs4.js')}}"></script>
<script>
    const testStr = `Hello, World, all you beautiful people in it!`;

    console.log(testStr);

    $(document).ready(function() {
        var trap = false;
      $('.summernote').summernote({
        placeholder:`
        Subject: Follow Our Social Platform Account<br>
        Description : (Optional)<br>
        Directions :<br>
        Step 1: Login to your Social Platform account.<br>
        Step 2:  Search for (Example) or visit<br>
        URL： https://SocialPlatform.com/Example<br>
        Step 3: Click on follow button,<br>
        Once you have followed, take a screenshot as prove<br>
        Step 4:  Head back to Dg warrior and complete task by submitting the prove you have taken (Point 3).<br>
        Step 5: Task completed, wait for job issuer to validate and approve your submission.<br>
        `,
        tabsize: 2,
        height: 300,
        callbacks: {
            onPaste: function (e) {
                if (document.queryCommandSupported("insertText")) {
                    var text = $(e.currentTarget).html();
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                    e.preventDefault();
                } else { //IE
                    var text = window.clipboardData.getData("text")
                    if (trap) {
                        trap = false;
                    } else {
                        trap = true;
                        setTimeout(function () {
                            document.execCommand('paste', false, text);
                        }, 10);
                        e.preventDefault();
                    }
                }

            }
        }
      });
      $("#jobPost").validate({
            rules: {
                issue_type: {
                    required:true,
                },
                job_title: {
                    required:true,
                    maxlength: 80,
                },
                job_price: {
                    required:true,
                },
                job_worker: {
                    required:true,
                },
                job_visibility: {
                    required:true,
                },
                job_description: {
                    required:true,
                },
            }
        });

        $(document).on('change', '#job_visibility', function (e) {
            let id = $(this).val();
            console.log(id);
            var value = $('#job_worker').val();
            $.ajax({
                method: 'get',
                data: {
                    id, value
                },
                url: '{{ url('get-jobtype') }}/' + id + '/' + value,
                success: function (response) {
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 200,
                        "fadeOut": 3000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                    };
                    if(response.status == 0){
                        toastr.error(response.message +" you have only '"+response.userInTier+"' users");
                        $("#reviewPost").attr("disabled", true);

                    }else{$("#reviewPost").attr("disabled", false);}
                },
                error: function (err) {
                    console.log(err)
                }
            })

        });
        //review DATA
        $("#reviewPost").click(function(e) {
            e.preventDefault(e);
            var $form = $('#jobPost');
            if(! $form.valid()){return false}else{
                if($("#summernote").val().trim().length < 1){
                    Swal.fire(
                    'Descriptions field empty?',
                    'Please Enter Descriptions...',
                    'question'
                    )
                    return;
                }else{
                    $('#reviewPortion').empty();
                    // setTimeout(function(){

                    // }, 500);
                    var issueType = $("#issue_type").val();
                    var rewards = $("#perRewards").val();
                    var workers = $("#job_worker").val();
                    var visibility = $("#job_visibility").val();
                    var uaid = $("#uaid").val();
                    var totalCost = parseFloat(rewards * workers);
                    var types = issueType == 1 ? "Objective Task" : issueType == 2 ? "Survey" : issueType == 3 ? "Polls" : "Quiz";
                    var visibilitySystem = visibility == 1 ? "All Public" : visibility == 2 ? "Only My Team" : "Subscribed Users Only";
                    if(uaid == 1){
                        $("#reviewPortion").html('<p>Issue Type: '+types+'</p>' +
                        '<p>No. Of Respondents : '+workers+'</p>' +
                        '<p>Visibility : '+visibilitySystem+'</p>');
                    }else{
                        $("#reviewPortion").html('<p>Issue Type: '+types+'</p>' +
                        '<p>Reward Amount : $ '+rewards+'&nbsp; per</p>' +
                        '<p>No. Of Respondents : '+workers+'</p>' +
                        '<p>Visibility : '+visibilitySystem+'</p>'+
                        '<p>Total Cost: $ '+totalCost+' USD</p>');
                    }

                    //open
                    $('#confirmationSub').modal('show');
                }
            };
        });

        //save data
        $('#jobPost').on('submit', function (e) {
            e.preventDefault();
            // var $form = $(this);
            // if(! $form.valid()) return false;

            $( "#submitPost" ).prop( "disabled", true );
            $( "#pre-loading" ).addClass( "spinner-border");

            $.ajax({
                url: "{{route('jobpost.store')}}",
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
                    if(response.status == 2){
                        toastr.error(response.balanceWarning);
                        $( "#submitPost" ).prop( "disabled", false );
                        $( "#pre-loading" ).removeClass( "spinner-border");
                        $('#confirmationSub').modal('hide');
                        $("#ChoosePayment").modal('show');
                    }else{
                        if(response.status == 0){
                            $.each(response.error,function(key,value){
                                toastr.error(value);
                            })
                        }else{
                            if(response.status = true){
                                $( "#submitPost" ).prop( "disabled", false );
                                $( "#pre-loading" ).removeClass( "spinner-border");
                                toastr.success('Job Posted Successfully');
                                $('#jobPost').trigger('reset');
                                $('#summernote').summernote('reset');
                                $('#confirmationSub').modal('hide');
                                $("#balanceRefresh").load(location.href + " #balanceRefresh>*", "");
                            }
                        }
                    }
                }

            });

        });
    });
</script>
@endsection
