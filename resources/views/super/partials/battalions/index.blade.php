@extends('super.app')
@section('title', 'All Battalions')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Battalions</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{ route('super_admin.battalions') }}">Battalion</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Battalions</li>
            </ol>
            <div class="d-flex align-items-center">
                <a href="{{ route('super_admin.battalions.create') }}" class="btn btn-primary btn-sm">Add Battalion</a>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('super.partials.battalions.table')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('super.partials.battalions.delete')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('super.partials.battalions.edit')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('super.partials.battalions.show')
                </div>
            </div>
        </div>
    </div>
@endsection