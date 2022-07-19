<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? "{$title} | Mailcoach" : 'Mailcoach' }}</title>

    {!! \Spatie\Mailcoach\Mailcoach::styles() !!}

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#1288ff">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="text-gray-800 bg-indigo-900/5 ">
    <div id="app" class="min-h-screen flex flex-col p-10 gap-10">
            <div class="flex-grow flex items-center justify-center">
                @include('mailcoach::app.layouts.partials.flash')
                <div class="card w-full max-w-md !p-0">
                    <header class="navigation-main !px-6 md:!px-10 !py-4 !rounded-b-none !rounded-t-md">
                        <a href="{{ route('login') }}" class="flex items-center group gap-2">
                            <span class="flex w-10 h-6 text-white transform group-hover:scale-90 transition-transform duration-150">
                                @include('mailcoach::app.layouts.partials.logoSvg')
                            </span>
                            <span class="text-white uppercase text-xs font-bold tracking-wider">Mailcoach</span>
                        </a>
                    </header>
                    <main class="p-6 md:p-10">
                        {{ $slot }}
                    </main>
                </div>
            </div>
            @include('mailcoach::app.layouts.partials.footer')
    </div>

    {!! \Spatie\Mailcoach\Mailcoach::scripts() !!}
</body>
</html>
