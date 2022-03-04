@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">User Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create User</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('alert')
    {!! Form::open(['method'=>'POST','action'=>'UserController@store']) !!}
    <div class="card">
        <div class="card-body">
            <div class="border p-4 rounded">
                <div class="row mb-3">
                    <label for="agent_name" class="col-sm-3 col-form-label">Select Organization</label>
                    <div class="col-sm-9">
                        {!! Form::select('organization_id',$orgs,null,['class'=>'form-control single-select','placeholder'=>'--Select One--']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agent_name" class="col-sm-3 col-form-label">Full Name</label>
                    <div class="col-sm-9">
                        {!! Form::text('fullname',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agent_name" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agent_name" class="col-sm-3 col-form-label">Email Address</label>
                    <div class="col-sm-9">
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agent_name" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        {!! Form::password('password',['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agent_name" class="col-sm-3 col-form-label">Select Role</label>
                    <div class="col-sm-9">
                        {!! Form::select('role_id',$roles,null,['class'=>'form-control single-select','placeholder'=>'--Select One--']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </div>
    {!! Form::close() !!}
</main>
@endsection