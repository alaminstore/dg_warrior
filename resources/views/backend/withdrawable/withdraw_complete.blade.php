@extends('backend.home')
@section('title','DG Warrior | Completed Withdraw')
<style>.modal-footer {display: flex;align-items: center!important;justify-content: center!important;padding: 1rem;border-top: 1px solid #e8e8f7;border-bottom-right-radius: 0.3rem;border-bottom-left-radius: 0.3rem;}i.fa.fa-check{font-size: 30px;color: aquamarine;}</style>
@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Withdraw Copleted Lists</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Withdraw Copleted</li>
        </ol>
    </div>

</div>
<!-- End Page Header -->
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body submissionDiv">

                            @if (count($withdrawableList) != 0)
                              @foreach ($withdrawableList as $item)
                                <div class="card bg-light text-white">
                                  <div class="card-body submittingtask">
                                      <span class="namefocus"><span style="color:aquamarine;font-size:25px;">&check;</span> Withdraw completed </span>&nbsp; at <span class="secondaryfocus"> {{ \Carbon\Carbon::parse($item->accept_time)->format('g:ia => jS F, Y') }}</span> &nbsp;  &nbsp;Amount: <span class="bg">${{ $item->withdraw_amount }}</span>
                                      <div class="showDetails">
                                        <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#infos" data-id="{{ $item->id }}">Info</button>
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
                                                    User Name:  &nbsp; {{ $item->getUser->username }} <br>
                                                    Country of Residence:  &nbsp; {{ $item->getUser->country }}  <br>
                                                    Waller Name:  &nbsp; <b style="color: rgb(80, 255, 80)">{{ $item->wallet_name }}</b> <br>
                                                    Wallet Address: <span class="bg">{{ $item->wallet_address }}</span>
                                                </div>

                                            </div>
                                            </div>
                                        </div>
                                        <!-- Modal End -->
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
                                No withdrawable is completed till now.
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
@endsection
