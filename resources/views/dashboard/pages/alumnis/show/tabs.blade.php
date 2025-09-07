@extends('dashboard.layouts.master')

@section('title', __('messages.alumnis.page_title'))

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('messages.navbar.dashboard')</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="{{ route('alumnis.index') }}">@lang('messages.alumnis.page_title')</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">@lang('messages.alumnis.detail')</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            @lang('messages.alumnis.page_title')
          </h2>
        </div>
          <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                  <a href="{{ route('alumnis.edit', ['alumni' => $alumni->id]) }}" class="btn btn-edit btn-primary btn-icon" aria-label="Button">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                  </a>
                  <a href="{{ route('alumnis.destroy', ['alumni' => $alumni->id]) }}" class="btn btn-danger btn-icon" data-confirm-delete="true">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" /></svg>
                  </a>
              </div>
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
                    @lang('messages.alumnis.profile_detail')
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
                    @lang('messages.alumnis.work_histories')
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
  @php
    $title = __('messages.delete_confirmation.title');
    $text = __('messages.delete_confirmation.text');
    confirmDelete($title, $text);
  @endphp
@endsection
