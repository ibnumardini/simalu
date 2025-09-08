@extends('dashboard.layouts.master')

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
            {{ __('messages.settings.your_personalization') }}
          </div>
          <h2 class="page-title">
            {{ __('messages.settings.settings') }}
          </h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="card">
        <div class="row g-0">
          <div class="col-12 col-md-3 border-end">
            <div class="card-body">
              <h4 class="subheader">{{ __('messages.settings.mine') }}</h4>
              <div class="list-group list-group-transparent">
                <a href="{{ route('profile.index') }}"
                  class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('*settings/profile*') ? 'active' : '' }}">
                  {{ __('messages.settings.my_account') }}
                </a>
              </div>
              <h4 class="subheader mt-4">{{ __('messages.settings.management') }}</h4>
              @can(config('access.roles/read'))
                <div class="list-group list-group-transparent">
                  <a href="{{ route('roles.index') }}"
                    class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('*settings/roles*') ? 'active' : '' }}">
                    {{ __('messages.settings.roles') }}
                  </a>
                </div>
              @endcan
            </div>
          </div>
          <div class="col-12 col-md-9 d-flex flex-column">
            @yield('content-settings')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
