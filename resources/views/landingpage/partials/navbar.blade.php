<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('landingpage') }}#page-top">
            <img src="{{ asset('img/simalu.png') }}" alt="Simalu" height="26" class="me-2">
            <span class="fs-4">Alumni's</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center justify-content-lg-end" id="navbarCollapse">
            <ul
                class="navbar-nav align-items-center align-items-lg-center text-center text-lg-start ms-lg-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('landingpage') }}#page-top" class="nav-link fw-semibold text-dark">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('landingpage') }}#alumni" class="nav-link fw-semibold text-dark">Alumni</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('landingpage') }}#kontak" class="nav-link fw-semibold text-dark">Kontak</a>
                </li>
                <!-- Divider for mobile only -->
                <li class="w-100 d-lg-none">
                    <hr class="my-2">
                </li>
                <li class="nav-item d-flex justify-content-center">
                    <a href="{{ route('login') }}"
                        class="btn btn-primary btn-sm rounded-pill px-3 py-1 mx-lg-3 my-2 my-lg-0">
                        @auth
                        <i class="bi bi-house-fill me-2"></i>
                        <span class="fw-semibold">Dashboard</span>
                        @else
                        <i class="bi bi-person-circle me-2"></i>
                        <span class="fw-semibold">Login</span>
                        @endauth
                    </a>
                </li>
                <li class="nav-item dropdown d-flex justify-content-center">
                    <a href="#"
                        class="nav-link dropdown-toggle d-flex align-items-center justify-content-center"
                        data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="fi fi-{{ app()->getLocale() == $locale_id_ID ? 'id' : 'us' }} me-2"></span>
                        ({{ app()->getLocale() }})
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li>
                            <a href="{{ route('locale.switch', ['locale' => $locale_id_ID]) }}"
                                class="dropdown-item {{ app()->getLocale() == $locale_id_ID ? 'disabled' : '' }}">
                                <span class="fi fi-id me-2"></span> @lang('messages.navbar.lang.indonesia') ({{ $locale_id_ID }})
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('locale.switch', ['locale' => $locale_en_US]) }}"
                                class="dropdown-item {{ app()->getLocale() == $locale_en_US ? 'disabled' : '' }}">
                                <span class="fi fi-us me-2"></span> @lang('messages.navbar.lang.english') ({{ $locale_en_US }})
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>