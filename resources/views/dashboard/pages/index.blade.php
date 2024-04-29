@extends('dashboard.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Welcome
                    </div>
                    <h2 class="page-title">
                        {{ date('j F, Y') }} - {{ $greeting }} 🤗.
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body"></div>
@endsection
