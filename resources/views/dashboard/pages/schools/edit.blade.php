@extends('dashboard.layouts.master')

@section('title', 'Edit School')

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
              <li class="breadcrumb-item"><a href="{{ route('schools.index') }}">Schools</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Edit</a></li>
            </ol>
          </div>
          <h2 class="page-title">
            School
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
          <form class="card" action="{{ route('schools.update', ['school' => $school->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h3 class="card-title">Edit school {{ $school->name }}</h3>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label required">Name</label>
                <div>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    aria-describedby="emailHelp" placeholder="Enter name" value="{{ old('name') ?? $school->name }}"
                    required>
                </div>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label required">Stage</label>
                <select type="text" name="stage" class="form-select @error('stage') is-invalid @enderror"
                  id="select-stage" required>
                  <option value="formal" {{ $school->stage == 'formal' ? 'selected' : '' }}>
                    Formal
                  </option>
                  <option value="non-formal" {{ $school->stage == 'non-formal' ? 'selected' : '' }}>
                    Non-Formal
                  </option>
                </select>
                @error('stage')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3 mb-0">
                <label class="form-label required">Address</label>
                <textarea rows="5" class="form-control @error('address') is-invalid @enderror" name="address"
                  placeholder="Enter address">{{ old('address') ?? $school->address }}</textarea>
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <div class="form-label">Photos</div>
                <input type="file" class="form-control @error('photos') is-invalid @enderror" name="photos[]"
                  accept="image/gif,image/jpg,image/jpeg,image/png" multiple />
                <div id="photosHelp" class="form-text">The uploaded photo will replace all previously uploaded photos.
                </div>
                @error('photos')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var el;
      window.TomSelect && (new TomSelect(el = document.getElementById('select-stage'), {
        copyClassesToDropdown: false,
        dropdownParent: 'body',
        controlInput: '<input>',
        render: {
          item: function(data, escape) {
            if (data.customProperties) {
              return '<div><span class="dropdown-item-indicator">' + data
                .customProperties + '</span>' + escape(data.text) + '</div>';
            }
            return '<div>' + escape(data.text) + '</div>';
          },
          option: function(data, escape) {
            if (data.customProperties) {
              return '<div><span class="dropdown-item-indicator">' + data
                .customProperties + '</span>' + escape(data.text) + '</div>';
            }
            return '<div>' + escape(data.text) + '</div>';
          },
        },
      }));
    });
  </script>
@endpush
