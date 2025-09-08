@extends('dashboard.pages.settings.layouts.master')

@section('title', __('messages.settings.profile.change_password'))

@section('content-settings')
  <form action="{{ route('profile.password.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-title">{{ __('messages.settings.profile.alert_title') }}</h4>
          <ul>
            @foreach ($errors->all() as $error)
              <li>
                <div class="text-secondary">{{ $error }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      <h2 class="mb-4">{{ __('messages.settings.profile.change_password') }}</h2>
      <h3 class="card-subtitle">{{ __('messages.settings.profile.password_backup_note') }}</h3>
      <div class="row g-2 mt-2">
        <div class="col-md">
          <div class="form-label required">{{ __('messages.settings.profile.current_password') }}</div>
          <input type="password" class="form-control" name="current_password"
            placeholder="{{ __('messages.settings.profile.current_password_placeholder') }}" required>
        </div>
      </div>
      <div class="row g-2 mt-2">
        <div class="col-md">
          <div class="form-label required">{{ __('messages.settings.profile.new_password') }}</div>
          <input type="password" class="form-control" name="password" placeholder="{{ __('messages.settings.profile.new_password_placeholder') }}" required>
        </div>
        <div class="col-md">
          <div class="form-label required">{{ __('messages.settings.profile.retype_new_password') }}</div>
          <input type="password" class="form-control" name="password_confirmation"
            placeholder="{{ __('messages.settings.profile.confirm_password_placeholder') }}" required>
        </div>
      </div>
    </div>
    <div class="card-footer bg-transparent mt-auto">
      <div class="btn-list justify-content-end">
        <a href="{{ route('profile.index') }}" class="btn btn-secondary">{{ __('messages.settings.profile.cancel') }}</a>
        <button type="submit" class="btn btn-primary">
          {{ __('messages.settings.profile.save_changes') }}
        </button>
      </div>
    </div>
  </form>
@endsection
