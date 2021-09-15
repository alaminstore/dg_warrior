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
        <h2 class="main-content-title tx-24 mg-b-5">Your Job's Completed List</h2>
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
                            <h6 class="main-content-label mb-1 text-center">My Completed Job(s)</h6> <br>
                        </div>
                        @if (count($completedJob) > 0)
                        @foreach ($completedJob as $item)
                        <div class="card bg-light text-white">
                            <div class="card-body submittingtask">
                                <div class="taskcomplete"><span style="color:aquamarine;font-size:25px;">&check;</span>
                                    </i> <span class="namefocus">{{ $item->getUserName->name }}'s</span> task from <span class="secondaryfocus">{{ $item->getUserName->country }}</span> has been accepted for your job.</div>
                                <div class="showDetails">
                                    <button class="btn btn-sm btn-secondary viewData" data-toggle="modal" data-target="#myModalSave" data-id="{{ $item->job_id }}"><i class="fa fa-briefcase"></i> The job</button>
                                </div>
                            </div>
                        </div><br>
                        @endforeach
                        @else
                          <div class="card bg-light text-white">
                            <div class="card-body text-center display-4" style="font-size: 15px;color:#d49a2d;">
                                No completed task at this moment...
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
