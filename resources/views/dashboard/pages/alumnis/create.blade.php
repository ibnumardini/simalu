@extends('dashboard.layouts.master')

@section('title', __('messages.alumnis.create_alumni'))

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('messages.navbar.dashboard')</a></li>
              <li class="breadcrumb-item"><a href="{{ route('alumnis.index') }}">@lang('messages.alumnis.page_title')</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">@lang('messages.alumnis.create')</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            @lang('messages.alumnis.page_title')
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
          <form class="card" action="{{ route('alumnis.store') }}" method="post">
            @csrf
            <div class="card-header">
              <h3 class="card-title">@lang('messages.alumnis.create_new_alumni_form')</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.mobile_number')</label>

                <input type="text" inputmode="numeric" class="form-control @error('mobile') is-invalid @enderror"
                  name="mobile" placeholder="{{ __('messages.alumnis.enter_mobile_number') }}" value="{{ old('mobile') }}">

                @error('mobile')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.address')</label>
                <textarea rows="5" class="form-control @error('address') is-invalid @enderror" name="address"
                  placeholder="{{ __('messages.alumnis.enter_address') }}">{{ old('address') }}</textarea>
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.place_of_birth')</label>

                <input type="text" class="form-control @error('pob') is-invalid @enderror" name="pob"
                  placeholder="{{ __('messages.alumnis.enter_place_of_birth') }}" value="{{ old('pob') }}">

                @error('pob')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.date_of_birth')</label>

                <input type="date" class="form-control @error('dob') is-invalid @enderror datepicker" name="dob"
                  value="{{ old('dob') }}" placeholder="{{ __('messages.alumnis.enter_birthdate') }}">

                @error('dob')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.registration_at')</label>

                <input type="text" class="form-control @error('registration_at') is-invalid @enderror datepicker"
                  name="registration_at" value="{{ old('registration_at') }}" placeholder="{{ __('messages.alumnis.enter_registration_date') }}">

                @error('registration_at')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.graduation_at')</label>

                <input type="text" class="form-control @error('graduation_at') is-invalid @enderror datepicker"
                  name="graduation_at" value="{{ old('graduation_at') }}" placeholder="{{ __('messages.alumnis.enter_graduation_date') }}">

                @error('graduation_at')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required">@lang('messages.alumnis.school')</label>
                <select type="text" name="school_id" class="form-select @error('school_id') is-invalid @enderror"
                  id="select-schools" placeholder="{{ __('messages.alumnis.type_to_search') }}">
                </select>
                @error('school_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              @can(config('access.alumnis/management'))
                <div class="mb-3">
                  <label class="form-label required">@lang('messages.alumnis.user')</label>
                  <select type="text" name="user_id" class="form-select @error('user_id') is-invalid @enderror"
                    id="select-users" placeholder="{{ __('messages.alumnis.type_to_search') }}">
                  </select>
                  @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              @endcan

            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">@lang('messages.alumnis.create')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@prepend('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endprepend

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    $(document).ready(function() {
      if ($("#select-users").length) {
        new TomSelect("#select-users", {
        valueField: 'id',
        labelField: 'full_name',
        searchField: ['first_name', 'last_name'],

        load: function(query, callback) {
          $.ajax({
            url: '/master-data/get-users',
            data: {
              search: query
            },
            dataType: 'json',
            success: function(items) {
              items = items.map(item => {
                item.full_name =
                  `${item.first_name} ${item.last_name}`;
                return item;
              });

              callback(items);
            },
            error: function(items) {
              console.log(items)
            }
          });
        },
        render: {
          item: function(item, escape) {
            return '<div>' + escape(item.full_name) + '</div>';
          },

          option: function(item, escape) {
            return '<div>' + escape(item.full_name) + '</div>';
          }
        }
        });
      }
      
      new TomSelect("#select-schools", {
        valueField: 'id',
        labelField: 'name',
        searchField: ['name', 'stage'],

        load: function(query, callback) {
          $.ajax({
            url: '/master-data/get-schools',
            data: {
              search: query
            },
            dataType: 'json',
            success: function(items) {
              items = items.map(item => {
                item.name =
                  `${item.name} (${item.stage})`;
                return item;
              });

              callback(items);
            },
            error: function(items) {
              console.log(items)
            }
          });
        },
        render: {
          item: function(item, escape) {
            return '<div>' + escape(item.name) + '</div>';
          },

          option: function(item, escape) {
            return '<div>' + escape(item.name) + '</div>';
          }
        }
      })

    });
  </script>

  <script>
    $(".datepicker").flatpickr({
      enableTime: true,
      dateFormat: "Y-m-d H:i",
    });
  </script>
@endpush
