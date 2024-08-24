@extends('dashboard.pages.alumnis.show.tabs')

@section('alumni-show-contents')
  <div class="row row-cards">
    <div class="col-12">
      <form class="card" action="{{ route('alumnis.work-histories.store', compact('alumni')) }}" method="post">
        @csrf
        <div class="card-header">
          <h3 class="card-title">Create new work history</h3>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label required">Position</label>
            <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
              placeholder="Enter your position" value="{{ old('position') }}" required>
            @error('position')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label required">Start at</label>
            <div class="input-icon">
              <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                  <path d="M16 3v4" />
                  <path d="M8 3v4" />
                  <path d="M4 11h16" />
                  <path d="M11 15h1" />
                  <path d="M12 15v3" />
                </svg>
              </span>
              <input class="form-control @error('start_at') is-invalid @enderror" name="start_at" id="datepicker_start_at"
                placeholder="Select a date" value="{{ old('start_at') }}" />
              @error('start_at')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Resigned at</label>
            <div class="input-icon">
              <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                  <path d="M16 3v4" />
                  <path d="M8 3v4" />
                  <path d="M4 11h16" />
                  <path d="M11 15h1" />
                  <path d="M12 15v3" />
                </svg>
              </span>
              <input class="form-control @error('resigned_at') is-invalid @enderror" name="resigned_at"
                id="datepicker_resigned_at" placeholder="Select a date" value="{{ old('resigned_at') }}" />
              @error('resigned_at')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label required">Company</label>
            <select type="text" class="form-select @error('company') is-invalid @enderror" id="select-company"
              name="company" placeholder="Type to search company ...">
            </select>
            @error('company')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="card-footer text-end">
          <a href="{{ route('alumnis.work-histories.show', compact('alumni')) }}" class="btn btn-danger">Cancel</a>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('/libs/litepicker/dist/litepicker.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const prevSvg =
        `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`;
      const nextSvg =
        `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`;

      ["start", "resigned"].forEach((id) => {
        window.Litepicker && (new Litepicker({
          element: document.getElementById(`datepicker_${id}_at`),
          resetButton: () => {
            let btn = document.createElement('button');
            btn.innerText = 'Clear';
            btn.addEventListener('click', (evt) => {
              evt.preventDefault();
            });

            return btn;
          },
          buttonText: {
            previousMonth: prevSvg,
            nextMonth: nextSvg,
          },
        }));
      })
    });
  </script>
@endpush

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const el = document.getElementById('select-company');

      if (!window.TomSelect || !el) return;

      new TomSelect(el, {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        copyClassesToDropdown: false,
        dropdownParent: 'body',
        controlInput: '<input>',
        loadThrottle: 600,
        load: async function(query, callback) {
          try {
            const url = new URL(`{{ route('companies.get') }}`);
            url.searchParams.append('q', query);

            const response = await fetch(url);

            if (!response.ok) {
              throw new Error('Failed to fetch data');
            }

            const data = await response.json();

            callback(data);
          } catch (error) {
            console.error('Error fetching data:', error);

            callback();
          }
        },
        render: {
          item: (data, escape) => `<div>${escape(data.name)}</div>`,
          option: (data, escape) => `<div>${escape(data.name)}</div>`,
        }
      });
    });
  </script>
@endpush
