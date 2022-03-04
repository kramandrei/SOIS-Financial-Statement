@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Today's Case Setup Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Today's Case Setup Modules</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('alert') 
    <div class="card mt-2">
        <div class="card-body">
            <div class="border p-4 rounded">
                <table class="table table-striped data-table" style="text-transform: uppercase;font-size: 10px;">
                    <thead>
                        <tr>
                            <th class="text-center">Implant Case</th>
                            <th class="text-center">Agent</th>
                            <th class="text-center">Setup By</th>
                            <th class="text-center">DR By</th>
                            <th class="text-center">Calibrated By</th>
                            <th class="text-center">Final Print</th>
                            <th class="text-center">Autoclaved By</th>
                            <th class="text-center">Delivered By</th>
                            <th class="text-center">Delivery <br> Pullout By</th>
                            <th class="text-center">Pullout By</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
@push('modals')
@push('js')
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.case-now') }}",
        columns: [
            {data: 'case_id', name: 'case_id'},
            {data: 'agent_id', name: 'agent_id'},
            {data: 'setup_by', name: 'setup_by'},
            {data: 'dr_by', name: 'dr_by'},
            {data: 'calibrated_by', name: 'calibrated_by'},
            {data: 'stop_by', name: 'stop_by'},
            {data: 'autoclave_by', name: 'autoclave_by'},
            {data: 'delivered_by', name: 'delivered_by'},
            {data: 'deliver_pullout_by', name: 'deliver_pullout_by'},
            {data: 'pullout_by', name: 'pullout_by'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endpush