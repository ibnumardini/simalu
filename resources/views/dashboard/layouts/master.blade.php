<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title') - {{ str()->upper(config('app.name')) }} - {{ config('app.desc') }}.</title>
    <!-- CSS files -->
    <link href=" {{ asset('/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <div class="page">
        @include('dashboard.partials.navbar')
        <div class="page-wrapper">
            @yield('content')

            @include('dashboard.partials.footer')
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('/libs/tom-select/dist/js/tom-select.base.min.js') }}" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('/js/tabler.min.js') }}" defer></script>

    @stack('scripts')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
</body>

</html>
