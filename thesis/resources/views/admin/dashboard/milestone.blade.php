@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Agent Task Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agent Task Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('alert')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".addNew"><i class="fa fa-plus-circle"></i> Add Status</button>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="alert alert-success border-0 bg-success alert-dismissible fade show" style="text-transform:uppercase;">
                                <h5 class="text-white">Details</h5>
                                <hr>    
                                <ul style="color: white;">
                                    <li>Customer: <span style="font-weight: bold; margin-left: 5px;"> {{ $task->customer->name }}</span></li>
                                    <li>Task Created Date: <span style="font-weight: bold; margin-left: 5px;">{{ \Carbon\Carbon::parse($task->date)->toFormattedDateString() }}</span></li>
                                    <li>Task What: <span style="font-weight: bold; margin-left: 5px;"> {{ $task->task_what }}</span></li>
                                    <li>Task Where: <span style="font-weight: bold; margin-left: 5px;"> {{ $task->task_where }}</span></li>
                                    <li>Task When: <span style="font-weight: bold; margin-left: 5px;"> {{ \Carbon\Carbon::parse($task->task_when)->toFormattedDateString() }}</span></li>
                                    <li>Task Time: <span style="font-weight: bold; margin-left: 5px;"> {{ \Carbon\Carbon::parse($task->task_time)->toTimeString() }}</span></li>
                                    <li>Remarks: <span style="font-weight: bold; margin-left: 5px;"> {{ $task->remarks }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="alert alert-primary border-0 alert-dismissible fade show" style="text-transform:uppercase;">
                                <h5 class="">Attached Docs</h5>
                                <hr>    
                                <table class="table table-bordered data-table" style="text-transform: uppercase; font-size:11px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Filename</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($task->uploads as $row)
                                        <tr>
                                            <td>{{ $row->filename }}</td>
                                            <td class="text-center">
                                                <a href="{{ action('DashboardController@downloadFile',$row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="page-title">Status Report</h5>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Agent/User</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Task Report</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center" width="50">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($task->milestones as $tm)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($tm->date)->toFormattedDateString() }}</td>
                                        <td>{{ ($tm->user_id != NULL) ? $tm->user->name :$task->agent->code }}</td>    
                                        <td>{{ $tm->status->name }}</td>  
                                        <td>{{ $tm->task_report }}</td> 
                                        <td>{{ $tm->remarks }}</td> 
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-wrench"></i></button>
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a data-bs-target="#edit{{ $tm->id }}" data-bs-toggle="modal" class="dropdown-item"> Edit Entry</a></li>
                                                    <li><a data-bs-target="#download{{ $tm->id }}" data-bs-toggle="modal" class="dropdown-item"> Download Docs</a></li>
                                                </ul>
                                            </div>
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
</main>
@endsection
@push('modals')
@foreach($task->milestones as $tm)
<div class="modal fade" id="download{{ $tm->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Download Docs</h5>
                            </div>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Filename</th>
                                        <th class="text-center" width="50">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tm->uploads as $tmu)
                                    <tr>
                                        <td>{{ $tmu->filename }}</td>
                                        <td class="text-center">
                                            <a href="{{ action('DashboardController@downloadDocs',$tmu->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit{{ $tm->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {!! Form::open(['method'=>'PATCH','action'=>['DashboardController@update_milestone',$tm->id],'novalidate' => 'novalidate','files' => 'true']) !!}
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Edit Status</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    {!! Form::date('date',$tm->date,['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Select Status</label>
                                <div class="col-sm-9">
                                    {!! Form::select('status_id',$status,$tm->status_id,['class'=>'form-control','placeholder'=>'-- Select One --']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Task Report</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('task_report',$tm->task_report,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Remarks</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('remarks',$tm->remarks,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Attach Docs</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="uploads[]" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endforeach
<div class="modal fade addNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {!! Form::open(['method'=>'POST','action'=>['DashboardController@store_milestone',$task->id],'novalidate' => 'novalidate','files' => 'true']) !!}
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Add Status</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    {!! Form::date('date',\Carbon\Carbon::now()->toDateString(),['class'=>'form-control','readonly']) !!}
                                    {!! Form::hidden('agent_task_id',$task->id,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Select Status</label>
                                <div class="col-sm-9">
                                    {!! Form::select('status_id',$status,null,['class'=>'form-control','placeholder'=>'-- Select One --']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Task Report</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('task_report',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Remarks</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('remarks',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Attach Docs</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="uploads[]" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endpush