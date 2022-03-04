@extends('layouts.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Welcome {{ Auth::user()->fullname }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="mb-3"></div>
    <!--end breadcrumb-->
    
</main>    
@endsection
