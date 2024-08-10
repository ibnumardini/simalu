@extends('auth.layouts.master')

@section('title', 'Sign-in')

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

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>
                    <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com"
                                autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="Your password"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Register</a>
            </div>
        </div>
    </div>
@endsection
