@extends('dashboard.pages.settings.layouts.master')

@section('title', __('messages.settings.profile.my_account'))

@section('content-settings')
  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
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
      <h2 class="mb-4">{{ __('messages.settings.profile.my_account') }}</h2>
      <h3 class="card-title">{{ __('messages.settings.profile.profile_details') }}</h3>
      <div class="row align-items-center">
        <div class="col-auto">
          <span class="avatar avatar-xl" style="background-image: url('{{ asset($user->storage_avatar) }}')"></span>
        </div>
        <div class="col-auto">
          <a href="#" class="btn btn-file">
            {{ __('messages.settings.profile.change_avatar') }} <input type="file" name="avatar" accept="image/jpg,image/jpeg,image/png">
          </a>
        </div>
        <div class="col-auto">
          <span class="text-muted" id="avatar-selected-name">{{ __('messages.settings.profile.no_avatar_selected') }}</span>
        </div>
      </div>
      <div class="row g-3 mt-2">
        <div class="col-md">
          <div class="form-label">{{ __('messages.settings.profile.first_name') }}</div>
          <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
        </div>
        <div class="col-md">
          <div class="form-label">{{ __('messages.settings.profile.last_name') }}</div>
          <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
        </div>
      </div>
      <h3 class="card-title mt-4">{{ __('messages.settings.profile.email') }}</h3>
      <p class="card-subtitle">{{ __('messages.settings.profile.email_subtitle') }}</p>
      <div>
        <div class="row g-2">
          <div class="col-md">
            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
          </div>
        </div>
      </div>
      <h3 class="card-title mt-4">{{ __('messages.settings.profile.password') }}</h3>
      <p class="card-subtitle">{{ __('messages.settings.profile.password_subtitle') }}</p>
      <div>
        <a href="{{ route('profile.password.index') }}" class="btn">{{ __('messages.settings.profile.set_new_password') }}</a>
      </div>
      <h3 class="card-title mt-4">{{ __('messages.settings.profile.joined') }}</h3>
      <p class="card-subtitle">{{ $user->created_at->diffForHumans() }}, on {{ $user->created_at }}</p>
    </div>
    <div class="card-footer bg-transparent mt-auto">
      <div class="btn-list justify-content-end">
        <button type="submit" class="btn btn-primary">
          {{ __('messages.settings.profile.save_changes') }}
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
