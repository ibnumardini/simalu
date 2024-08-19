@extends('dashboard.pages.settings.layouts.master')

@section('title', 'Change Password')

@section('content-settings')
  <form action="{{ route('profile.password.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-title">I'm so sorry…</h4>
          <ul>
            @foreach ($errors->all() as $error)
              <li>
                <div class="text-secondary">{{ $error }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      <h2 class="mb-4">Change Password</h2>
      <h3 class="card-subtitle">Make sure to always keep a backup of your password in a safe and secure place.</h3>
      <div class="row g-2 mt-2">
        <div class="col-md">
          <div class="form-label required">Current password</div>
          <input type="password" class="form-control" name="current_password" placeholder="Type your current password"
            required>
        </div>
      </div>
      <div class="row g-2 mt-2">
        <div class="col-md">
          <div class="form-label required">New password</div>
          <input type="password" class="form-control" name="password" placeholder="Type new password" required>
        </div>
        <div class="col-md">
          <div class="form-label required">Retype new password</div>
          <input type="password" class="form-control" name="password_confirmation"
            placeholder="Retype the new password, to be sure." required>
        </div>
      </div>
    </div>
    <div class="card-footer bg-transparent mt-auto">
      <div class="btn-list justify-content-end">
        <a href="{{ route('profile.index') }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">
          Save changes
        </button>
      </div>
    </div>
  </form>
@endsection
