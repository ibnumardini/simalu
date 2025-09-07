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
                                autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                @lang('auth.password_label')
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="@lang('auth.password_placeholder')"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">@lang('auth.login_button')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                @lang('auth.no_account') <a href="{{ route('register') }}" tabindex="-1">@lang('auth.register_link')</a>
            </div>
        </div>
    </div>
@endsection
