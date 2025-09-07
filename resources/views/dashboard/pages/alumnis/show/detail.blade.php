@extends('dashboard.pages.alumnis.show.tabs')

@section('alumni-show-contents')
  <div class="tab-pane active show" id="tabs-1" role="tabpanel">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ __('messages.alumnis.profile_of', ['name' => $alumni->user->fullname]) }}</h3>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <td scope="col">@lang('messages.alumnis.first_name')</td>
            <td scope="col">{{ $alumni->user->first_name }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.last_name')</td>
            <td scope="col">{{ $alumni->user->last_name }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.mobile')</td>
            <td scope="col">{{ $alumni->mobile }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.address')</td>
            <td scope="col">{{ $alumni->address }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.place_of_birth_label')</td>
            <td scope="col">{{ $alumni->pob }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.date_of_birth_label')</td>
            <td scope="col">{{ $alumni->dob }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.registration_at_label')</td>
            <td scope="col">{{ $alumni->registration_at }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.graduation_at_label')</td>
            <td scope="col">{{ $alumni->graduation_at }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.school_label')</td>
            <td scope="col">{{ $alumni->school->name }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.school_stage')</td>
            <td scope="col">
              <span class="badge badge-primary text-uppercase">{{ $alumni->school->stage }}</span>
            </td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.school_address')</td>
            <td scope="col">{{ $alumni->school->address }}</td>
          </tr>
          <tr>
            <td scope="col">@lang('messages.alumnis.created_at')</td>
            <td scope="col">{{ $alumni->created_at }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
@endsection
