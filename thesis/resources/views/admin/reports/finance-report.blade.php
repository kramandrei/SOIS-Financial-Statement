@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Reports Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Financial Report</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('alert')
    {!! Form::open(['method'=>'POST','action'=>'ReportController@print_finance_report']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('Date From: ') !!}
                        {!! Form::date('date_from',\Carbon\Carbon::now()->toDateString(),['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('Date To: ') !!}
                        {!! Form::date('date_to',\Carbon\Carbon::now()->toDateString(),['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </div>
    </div>
    {!! Form::close() !!}
</main>
@endsection