@extends('backend.home')
@section('title','DG Warrior | Subscription')

@section('content')

<style>.dark-theme .main-footer {position: fixed;}.swal2-icon.swal2-question {font-size: 15px;line-height: 55px;text-align: center;background: #2f363b;}.swal2-popup.swal2-modal.swal2-icon-question.swal2-show {background: #101018;}</style>
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Job Those Are Posted By You  </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Posted Job</li>
        </ol>
    </div>
</div>
<!-- End Page Header -->
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Hey, {{ Auth::user()->name }}</h6>
                                <p class="text-muted card-sub-title">Here is the list of all posted job by you. You can view the details and history of your jobs. You can also delete these job if you want.  </p>
                            </div>
                            <div class="notedown">
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, unde! </li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, unde! </li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, unde! </li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, unde! </li>
                                </ul>
                            </div>
                            <div class="subscribe_btn text-center" id="subscriptionStatus">
                                @if (Auth::user()->balance < 1)
                                <p>You must have to top up some balance in your wallet.</p>
                                @else
                                    @if (Auth::user()->subscription == 1)
                                        <button class="btn btn-sm btn-dark unsubscribe" data-id="{{Auth::user()->id}}"> UnSubscribe </button>
                                        @else
                                        Subscribe Here <button class="btn btn-sm btn-secondary subscribe" data-id="{{Auth::user()->id}}"> Subscribe </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

        </div>
    </div>
</div>
<!-- End Main Content-->

@endsection
@section('js')

<script>
    $(document).ready( function () {
    //Subscribe
    $(document).on('click', '.subscribe', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You are able to use the premium sevices by this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Subscribe',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('subscribe.status') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "fadeIn": 200,
                                    "fadeOut": 3000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000,
                                };
                                if (response.status === true) {
                                    // toastr.success(response.message);
                                    Swal.fire(
                                    'Welcome!',
                                    'You are now eligible to access premium services.!',
                                    'success'
                                    )
                                    $("#subscriptionStatus").load(location.href + " #subscriptionStatus>*", "");
                                }
                                // $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });
    //Unsubscribe
    $(document).on('click', '.unsubscribe', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You are unable to use our premium services by this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Unsubscribe',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('unsubscribe.status') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "fadeIn": 200,
                                    "fadeOut": 3000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000,
                                };
                                if (response.status === true) {
                                    // toastr.success(response.message);
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'You unsubscribe from our premium services!',
                                    showConfirmButton: false,
                                    timer: 2000
                                    })

                                    setTimeout(function(){
                                        $("#subscriptionStatus").load(location.href + " #subscriptionStatus>*", "");
                                    }, 1000);
                                }
                                // $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });
    });
</script>
@endsection
