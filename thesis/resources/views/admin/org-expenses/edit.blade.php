@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Organizational Expenses Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('org-expenses.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Organizational Expenses</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('alert')
    {!! Form::model($orgexpense,['method'=>'PATCH','action'=>['OrgExpenseController@update',$orgexpense->id],'novalidate' => 'novalidate','files' => 'true']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('Date: ') !!}
                        {!! Form::date('date',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('Upload Receipt: ') !!}<br>
                        {!! Form::file('receipt',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('Select Category: ') !!}
                        {!! Form::select('expense_id',$expenses,null,['class'=>'form-control single-select','placeholder'=>'--Select One--']) !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('OR #: ') !!}
                        {!! Form::text('invoice_or',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('Amount: ') !!}
                        {!! Form::text('amount',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('Description: ') !!}
                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <p>Receipt</p>
                    <img src="<?php echo asset('public/receipts') ?>/{{ $orgexpense->receipt }}" class="" style="width: 100%;">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Changes</button>
        </div>
    </div>
    {!! Form::close() !!}
</main>
@endsection