@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Organizational Income Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Organizational Income List</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('org-incomes.create') }}" class="btn btn-primary mb-2" ><i class="fa fa-plus-circle"></i> Create Entry</a>
        </div>
    </div>
    @include('alert')     
    <div class="card mt-2">
        <div class="card-body">
            <div class="border p-4 rounded">
                <table class="table table-striped data-table" style="text-transform: uppercase; font-size:11px;">
                    <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Organization</th>
                            <th class="text-center">Income Category</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Created By</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="180">Action</th>
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
<div class="modal fade" id="approve{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve this entry?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ action('OrgIncomeController@approved',$d->id) }}" class="btn btn-primary">Approve Entry</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this entry?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ action('OrgIncomeController@delete',$d->id) }}" class="btn btn-primary">Delete Entry</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endpush
@push('js')
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('org-incomes.index') }}",
        columns: [
            {data: 'date', name: 'date'},
            {data: 'org_id', name: 'org_id'},
            {data: 'income_id', name: 'income_id'},
            {data: 'amount', name: 'amount'},
            {data: 'createdBy', name: 'createdBy'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endpush