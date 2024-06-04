@extends('dashboard.layouts.master')

@section('title', 'Create Company')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Create</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">
                        Companies
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    @if ($errors->has('photos.*'))
                        @foreach ($errors->all() as $message)
                            <div class="my-3 alert alert-danger">{{ $message }}</div>
                        @endforeach
                    @endif
                    <form class="card" action="{{ route('companies.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Create new school</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Name</label>
                                <div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" aria-describedby="emailHelp" placeholder="Enter name"
                                        value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 mb-0">
                                <label class="form-label required">Address</label>
                                <textarea rows="5" class="form-control @error('address') is-invalid @enderror" name="address"
                                    placeholder="Enter address" required>{{ old('name') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-label required">Photos</div>
                                <input type="file" class="form-control @error('photos') is-invalid @enderror"
                                    name="photos[]" accept="image/gif,image/jpg,image/jpeg,image/png" multiple />
                                @error('photos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
