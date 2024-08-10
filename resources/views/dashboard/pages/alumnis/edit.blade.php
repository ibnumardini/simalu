@extends('dashboard.layouts.master')

@section('title', 'Edit Alumni')

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
                            <li class="breadcrumb-item"><a href="{{ route('alumnis.index') }}">Alumni</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Edit</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">
                        Alumni
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
                    <form class="card" action="{{ route('alumnis.update', ['alumni' => $alumni->id]) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Edit new alumni</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Mobile Number</label>

                                <input type="text" inputmode="numeric"
                                    class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                    placeholder="Enter your mobile number" value="{{ old('mobile', $alumni->mobile) }}">

                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Address</label>
                                <textarea rows="5" class="form-control @error('address') is-invalid @enderror" name="address"
                                    placeholder="Enter address">{{ old('address', $alumni->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Date of Birth</label>

                                <input type="date" class="form-control @error('dob') is-invalid @enderror datepicker"
                                    name="dob" value="{{ old('dob', $alumni->dob) }}"
                                    placeholder="Enter your birthdate">

                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Registration At</label>

                                <input type="text"
                                    class="form-control @error('registration_at') is-invalid @enderror datepicker"
                                    name="registration_at" value="{{ old('registration_at', $alumni->registration_at) }}"
                                    placeholder="Enter your registration date">

                                @error('registration_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Graduation At</label>

                                <input type="text"
                                    class="form-control @error('graduation_at') is-invalid @enderror datepicker"
                                    name="graduation_at" value="{{ old('graduation_at', $alumni->graduation_at) }}"
                                    placeholder="Enter your graduation date">

                                @error('graduation_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">School</label>
                                <select type="text" name="school_id"
                                    class="form-select @error('school_id') is-invalid @enderror" id="select-schools">
                                    <option value="{{ $alumni->school_id }}" selected>{{ $alumni->school->name }}
                                    </option>

                                </select>
                                @error('school_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">User</label>
                                <select type="text" name="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror" id="select-users">
                                    <option value="{{ $alumni->user_id }}" selected>{{ $alumni->user->fullName }}
                                </select>
                                @error('user_id')
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

@prepend('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endprepend

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {

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
            })

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
                },

            })

        });
    </script>

    <script>
        $(".datepicker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
        });
    </script>
@endpush
