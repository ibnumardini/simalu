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
                  <td scope="col">Place of birth</td>
                  <td scope="col">{{ $alumni->pob }}</td>
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
              <div class="row row-cards">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Work Histories</h3>
                      <div class="card-actions">
                        <a href="#" class="btn btn-primary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                          </svg>
                          Add new
                        </a>
                      </div>
                    </div>
                    <div class="card-body border-bottom py-3">
                      <div class="d-flex mb-3">
                        <form class="ms-auto" action="" method="get">
                          <div class="text-secondary">
                            Search:
                            <div class="ms-2 d-inline-block">
                              <input type="text" name="q" class="form-control form-control-sm"
                                aria-label="Search work history" value="">
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
                              <th>Num.</th>
                              <th>Position</th>
                              <th>Start at</th>
                              <th>Resigned at</th>
                              <th>Company name</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($workHistories as $item)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->start_at }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td>
                                  <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                      Actions
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="">
                                        Edit
                                      </a>
                                      <form action="" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item text-danger">
                                          Delete
                                        </button>
                                      </form>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td class="text-center" colspan="6">No item.</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer">
                      {{ $workHistories->withQueryString()->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
