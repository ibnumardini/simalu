@extends('dashboard.pages.settings.layouts.master')

@section('title', __('messages.settings.roles.page_title'))

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
              <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ __('messages.settings.roles.breadcrumb_roles') }}</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            {{ __('messages.settings.roles.page_title') }}
          </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            <a href="{{ route('roles.create') }}" class="btn btn-primary d-none d-sm-inline-block">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
              {{ __('messages.settings.roles.create_new_role') }}
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
              <h3 class="card-title">{{ __('messages.settings.roles.track_great_roles') }}</h3>
            </div>
            <div class="card-body border-bottom py-3">
              <div class="d-flex mb-3">
                <form class="ms-auto" action="{{ route('roles.index') }}" method="get">
                  <div class="text-secondary">
                    {{ __('messages.settings.roles.search') }}:
                    <div class="ms-2 d-inline-block">
                      <input type="text" name="q" class="form-control form-control-sm" aria-label="{{ __('messages.settings.roles.search_role') }}"
                        value="{{ $searchQuery }}" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                      </svg>
                    </button>
                  </div>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-vcenter">
                  <thead>
                    <tr>
                      <th>{{ __('messages.settings.roles.num') }}</th>
                      <th>{{ __('messages.settings.roles.name') }}</th>
                      <th>{{ __('messages.settings.roles.guard_name') }}</th>
                      <th>{{ __('messages.settings.roles.created_at') }}</th>
                      <th style="width: 120px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($roles as $role)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                              {{ __('messages.settings.roles.actions') }}
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('roles.edit', ['role' => $role->id]) }}">
                                {{ __('messages.settings.roles.edit') }}
                              </a>
                              <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item text-danger btn-confirm-delete">
                                  {{ __('messages.settings.roles.delete') }}
                                </button>
                              </form>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="5">{{ __('messages.settings.roles.no_item') }}</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              {{ $roles->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <x-form-delete-confirmation target=".btn-confirm-delete" />
@endpush