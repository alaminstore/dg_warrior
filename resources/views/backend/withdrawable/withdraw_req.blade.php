@extends('backend.home')
@section('title','DG Warrior | Withdrawable Request')
<style>.modal-footer {display: flex;align-items: center!important;justify-content: center!important;padding: 1rem;border-top: 1px solid #e8e8f7;border-bottom-right-radius: 0.3rem;border-bottom-left-radius: 0.3rem;}</style>
@section('content')
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Withdrawable Pending Requests</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Withdrawable Request</li>
        </ol>
    </div>

</div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body submissionDiv">

                            @if (count($withdrawableList) != 0)
                              @foreach ($withdrawableList as $item)
                                <div class="card bg-light text-white">
                                  <div class="card-body submittingtask">
                                      <span class="namefocus">{{ $item->getUser->username }}</span>&nbsp; from <span class="secondaryfocus">{{ $item->getUser->country }} at {{ \Carbon\Carbon::parse($item->request_time)->format('g:ia => jS F, Y') }}</span> &nbsp;  wants to withdraw &nbsp;<span class="bg">${{ $item->withdraw_amount }}</span>
                                      <div class="showDetails">
                                        <button type="button" class="btn btn-sm btn-success withdrawView"  data-toggle="modal" data-target="#infos" data-id="{{ $item->id }}">Info</button>
                                        @if(Auth::user()->role_id == 1)
                                        <button type="button" class="proofOfTask btn btn-sm btn-primary acceptWithdrawRequest" data-id="{{ $item->id }}">Accept</button>
                                        @else
                                         @if (Auth::user()->role_id == 2 && $jobPower == true)
                                          <button type="button" class="proofOfTask btn btn-sm btn-primary acceptWithdrawRequest" data-id="{{ $item->id }}">Accept</button>
                                         @endif
                                        @endif
                                      </div>
                                  </div>

                                </div><br>
                              @endforeach
                              <div class="paginationDiv">
                                {{ $withdrawableList->links() }}
                              </div>

                            @else
                            <div class="card bg-light text-white">
                              <div class="card-body text-center display-4" style="font-size: 15px;color:#d49a2d;">
                                No withdrawable request is available right now.
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
<div class="modal fade" id="infos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wallet Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span style="font-weight: 300;">&times;</span></span>
        </button>
        </div>
        <div class="modal-body">
            Waller Name:  &nbsp; <b style="color: rgb(80, 255, 80)" id="walletName"></b> <br>
            Wallet Address: <span class="bg" id="walletAddress"></span>
        </div>

    </div>
    </div>
</div>
<!-- Modal End -->
@endsection
@section('js')
<script>

    $(document).ready( function () {
    //View Withdraw Address
    $(document).on('click', '.withdrawView', function () {
        let id = $(this).attr('data-id');
        // console.log(id);
        $.ajax({
            url: "{{url('withdrawaddressdetails')}}/" + id + '/edit',
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                let url = window.location.origin;
                // console.log('data', response);
                $('#walletName').html('');
                $('#walletAddress').html('');
                $('#walletName').html(response.data.wallet_name);
                $('#walletAddress').html(response.data.wallet_address);
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });
    $(document).on('click', '.acceptWithdrawRequest', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Approve Request ?',
                text: "You are going to accept the withdrawable request!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Accept',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('withdrawable.req') !!}",
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
                                    title: 'You approved the widrawable payment!',
                                    showConfirmButton: false,
                                    timer: 2000
                                    })
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2500);
                                }
                            }
                        });
                    }
                }
            )
        });
    });
</script>
@endsection
