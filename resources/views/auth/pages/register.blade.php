@extends('auth.layouts.master')

@section('title', 'Sign-up')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <span class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('img/simalu.png') }}" alt="{{ config('app.name') }}" width="24" height="24">
                    <span class="fs-1 text-uppercase">{{ config('app.name') }}</span>
                </span>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-title">I'm so sorry…</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="text-secondary">{{ $error }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="card card-md" action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Create new account</h2>
                    <div class="mb-3">
                        <label class="form-label">First name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password confirmation</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Password confirmation" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Create new account</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-secondary mt-3">
                Already have account? <a href="{{ route('login') }}" tabindex="-1">Login</a>
            </div>
        </div>
    </div>
@endsection
