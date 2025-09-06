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
                        @lang('messages.dashboard.pretitle', ['name' => auth()->user()->first_name])
                    </div>
                    <h2 class="page-title">
                        {{ date('j F, Y') }} - @lang('messages.dashboard.title', ['greeting' => $greeting]) 🤗
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body"></div>
@endsection
