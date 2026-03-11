@extends('auth.layouts.master')

@section('title', __('auth.login_title'))

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-title">@lang('auth.error_title')</h4>
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
                @include('auth.partials.card-header')
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">@lang('auth.login_title')</h2>
                    <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('auth.email_address')</label>
                            <input type="email" name="email" class="form-control" placeholder="@lang('auth.email_placeholder')"
                                autocomplete="off" value="{{ old('email') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                @lang('auth.password_label')
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="@lang('auth.password_placeholder')"
                                    autocomplete="off" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">@lang('auth.login_button')</button>
                        </div>
                        <div class="text-center text-secondary my-3">@lang('auth.or_continue_with')</div>
                        <a href="{{ route('auth.google.redirect') }}"
                            class="btn btn-google-auth w-100 d-flex align-items-center justify-content-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48" aria-hidden="true"
                                focusable="false">
                                <path fill="#FFC107"
                                    d="M43.611 20.083H42V20H24v8h11.303C33.655 32.657 29.236 36 24 36c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z" />
                                <path fill="#FF3D00"
                                    d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4C16.318 4 9.656 8.337 6.306 14.691z" />
                                <path fill="#4CAF50"
                                    d="M24 44c5.166 0 9.86-1.977 13.409-5.191l-6.19-5.238C29.143 35.163 26.715 36 24 36c-5.215 0-9.623-3.319-11.283-7.946l-6.522 5.025C9.505 39.556 16.729 44 24 44z" />
                                <path fill="#1976D2"
                                    d="M43.611 20.083H42V20H24v8h11.303c-.791 2.237-2.231 4.166-4.084 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z" />
                            </svg>
                            <span>@lang('auth.continue_with_google')</span>
                        </a>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                @lang('auth.no_account') <a href="{{ route('register') }}" tabindex="-1">@lang('auth.register_link')</a>
            </div>
        </div>
    </div>
@endsection
