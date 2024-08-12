@extends('dashboard.layouts.master')

@section('title', 'Create Role')

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
              <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Create</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            Role
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
              <h4 class="alert-title">I'm so sorry…</h4>
              <ul>
                @foreach ($errors->get('permissions') as $error)
                  <li>
                    <div class="text-secondary">{{ $error }}</div>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
          <form class="card" action="{{ route('roles.store') }}" method="post">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Create new role</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  placeholder="Enter name" value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <label class="form-label">Permissions</label>
              <div class="card">
                <div class="card-body">
                  @foreach ($permissions as $page => $scopes)
                    <div class="form-label">{{ $page }}</div>
                    <div>
                      @foreach ($scopes as [$id, $scope])
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" name="permissions[]"
                            value="{{ $id }}">
                          <span class="form-check-label">{{ $scope }}</span>
                        </label>
                      @endforeach
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
