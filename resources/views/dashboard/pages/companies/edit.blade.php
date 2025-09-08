@extends('dashboard.layouts.master')

@section('title', __('messages.companies.edit_company'))

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.companies.breadcrumb_dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">{{ __('messages.companies.breadcrumb_companies') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ __('messages.companies.breadcrumb_edit') }}</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">
                        {{ __('messages.companies.company') }}
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
                            <div class="alert alert-danger">{{ $message }}</div>
                        @endforeach
                    @endif
                    <form class="card" action="{{ route('companies.update', ['company' => $company->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title">{{ __('messages.companies.edit_company_name', ['name' => $company->name]) }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">{{ __('messages.companies.name') }}</label>
                                <div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" aria-describedby="emailHelp" placeholder="{{ __('messages.companies.enter_name') }}"
                                        value="{{ old('name') ?? $company->name }}" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 mb-0">
                                <label class="form-label required">{{ __('messages.companies.address') }}</label>
                                <textarea rows="5" class="form-control @error('address') is-invalid @enderror" name="address"
                                    placeholder="{{ __('messages.companies.enter_address') }}">{{ old('address') ?? $company->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-label">{{ __('messages.companies.photos') }}</div>
                                <input type="file" class="form-control @error('photos') is-invalid @enderror"
                                    name="photos[]" accept="image/gif,image/jpg,image/jpeg,image/png" multiple />
                                <div id="photosHelp" class="form-text">{{ __('messages.companies.photos_help') }}</div>
                                @error('photos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('companies.index') }}" class="btn btn-secondary">{{ __('messages.companies.cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('messages.companies.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
