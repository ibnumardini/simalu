@extends('dashboard.pages.settings.layouts.master')

@section('title', 'My Account')

@section('content-settings')
  <div class="card-body">
    <h2 class="mb-4">My Account</h2>
    <h3 class="card-title">Profile Details</h3>
    <div class="row align-items-center">
      <div class="col-auto"><span class="avatar avatar-xl"
          style="background-image: url('{{ asset('/img/avatar.png') }}')"></span>
      </div>
      <div class="col-auto"><a href="#" class="btn">
          Change avatar
        </a></div>
      <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
          Delete avatar
        </a></div>
    </div>
    <div class="row g-3 mt-2">
      <div class="col-md">
        <div class="form-label">First name</div>
        <input type="text" class="form-control" value="{{ $user->first_name }}">
      </div>
      <div class="col-md">
        <div class="form-label">Last name</div>
        <input type="text" class="form-control" value="{{ $user->last_name }}">
      </div>
    </div>
    <h3 class="card-title mt-4">Email</h3>
    <p class="card-subtitle">Email is unique, it determines your identity.</p>
    <div>
      <div class="row g-2">
        <div class="col-md">
          <input type="text" class="form-control" value="{{ $user->email }}" disabled>
        </div>
      </div>
    </div>
    <h3 class="card-title mt-4">Password</h3>
    <p class="card-subtitle">Please always backup password in a safe place.</p>
    <div>
      <a href="#" class="btn">
        Set new password
      </a>
    </div>
    <h3 class="card-title mt-4">Joined</h3>
    <p class="card-subtitle">{{ $user->created_at->diffForHumans() }}, on {{ $user->created_at }}</p>
  </div>
  <div class="card-footer bg-transparent mt-auto">
    <div class="btn-list justify-content-end">
      <a href="#" class="btn btn-primary">
        Save changes
      </a>
    </div>
  </div>
@endsection
