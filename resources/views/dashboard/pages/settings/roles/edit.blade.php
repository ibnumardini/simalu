@extends('dashboard.pages.settings.layouts.master')

@section('title', __('messages.settings.roles.edit_role'))

@section('content-settings')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.settings.roles.breadcrumb_dashboard') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ __('messages.settings.roles.breadcrumb_roles') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ __('messages.settings.roles.breadcrumb_edit') }}</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            {{ __('messages.settings.roles.role') }}
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
          @if ($errors->has('permissions'))
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-title">{{ __('messages.settings.roles.alert_title') }}</h4>
              <ul>
                @foreach ($errors->get('permissions') as $error)
                  <li>
                    <div class="text-secondary">{{ $error }}</div>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
          <form class="card" action="{{ route('roles.update', ['role' => $role->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="card-header">
              <h3 class="card-title">{{ __('messages.settings.roles.edit_new_role') }}</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required">{{ __('messages.settings.roles.name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  placeholder="{{ __('messages.settings.roles.enter_name') }}" value="{{ old('name') ?? $role->name }}">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <label class="form-label">{{ __('messages.settings.roles.permissions') }}</label>
              <div class="card">
                <div class="card-body">
                  @foreach ($permissions as $page => $scopes)
                    <div class="form-label">{{ $page }}</div>
                    <div>
                      @foreach ($scopes as [$id, $scope, $checked])
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $id }}"
                            {{ $checked ? 'checked' : '' }}>
                          <span class="form-check-label">{{ $scope }}</span>
                        </label>
                      @endforeach
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <a href="{{ route('roles.index') }}" class="btn btn-secondary">{{ __('messages.settings.roles.cancel') }}</a>
              <button type="submit" class="btn btn-primary">{{ __('messages.settings.roles.update') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
