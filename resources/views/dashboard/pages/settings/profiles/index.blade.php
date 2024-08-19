@extends('dashboard.pages.settings.layouts.master')

@section('title', 'My Account')

@section('content-settings')
  <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <h2 class="mb-4">My Account</h2>
      <h3 class="card-title">Profile Details</h3>
      <div class="row align-items-center">
        <div class="col-auto">
          <span class="avatar avatar-xl" style="background-image: url('{{ asset($user->storage_avatar) }}')"></span>
        </div>
        <div class="col-auto">
          <a href="#" class="btn btn-file">
            Change avatar <input type="file" name="avatar" accept="image/jpg,image/jpeg,image/png">
          </a>
        </div>
        <div class="col-auto">
          <span class="text-muted" id="avatar-selected-name">No avatar selected</span>
        </div>
      </div>
      <div class="row g-3 mt-2">
        <div class="col-md">
          <div class="form-label">First name</div>
          <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
        </div>
        <div class="col-md">
          <div class="form-label">Last name</div>
          <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
        </div>
      </div>
      <h3 class="card-title mt-4">Email</h3>
      <p class="card-subtitle">Email is unique, it determines your identity</p>
      <div>
        <div class="row g-2">
          <div class="col-md">
            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
          </div>
        </div>
      </div>
      <h3 class="card-title mt-4">Password</h3>
      <p class="card-subtitle">Please always backup password in a safe place</p>
      <div>
        <a href="#" class="btn">Set new password</a>
      </div>
      <h3 class="card-title mt-4">Joined</h3>
      <p class="card-subtitle">{{ $user->created_at->diffForHumans() }}, on {{ $user->created_at }}</p>
    </div>
    <div class="card-footer bg-transparent mt-auto">
      <div class="btn-list justify-content-end">
        <button type="submit" class="btn btn-primary">
          Save changes
        </button>
      </div>
    </div>
  </form>
@endsection

@push('css')
  <style>
    .btn-file {
      position: relative;
      overflow: hidden;
    }

    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;
      cursor: inherit;
      display: block;
    }
  </style>
@endpush

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const input = document.querySelector('input[name=avatar]');
      const display = document.querySelector('#avatar-selected-name');

      input.addEventListener('change', function() {
        display.innerText = this.files[0].name;
      });
    });
  </script>
@endpush
