<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Alumni's - Terhubung dengan Alumni Terbaik</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @vite('resources/css/landingpage.css')
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#page-top">
                <img src="{{ asset('img/simalu.png') }}" alt="Simalu" height="26" class="me-2">
                <span class="fs-4">Alumni's</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="#page-top" class="nav-link me-4 text-dark fw-semibold text-decoration-none">Beranda</a>
                <a href="#alumni" class="nav-link me-4 text-dark fw-semibold text-decoration-none">Alumni</a>
                <a href="#kontak" class="nav-link me-4 text-dark fw-semibold text-decoration-none">Kontak</a>
                <button class="btn btn-primary rounded-pill px-3 py-1 d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i>
                    <span class="fw-semibold">Login</span>
                </button>
            </div>
        </div>
    </nav>
    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center" style="min-height: 85vh;">
                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-3 display-lg-1 lh-1 mb-4">Terhubung dengan <span
                                class="text-gradient">Alumni</span> Terbaik</h1>
                        <p class="lead fw-normal text-muted mb-4 mb-lg-5">Platform yang menghubungkan masa lalu, masa
                            kini, dan masa depan karir Anda.</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center mt-4">
                            <a href="#alumni" class="btn btn-primary btn-lg rounded-pill px-4">
                                <i class="bi-eye me-2"></i>
                                <span class="fw-semibold">Lihat Alumni</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Masthead device mockup feature-->
                    <div class="masthead-device-mockup">
                        <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03"
                                transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03"
                                transform="translate(-49.88 120.42) rotate(-45)"></rect>
                        </svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                        <div class="device-wrapper" style="position: relative; z-index: 10;">
                            <div class="text-center">
                                <img src="{{ asset('img/simalu.png') }}" alt="Logo Simalu Alumni" class="img-fluid"
                                    style="max-width: 350px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Alumni Statistics -->
    <aside class="text-center bg-gradient-primary-to-secondary py-6">
        <div class="container px-5">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-white px-3">
                                <h1 class="display-3 fw-bold mb-3">1,250+</h1>
                                <p class="fs-5 mb-0">Alumni Terdaftar</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-white px-3">
                                <h1 class="display-3 fw-bold mb-3">350+</h1>
                                <p class="fs-5 mb-0">Perusahaan Tergabung</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-white px-3">
                                <h1 class="display-3 fw-bold mb-3">25+</h1>
                                <p class="fs-5 mb-0">Sekolah Tergabung</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- Alumnis section-->
    <section id="alumni" class="py-6">
        <div class="container px-5">
            <div class="text-center mb-6">
                <h2 class="display-5 fw-bold mb-4">Alumni</h2>
                <p class="lead text-muted">Bergabunglah dengan alumni sukses dari berbagai sekolah</p>
            </div>
            <div class="row g-4 py-5">
                <div class="col-lg-4 col-md-6">
                    <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body text-center p-5">
                            <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni" class="rounded-circle mb-3"
                                width="120" height="120">
                            <h5 class="card-title mb-2">Ahmad Wijaya</h5>
                            <p class="text-muted mb-2"><i class="bi-mortarboard me-1"></i>SMK Negeri 1 Jakarta -
                                Angkatan 2013</p>
                            <p class="text-primary mb-0"><i class="bi-building me-1"></i>PT. Telkom Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body text-center p-5">
                            <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni" class="rounded-circle mb-3"
                                width="120" height="120">
                            <h5 class="card-title mb-2">Siti Aminah</h5>
                            <p class="text-muted mb-2"><i class="bi-mortarboard me-1"></i>SMK Bina Nusantara -
                                Angkatan 2014</p>
                            <p class="text-primary mb-0"><i class="bi-building me-1"></i>Bank Central Asia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body text-center p-5">
                            <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni" class="rounded-circle mb-3"
                                width="120" height="120">
                            <h5 class="card-title mb-2">Budi Pratama</h5>
                            <p class="text-muted mb-2"><i class="bi-mortarboard me-1"></i>SMK Teknologi Bandung -
                                Angkatan 2015</p>
                            <p class="text-primary mb-0"><i class="bi-building me-1"></i>Gojek Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body text-center p-5">
                            <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni" class="rounded-circle mb-3"
                                width="120" height="120">
                            <h5 class="card-title mb-2">Dewi Fatimah</h5>
                            <p class="text-muted mb-2"><i class="bi-mortarboard me-1"></i>SMK Multimedia Surabaya -
                                Angkatan 2016</p>
                            <p class="text-primary mb-0"><i class="bi-building me-1"></i>Tokopedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body text-center p-5">
                            <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni" class="rounded-circle mb-3"
                                width="120" height="120">
                            <h5 class="card-title mb-2">Rizky Hidayat</h5>
                            <p class="text-muted mb-2"><i class="bi-mortarboard me-1"></i>SMK Negeri 2 Yogyakarta -
                                Angkatan 2017</p>
                            <p class="text-primary mb-0"><i class="bi-building me-1"></i>Shopee Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body text-center p-5">
                            <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni" class="rounded-circle mb-3"
                                width="120" height="120">
                            <h5 class="card-title mb-2">Maya Sari</h5>
                            <p class="text-muted mb-2"><i class="bi-mortarboard me-1"></i>SMK Bisnis Manajemen -
                                Angkatan 2018</p>
                            <p class="text-primary mb-0"><i class="bi-building me-1"></i>Grab Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-6">
                <button class="btn btn-primary btn-lg rounded-pill px-4">
                    <i class="bi-people me-2"></i>
                    <span class="fw-semibold">Lihat Semua Alumni</span>
                </button>
            </div>
        </div>
    </section>
    <!-- Testimonial section-->
    <section class="bg-light py-6">
        <div class="container px-5">
            <div class="text-center mb-6">
                <h2 class="display-5 fw-bold mb-4">Testimoni</h2>
                <p class="lead text-muted">Apa kata mereka tentang platform alumni</p>
            </div>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Testimonial 1 -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="text-center py-4">
                                    <i class="bi-quote fs-1 text-primary mb-3"></i>
                                    <blockquote class="fs-5 mb-4">"Platform ini sangat membantu saya terhubung dengan
                                        sesama alumni. Saya berhasil mendapatkan pekerjaan impian melalui referensi dari
                                        senior yang sudah bekerja di perusahaan tersebut."</blockquote>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni"
                                            class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h6 class="mb-0">Ahmad Wijaya</h6>
                                            <small class="text-muted">SMK Negeri 1 Jakarta - Angkatan 2018</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="text-center py-4">
                                    <i class="bi-quote fs-1 text-primary mb-3"></i>
                                    <blockquote class="fs-5 mb-4">"Senang bisa berbagi pengalaman dengan adik-adik
                                        kelas. Melalui platform ini, saya bisa memberikan mentor dan guidance untuk yang
                                        sedang mencari kerja."</blockquote>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni"
                                            class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h6 class="mb-0">Siti Aminah</h6>
                                            <small class="text-muted">SMK Bina Nusantara - Angkatan 2019</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="text-center py-4">
                                    <i class="bi-quote fs-1 text-primary mb-3"></i>
                                    <blockquote class="fs-5 mb-4">"Networking yang terbangun di platform ini luar
                                        biasa. Saya bisa menjalin kerja sama bisnis dengan alumni dari berbagai angkatan
                                        dan sekolah."</blockquote>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('img/avatar.png') }}" alt="Foto Alumni"
                                            class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h6 class="mb-0">Budi Pratama</h6>
                                            <small class="text-muted">SMK Teknologi Bandung - Angkatan 2020</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Selanjutnya</span>
                </button>
                <div class="carousel-indicators" style="position: static; margin-top: 20px;">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0"
                        class="active"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"></button>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to action section-->
    <section class="cta">
        <div class="cta-content">
            <div class="container px-5">
                <h2 class="text-white display-3 lh-1 mb-4">
                    Berhenti Menunggu.
                    <br />
                    Mulai <span class="text-gradient">Bergabung.</span>
                </h2>
                <button class="btn btn-outline-light px-4 rounded-pill">
                    <i class="bi-person-plus me-2"></i>
                    Bergabung Sekarang
                </button>
            </div>
        </div>
    </section>
    <!-- Footer section-->
    <footer id="kontak" class="bg-black text-white-50 py-6">
        <div class="container px-5">
            <div class="row">
                <!-- Logo and Description -->
                <div class="col-lg-6 mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('img/simalu.png') }}" alt="Simalu" height="30" class="me-2">
                        <h5 class="text-white mb-0">Alumni</h5>
                    </div>
                    <h6 class="text-white mb-3">Terhubung dengan Alumni Terbaik</h6>
                    <p class="text-white-50">Platform yang menghubungkan masa lalu, masa kini, dan masa depan karir
                        alumni.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-4 mb-5">
                    <h6 class="text-white mb-4">Menu</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#page-top" class="text-white-50 text-decoration-none">Beranda</a>
                        </li>
                        <li class="mb-2"><a href="#alumni" class="text-white-50 text-decoration-none">Alumni</a>
                        </li>
                        <li class="mb-2"><a href="#kontak" class="text-white-50 text-decoration-none">Kontak</a>
                        </li>
                    </ul>
                </div>
                <!-- Ikuti Kami -->
                <div class="col-lg-2 col-md-4 mb-5">
                    <h6 class="text-white mb-4">Ikuti Kami</h6>
                    <div class="d-flex">
                        <a href="#!" class="text-white-50 fs-4"><i class="bi-instagram"></i></a>
                    </div>
                </div>
                <!-- Contact Info -->
                <div class="col-lg-2 col-md-4 mb-5">
                    <h6 class="text-white mb-4">Kontak</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi-envelope me-2"></i>
                            <span class="text-white-50">info@simalu.com</span>
                        </li>
                        <li class="mb-2">
                            <i class="bi-telephone me-2"></i>
                            <span class="text-white-50">+62 822 1234 5678</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi-geo-alt me-2 flex-shrink-0"></i>
                            <span class="text-white-50 text-nowrap">Yogyakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="border-white-50 my-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-white-50 small">
                        &copy; 2024 Simalu Alumni. Semua Hak Dilindungi.
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="text-white-50 small">
                        <a href="#!" class="text-white-50 text-decoration-none">Kebijakan Privasi</a>
                        <span class="mx-2">&middot;</span>
                        <a href="#!" class="text-white-50 text-decoration-none">Syarat Layanan</a>
                        <span class="mx-2">&middot;</span>
                        <a href="#!" class="text-white-50 text-decoration-none">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Gradient bottom bar -->
    <div class="bg-gradient-primary-to-secondary" style="height: 5px;"></div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    @vite('resources/js/landingpage.js')
</body>

</html>
