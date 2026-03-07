@extends('auth.layouts.master')

@section('title', __('auth.register_title'))

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
            <form class="card card-md" action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
                @csrf
                @include('auth.partials.card-header')
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">@lang('auth.register_title')</h2>
                    <div class="mb-3">
                        <label class="form-label">@lang('auth.first_name') <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" placeholder="@lang('auth.first_name_placeholder')" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('auth.last_name') <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control" placeholder="@lang('auth.last_name_placeholder')" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('auth.email_address') <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="@lang('auth.email_placeholder_register')" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('auth.password_label') <span class="text-danger">*</span></label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control" placeholder="@lang('auth.password_placeholder_register')"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('auth.password_confirmation') <span class="text-danger">*</span></label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="@lang('auth.password_confirmation_placeholder')" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">@lang('auth.register_button')</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-secondary mt-3">
                @lang('auth.have_account') <a href="{{ route('login') }}" tabindex="-1">@lang('auth.login_link')</a>
            </div>
        </div>
    </div>
@endsection
