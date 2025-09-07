<div class="card-header d-flex justify-content-between align-items-center">
    <span class="navbar-brand navbar-brand-autodark">
        <img src="{{ asset('img/simalu.png') }}" alt="{{ config('app.name') }}" width="24" height="24">
        <span class="fs-1 text-uppercase">{{ config('app.name') }}</span>
    </span>
    <div class="nav-item dropdown me-3">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <span class="fi fi-{{ app()->getLocale() == $locale_id_ID ? 'id' : 'us' }} me-2"></span>
            ({{ app()->getLocale() }})
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="{{ route('locale.switch', ['locale' => $locale_id_ID]) }}"
                class="dropdown-item {{ app()->getLocale() == $locale_id_ID ? 'disabled' : '' }}"><span
                    class="fi fi-id me-2"></span> @lang('messages.navbar.lang.indonesia') ({{ $locale_id_ID }})</a>
            <a href="{{ route('locale.switch', ['locale' => $locale_en_US]) }}"
                class="dropdown-item {{ app()->getLocale() == $locale_en_US ? 'disabled' : '' }}"><span
                    class="fi fi-us me-2"></span> @lang('messages.navbar.lang.english') ({{ $locale_en_US }})</a>
        </div>
    </div>
</div>
