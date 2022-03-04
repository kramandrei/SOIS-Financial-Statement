@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Change Password Module</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @include('alert')
    <div class="card mt-2">
        {!! Form::open(['method'=>'POST','action'=>['DashboardController@post_changepassword',$user->id]]) !!} 
        <div class="card-body">
            <div class="border p-4 rounded">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        {!! Form::text('username',$user->name,['class'=>'form-control','disabled']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        {!! Form::password('password',['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
        </div>
        {!! Form::close() !!}
    </div>
</main>
@endsection