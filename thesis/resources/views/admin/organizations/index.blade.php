@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Organization Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Organization List</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <!-- <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addNew"><i class="fa fa-plus-circle"></i> Create Entry</button>
        </div>
    </div> -->
    @include('alert')     
    <div class="card mt-2">
        <div class="card-body">
            <div class="border p-4 rounded">
                <table class="table table-striped data-table" style="text-transform: uppercase; font-size:11px;">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Acronym</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> 
</main>
@endsection
@push('modals')
@foreach($data as $d)
<div class="modal fade" id="edit{{ $d->organization_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {!! Form::open(['method'=>'PATCH','action'=>['OrganizationController@update',$d->organization_id]]) !!}
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Update Organization {{ $d->organization_name }}</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="organization_name" class="form-control" id="agent_name" value="{{ $d->organization_name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Acronym</label>
                                <div class="col-sm-9">
                                    <input type="text" name="organization_acronym" class="form-control" id="agent_name" value="{{ $d->organization_acronym }}">
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
@endforeach
<div class="modal fade" id="addNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {!! Form::open(['method'=>'POST','action'=>'OrganizationController@store']) !!}
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Create Organization</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="organization_name" class="form-control" id="agent_name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="agent_name" class="col-sm-3 col-form-label">Acronym</label>
                                <div class="col-sm-9">
                                    <input type="text" name="organization_acronym" class="form-control" id="agent_name">
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
@push('js')
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('organizations.index') }}",
        columns: [
            {data: 'organization_name', name: 'organization_name'},
            {data: 'organization_acronym', name: 'organization_acronym'},
        ]
    });
    
  });
</script>
@endpush