@extends('dashboard.pages.alumnis.show.tabs')

@section('alumni-show-contents')
  <div class="tab-pane active show" id="tabs-1" role="tabpanel">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Profile of {{ $alumni->user->fullname }}</h3>
      </div>
      <div class="card-body">
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
      </div>
    </div>
  </div>
@endsection
