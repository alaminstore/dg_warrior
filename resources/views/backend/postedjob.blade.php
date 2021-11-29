@extends('backend.home')
@section('title','DG Warrior | Joblist')
@section('style')
{{-- datatable --}}
<link href="{{ asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection
<style>.swal2-icon.swal2-warning {font-size: 15px!important;}.media-body:hover {background: #141313;}</style>
@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">

<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">My Posted Job</h2>
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
                                <p class="text-muted card-sub-title">You may view your posted task details , history  or delete your posted task(s).</p>
                            </div>
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped table-bordered text-nowrap" >
                                    <thead>
                                        <tr class="text-center">
                                            <th width="10%">PARTICIPANTS</th>
                                            <th width="10%">Job Title</th>
                                            <th width="10%">JOB TYPES</th>
                                            @if (Auth::user()->role_id == null)
                                            <th width="10%">Job Rewards</th>
                                            @endif
                                            <th width="10%">Job Visibility</th>
                                            {{-- <th width="15%">Job Description</th> --}}
                                            <th width="15%">Status</th>
                                            <th width="15%">Date</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadnow">
                                      @foreach ($postedJob as $list)
                                        <tr class="text-center item{{ $list->id }}">
                                            <td>{{$list->already_applied == null ? "0" : $list->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $list->job_worker + $list->already_applied }}</td>
                                            <td>{!! \Illuminate\Support\Str::limit($list->job_title, 25, $end='...') !!}</td>
                                            {{-- <td>{{ $jobType }}</td> --}}
                                            <td>
                                                {{ $list->issue_type == 1 ? "Objective Task" : "" }}
                                                {{ $list->issue_type == 2 ? "Survey" : "" }}
                                                {{ $list->issue_type == 3 ? "Polls" : "" }}
                                                {{ $list->issue_type == 4 ? "Quiz" : "" }}
                                            </td>
                                            @if (Auth::user()->role_id == null)
                                            <td>${{ $list->job_price }}</td>
                                            @endif
                                            <td>
                                                {{ $list->job_visibility == 1 ? "All Public" : "" }}
                                                {{ $list->job_visibility == 2 ? "Only My Team" : "" }}
                                                {{ $list->job_visibility == 3 ? "Subscribed Users Only" : "" }}
                                                {{ $list->job_visibility == 4 ? "DG Manager Task Only" : "" }}
                                            </td>
                                            {{-- <td>{!! \Illuminate\Support\Str::limit($list->job_description, 30, $end='...') !!}</td> --}}
                                            <td>{{$list->job_worker == 0 ? "Fill Up" : "In Progress"}}</td>
                                            <td>{{\Carbon\Carbon::parse($list->created_at)->format('jS F, Y')}}</td>
                                            <td>
                                                <button type="button"
                                                        data-toggle="modal" class="btn ripple btn-info viewData" data-target="#myModalSave" data-id="{{$list->id}}">
                                                        <i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="view"></i>
                                                </button>
                                                <a class="deletetag" data-id="{{$list->id}}">
                                                    <button class="btn ripple btn-danger category-delete"
                                                            title="Delete">
                                                        <i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="delete"></i>
                                                    </button>
                                                </a>
                                            </td>
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
@endsection
@section('js')
<script src="{{asset('backend/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/jszip.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/table-data.js') }}"></script>
<script>
    $(document).ready( function () {
    //Delete data
    $(document).on('click', '.deletetag', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('task.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                // console.log('tt',response);
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
                                    toastr.success('Task has been rejected sucessfully');
                                    $('#example2').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
                                    $("#postedJobRefresh").load(location.href + " #postedJobRefresh>*", "");
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
