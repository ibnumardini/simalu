@extends('landingpage.layouts.master')

@section('title', "Alumni's List")

@section('content')
<section class="py-6" style="margin-top: 5rem;">
    <div class="container px-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold mb-3">Semua Alumni</h1>
            <p class="lead text-muted mb-0">Cari dan telusuri seluruh data alumni</p>
        </div>

        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('landingpage.alumni') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-lg-5 col-md-12">
                        <label for="q" class="form-label fw-semibold">Pencarian</label>
                        <input type="text" id="q" name="q" class="form-control"
                            placeholder="Nama, sekolah, perusahaan, alamat, atau no. HP" value="{{ $searchQuery }}">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label for="school" class="form-label fw-semibold">Filter Sekolah</label>
                        <select id="school" name="school" class="form-select">
                            <option value="">Semua Sekolah</option>
                            @foreach ($schools as $school)
                            <option value="{{ $school->id }}" @selected((string) $selectedSchool===(string) $school->id)>
                                {{ $school->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label for="cohort" class="form-label fw-semibold">Filter Angkatan</label>
                        <select id="cohort" name="cohort" class="form-select">
                            <option value="">Semua Angkatan</option>
                            @foreach ($cohorts as $cohort)
                            <option value="{{ $cohort }}" @selected((string) $selectedCohort===(string) $cohort)>
                                {{ $cohort }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi-search me-2"></i>Cari
                        </button>
                        <a href="{{ route('landingpage.alumni') }}" class="btn btn-outline-secondary w-100">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($alumnis as $alumni)
            <div class="col-lg-4 col-md-6">
                <div class="card alumni-card h-100 shadow-sm border-0 rounded-3">
                    <div class="card-body text-center p-4">
                        <img src="{{ $alumni->user->avatar ? asset('storage/' . $alumni->user->avatar) : asset('img/avatar.png') }}"
                            alt="Foto Alumni" class="rounded-circle mb-3" width="110" height="110">
                        <h5 class="card-title mb-2">
                            {{ trim(($alumni->user->first_name ?? '') . ' ' . ($alumni->user->last_name ?? '')) }}
                        </h5>
                        <p class="text-muted mb-2">
                            <i class="bi-mortarboard me-1"></i>
                            {{ $alumni->school->name }} - Angkatan {{ $alumni->cohort }}
                        </p>
                        <p class="text-primary mb-0">
                            <i class="bi-building me-1"></i>
                            {{ $alumni->latestWorkHistory->company->name ?? '[Tidak Diketahui]' }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-light border text-center py-4 mb-0">
                    Data alumni tidak ditemukan.
                </div>
            </div>
            @endforelse
        </div>

        @if ($alumnis->hasPages())
        <div class="mt-5">
            <p class="text-muted small text-center mb-3">
                Menampilkan {{ $alumnis->firstItem() }} - {{ $alumnis->lastItem() }} dari {{ $alumnis->total() }} alumni
            </p>
            <div class="d-flex justify-content-center">
                {{ $alumnis->appends(request()->query())->onEachSide(1)->links('vendor.pagination.landing-bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection