@extends('dashboard.layouts.master')

@section('title', 'Alumni')

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
              <li class="breadcrumb-item" aria-current="page"><a href="{{ route('alumnis.index') }}">Alumnis</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail</a></li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $alumni->user->fullname }}</h3>
            </div>
            <div class="card-body border-bottom py-3">
              <table class="table">
                <tr>
                  <td scope="col">First name</td>
                  <td scope="col">{{ $alumni->user->first_name }}</td>
                </tr>
                <tr>
                  <td scope="col">Last name</td>
                  <td scope="col">{{ $alumni->user->last_name }}</td>
                </tr>
                <tr>
                  <td scope="col">Mobile</td>
                  <td scope="col">{{ $alumni->mobile }}</td>
                </tr>
                <tr>
                  <td scope="col">Adress</td>
                  <td scope="col">{{ $alumni->address }}</td>
                </tr>
                <tr>
                  <td scope="col">Date of birth</td>
                  <td scope="col">{{ $alumni->dob }}</td>
                </tr>
                <tr>
                  <td scope="col">Registration at</td>
                  <td scope="col">{{ $alumni->registration_at }}</td>
                </tr>
                <tr>
                  <td scope="col">Graduation at</td>
                  <td scope="col">{{ $alumni->graduation_at }}</td>
                </tr>
                <tr>
                  <td scope="col">School</td>
                  <td scope="col">{{ $alumni->school->name }}</td>
                </tr>
                <tr>
                  <td scope="col">School stage</td>
                  <td scope="col">
                    <span class="badge badge-primary text-uppercase">{{ $alumni->school->stage }}</span>
                  </td>
                </tr>
                <tr>
                  <td scope="col">School address</td>
                  <td scope="col">{{ $alumni->school->address }}</td>
                </tr>
                <tr>
                  <td scope="col">Created at</td>
                  <td scope="col">{{ $alumni->created_at }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
