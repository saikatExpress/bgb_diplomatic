@extends('super.app')
@section('title', 'Add Batttalion')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Add Battalion</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb
                d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{ route('super_admin.battalions') }}">Battalion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Battalion</li>
            </ol>
            <div class="d-flex align-items-center">
                <a href="{{ route('super_admin.battalions') }}" class="btn btn-primary btn-sm">All Battalion</a>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('super_admin.battalions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('super.partials.battalions.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection