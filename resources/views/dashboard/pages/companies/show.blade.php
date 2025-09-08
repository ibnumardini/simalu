@extends('dashboard.layouts.master')

@section('title', __('messages.companies.page_title'))

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
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('companies.index') }}">{{ __('messages.companies.breadcrumb_companies') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ __('messages.companies.breadcrumb_detail') }}</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $company->name }}</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <table class="table">
                                <tr>
                                    <td scope="col">{{ __('messages.companies.name') }}</td>
                                    <td scope="col">{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <td scope="col">{{ __('messages.companies.address') }}</td>
                                    <td scope="col">{{ $company->address }}</td>
                                </tr>
                                <tr>
                                    <td scope="col">{{ __('messages.companies.photos') }}</td>
                                    <td scope="col">
                                        <div class="row row-cols-6 g-3">
                                            @forelse ($company->photos as $photo)
                                                <div class="col">
                                                    <a data-fslightbox="gallery" href="{{ asset($photo->storage_path) }}">
                                                        <div class="img-responsive img-responsive-1x1 rounded border"
                                                            style="background-image: url({{ asset($photo->storage_path) }})">
                                                        </div>
                                                    </a>
                                                </div>
                                            @empty
                                                <p class="text-muted">{{ __('messages.companies.no_photos') }}</p>
                                            @endforelse
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
