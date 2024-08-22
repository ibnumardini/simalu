@extends('dashboard.layouts.master')

@section('title', 'Alumni')

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
              <li class="breadcrumb-item" aria-current="page"><a href="{{ route('alumnis.index') }}">Alumnis</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            Alumni
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
              <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="{{ route('alumnis.show', ['alumni' => $alumni->id]) }}"
                    class="nav-link {{ request()->routeIs('alumnis.show', ['alumni' => $alumni->id]) ? 'active' : '' }}"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="icon me-2">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                    Profile detail
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a href="{{ route('alumnis.work-histories.show', ['alumni' => $alumni->id]) }}"
                    class="nav-link {{ request()->is('*alumnis/*/work-histories*') ? 'active' : '' }}"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="icon icon-tabler icons-tabler-outline icon-tabler-history me-2">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M12 8l0 4l2 2" />
                      <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
                    </svg>
                    Work histories
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                @yield('alumni-show-contents')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
