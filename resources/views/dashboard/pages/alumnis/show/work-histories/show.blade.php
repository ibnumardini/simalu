@extends('dashboard.pages.alumnis.show.tabs')

@section('alumni-show-contents')
  <div class="tab-pane active show" id="tabs-2" role="tabpanel">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('messages.alumnis.history_of', ['name' => $alumni->user->fullname]) }}</h3>
            <div class="card-actions">
              <a href="{{ route('alumnis.work-histories.create', ['alumni' => $alumni]) }}" class="btn btn-primary">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
                </svg>
                @lang('messages.alumnis.create_new_work_history')
              </a>
            </div>
          </div>
          <div class="card-body border-bottom py-3">
            <div class="d-flex mb-3">
              <form class="ms-auto" action="" method="get">
                <div class="text-secondary">
                  @lang('messages.alumnis.search'):
                  <div class="ms-2 d-inline-block">
                    <input type="text" name="q" class="form-control form-control-sm"
                      aria-label="{{ __('messages.alumnis.search_work_history') }}" value="">
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
                    <th class="text-center">@lang('messages.alumnis.num')</th>
                    <th>@lang('messages.alumnis.position')</th>
                    <th>@lang('messages.alumnis.start_at')</th>
                    <th>@lang('messages.alumnis.resigned_at')</th>
                    <th>@lang('messages.alumnis.company_name')</th>
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
                            @lang('messages.alumnis.actions')
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item"
                              href="{{ route('alumnis.work-histories.edit', ['alumni' => $alumni, 'workHistory' => $item]) }}">
                              @lang('messages.alumnis.edit')
                            </a>
                            <form
                              action="{{ route('alumnis.work-histories.delete', ['alumni' => $alumni, 'workHistory' => $item]) }}"
                              method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="dropdown-item text-danger btn-confirm-delete">
                                @lang('messages.alumnis.delete')
                              </button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td class="text-center" colspan="6">@lang('messages.alumnis.no_item')</td>
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

@push('scripts')
  <x-form-delete-confirmation target=".btn-confirm-delete" />
@endpush