@extends('dashboard.layouts.master')

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
            Your Personalization
          </div>
          <h2 class="page-title">
            Settings
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
              <h4 class="subheader">Mine 🐱</h4>
              <div class="list-group list-group-transparent">
                <a href="{{ route('profile.index') }}"
                  class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('*settings/profile') ? 'active' : '' }}">
                  My Account
                </a>
              </div>
              <h4 class="subheader mt-4">Management</h4>
              <div class="list-group list-group-transparent">
                <a href="{{ route('roles.index') }}"
                  class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('*settings/roles*') ? 'active' : '' }}">
                  Roles
                </a>
              </div>
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
