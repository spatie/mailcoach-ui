<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? "{$title} | Mailcoach" : 'Mailcoach' }}</title>

    <link rel="stylesheet" href="{{ asset('vendor/mailcoach/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#1288ff">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="{{ asset('vendor/mailcoach/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
    <img style="mix-blend-mode: multiply;" class="fixed w-full bottom-0 opacity-10" src="{{ asset('vendor/mailcoach/images/auth-footer.jpg') }}">

    <div id="app">
        <div class="min-h-screen flex flex-col">
            <div class="flex-grow flex items-center justify-center mx-12 my-4">
                @include('mailcoach::app.layouts.partials.flash')
                <div class="w-full max-w-md">
                    <div class="flex justify-center -mb-4 z-10">
                        <a href="{{ route('login') }}" class="group w-16 h-16 flex items-center justify-center bg-gradient-to-b from-blue-500 to-blue-600 text-white rounded-full shadow-lg">
                            <span class="w-10 h-10 transform group-hover:scale-90 transition-transform duration-150">
                                @include('mailcoach::app.layouts.partials.logoSvg')
                            </span>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-main">
                            
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
            @include('mailcoach::app.layouts.partials.footer')
        </div>
    </div>

</body>
</html>
