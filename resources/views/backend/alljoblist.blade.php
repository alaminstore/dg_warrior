@extends('backend.home')
@section('title','DG Warrior | Joblist')
@section('style')
{{-- datatable --}}
<link href="{{ asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
<style>.swal2-icon.swal2-warning {font-size: 15px!important;}.media-body:hover {background: #141313;} td.costEdit{display: flex;flex-wrap: wrap;justify-content: center;align-items: baseline;padding-bottom: 0!important;}.dark-theme .note-btn-group .btn {color: #fbfbfb!important;background: #252542;}.panel-default>.panel-heading {border: 1px solid #8e8e8e;}</style>
@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Existing Job List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">Existing Jobs</li>
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
                                <h6 class="main-content-label mb-1">Existing Task List</h6>
                                <p class="text-muted card-sub-title">Delete the existing tasks which you want. Just you have to click delete icon-button and that's all  </p>
                            </div>
                            <div class="table-responsive">
                                <table id="example1" class="table table-striped table-bordered text-nowrap" >
                                    <thead>
                                        <tr class="text-center">
                                            <th width="15%">Job Title</th>
                                            <th width="10%">Job Type</th>
                                            <th width="10%">Rewards</th>
                                            <th width="10%">Job Visibility</th>
                                            <th width="10%">Participants</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="BalanceRechange">
                                        @foreach ($joblists as $list)
                                        @php
                                            $jobType = $list->job_type == 1 ? "High Reward":"Normal";
                                        @endphp
                                        <tr class="text-center item{{ $list->id }}">
                                            <td>{!! \Illuminate\Support\Str::limit($list->job_title, 30, $end='...') !!}</td>
                                            <td>{{ $jobType }}</td>
                                            <td class="costEdit">
                                              ${{ $list->job_price == 0 ?"Top Up Percentage" : $list->job_price}}

                                                {{-- @if(Auth::user()->role_id==1)
                                                    <button type="button"
                                                        class="btn btn-sm balance-edit"
                                                        data-toggle="modal" data-target="#changeBalance"
                                                        data-id="{{$list->id}}" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @else
                                                    @if (Auth::user()->role_id == 2 && $jobPricePermit == true)
                                                        <button type="button"
                                                            class="btn btn-sm balance-edit"
                                                            data-toggle="modal" data-target="#changeBalance"
                                                            data-id="{{$list->id}}" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    @endif
                                                @endif --}}
                                            </td>
                                            <td>
                                                {{ $list->job_visibility == 1 ? "For Public":"" }}
                                                {{ $list->job_visibility == 2 ? "Only My Team":"" }}
                                                {{ $list->job_visibility == 3 ? "For Executive Users":"" }}
                                                {{ $list->job_visibility == 4 ? "DG Manager task only":"" }}
                                            </td>
                                            <td>{{$list->already_applied == null ? "0" : $list->already_applied}} <span style="font-size: 20px;color:rgb(119, 255, 119)"><b>/</b></span> {{ $list->job_worker + $list->already_applied }}</td>
                                            <td>
                                                <button type="button"
                                                        data-toggle="modal" class="btn ripple btn-info viewData" data-target="#myModalSave" data-id="{{$list->id}}">
                                                        <i class="fa fa-eye"></i>
                                                </button>
                                                @if (Auth::user()->role_id == 1)
                                                <a class="deletetag" data-id="{{$list->id}}">
                                                    <button class="btn ripple btn-danger category-delete"
                                                            title="Delete">
                                                        <i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="delete"></i>
                                                    </button>
                                                </a>
                                                @endif
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
            <!-- End Row -->

        </div>
    </div>
</div>
<!-- End Main Content-->
<!-- Modal -->
<div class="modal fade" id="changeBalance" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">You can modify The Job's requirements</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span style="font-weight:300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
            {!!Form::open(['class' => 'form-horizontal','id'=>'balanceChanging'])!!}
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Job Title</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text"  id="job_title" name="job_title"
                                            placeholder="Job title">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">$_Balance</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" min="1" step="any" id="job_price" name="job_price"
                                            placeholder="Job price for each Worker's...">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Workers</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="job_worker" name="job_worker">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Content</label>
                <div class="col-sm-10">
                    <textarea name="job_description" class="form-control" id="job_description" cols="30" rows="10"></textarea>
                </div>
            </div>
            <input class="form-control" type="hidden" id="job_id" name="job_id">
            <input class="form-control" type="hidden" id="old_price" name="old_price">

            <div class="form-group m-b-0">
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i> Change Here...
                    </button>
                </div>
            </div>
            {!!Form::close()!!}
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
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/table-data.js') }}"></script>
<script src="{{asset('backend/assets/plugins/summernote/summernote-bs4.js')}}"></script>
<script>
    $(document).ready( function () {
      var trap = false;
      $('#job_description').summernote({
        placeholder: 'Details here...',
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

    $("#balanceChanging").validate({
        rules: {
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
            job_description: {
                required:true,
            },
        }
    });
    //Delete data
    $(document).on('click', '.deletetag', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
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
                                    toastr.success('Task has been Deleted sucessfully');

                                    $('#example1').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
                                }
                            }

                        });
                    }
                }
            )
        });

    //edit data
    $(document).on('click', '.balance-edit', function () {
        let id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('balancedetails')}}/" + id + '/edit',
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                let url = window.location.origin;
                console.log('data', response.data);
                $('#job_title').val(response.data.job_title);
                $('#job_price').val(response.data.job_price);
                $('#job_id').val(response.data.id);
                $('#old_price').val(response.data.job_price);
                $('#job_worker').val(response.data.job_worker);
                // $('#job_description').val(response.data.job_description);
                $("#job_description").summernote("code", response.data.job_description);
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });

    //Update data
    $('#balanceChanging').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        if(! $form.valid()) return false;
        $.ajax({
            url: "{{route('balance.change')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('update', data);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                };

                if(data.status == 0){
                    $.each(data.error,function(key,value){
                        toastr.error(value);
                    })
                }else{
                    if(data.status == true){
                        $('#changeBalance').modal('hide');
                        toastr.success(data.message);
                        $('#balanceChanging').trigger('reset');
                        setTimeout(function () {
                            $("#BalanceRechange").load(location.href + " #BalanceRechange>*", "");
                        }, 1500);
                    }
                }
            }
        });
      });
    });
</script>
@endsection
