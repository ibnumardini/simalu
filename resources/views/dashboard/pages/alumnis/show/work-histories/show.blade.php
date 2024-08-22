@extends('dashboard.pages.alumnis.show.tabs')

@section('alumni-show-contents')
  <div class="tab-pane active show" id="tabs-2" role="tabpanel">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">History of {{ $alumni->user->fullname }}</h3>
            <div class="card-actions">
              <a href="{{ route('alumnis.work-histories.create', ['alumni' => $alumni]) }}" class="btn btn-primary">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
                </svg>
                Create new work history
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
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="icon icon-tabler icons-tabler-outline icon-tabler-search">
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
                    <th class="text-center">Num.</th>
                    <th>Position</th>
                    <th>Start at</th>
                    <th>Resigned at</th>
                    <th>Company name</th>
                    <th class="w-1"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($workHistories as $item)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
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
@endsection
