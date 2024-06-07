@extends('dashboard.layouts.master')

@section('title', 'Companies')

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
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('companies.index') }}">Companies</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $company->name }}</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <table class="table">
                                <tr>
                                    <td scope="col">Name</td>
                                    <td scope="col">{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <td scope="col">Address</td>
                                    <td scope="col">{{ $company->address }}</td>
                                </tr>
                                <tr>
                                    <td scope="col">Photos</td>
                                    <td scope="col">
                                        <div class="row row-cols-6 g-3">
                                            @forelse ($company->photos as $photo)
                                                <div class="col">
                                                    <a data-fslightbox="gallery" href="{{ asset($photo->path) }}">
                                                        <div class="img-responsive img-responsive-1x1 rounded border"
                                                            style="background-image: url({{ asset($photo->path) }})">
                                                        </div>
                                                    </a>
                                                </div>
                                            @empty
                                                <p class="text-muted">No photos</p>
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
