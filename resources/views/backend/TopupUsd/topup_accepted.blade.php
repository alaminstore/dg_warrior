@extends('backend.home')
@section('title','DG Warrior | Withdrawable Request')
<style>.modal-footer {display: flex;align-items: center!important;justify-content: center!important;padding: 1rem;border-top: 1px solid #e8e8f7;border-bottom-right-radius: 0.3rem;border-bottom-left-radius: 0.3rem;}</style>
@section('style')
{{-- datatable --}}
<link href="{{ asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">USDT Recharge Accepted List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Accepted Top Up</li>
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
                                <p class="text-muted card-sub-title">Here is the all topup list those are accepted by you. Only through USdt-Scanning process.</p>
                            </div>
                            <div class="table-responsive">
                                <table id="example1" class="table table-striped table-bordered text-nowrap" >
                                    <thead>
                                        <tr class="text-center">
                                            <th width="10%">The User</th>
                                            <th width="35%">TrxID</th>
                                            <th width="10%">Payment Method</th>
                                            <th width="10%">Requested Balance</th>
                                            <th width="15%">Accepted Time</th>
                                            <th width="10%">Screenshot</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadnow">
                                      @foreach ($trxid as $list)
                                        <tr class="text-center item{{ $list->id }}">
                                            <td>{{ $list->getUser->username }}</td>
                                            <td>{{ $list->trxid }}</td>
                                            <td style="color: gold">{{ $list->payment_method }}</td>
                                            <td><span style="color:gold;font-weight:700">$ </span>{{ $list->balance }}</td>
                                            <td>{{ \Carbon\Carbon::parse($list->accept_time)->format('jS F, Y') }}</td>
                                            <td>
                                                <button class="btn viewScreenshot" data-toggle="modal" data-target="#screenshotProof" data-id="{{$list->id}}">
                                                <img src="{{ $list->image }}" alt="screenshot" height="50" width="50" style="border:2px solid rgb(122, 113, 113);">
                                                </button>
                                            </td>
                                            <td><span style="color:aquamarine;font-size:25px;">&check;</span> Completed</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Screenshot Details -->
<div class="modal fade" id="screenshotProof" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Payment Screenshot</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-weight: 300">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="screenShotImage" class="text-center"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{asset('backend/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/table-data.js') }}"></script>
@endsection
