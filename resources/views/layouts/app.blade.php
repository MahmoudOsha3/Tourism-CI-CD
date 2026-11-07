<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#07152d">

    {{-- SEO --}}
    <title>@yield('title', config('site.name'))</title>
    <meta name="description" content="@yield('meta_description', __('Book flights, hotels, tours, transfers and visa services in Egypt in minutes.'))">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:title" content="@yield('title', config('site.name'))">
    <meta property="og:description" content="@yield('meta_description', __('Book flights, hotels, tours, transfers and visa services in Egypt in minutes.'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/og-cover.jpg'))">

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

    {{-- Performance: connect early to third-party origins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    @stack('head')

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,800;1,700&family=Roboto:wght@400;500;700&display=swap">

    {{-- Vendor CSS (versions pinned; self-host through npm/Vite for best Lighthouse scores) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('vendor-styles')

    {{-- Application CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')

    {{-- Structured data --}}
    <script type="application/ld+json">{!! json_encode([
        '@context'  => 'https://schema.org',
        '@type'     => 'TravelAgency',
        'name'      => config('site.name'),
        'url'       => url('/'),
        'logo'      => asset('assets/images/logo.svg'),
        'telephone' => config('site.phone'),
        'email'     => config('site.email'),
        'address'   => config('site.address'),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
</head>
<body>
    <a class="visually-hidden-focusable skip-link" href="#main">{{ __('Skip to main content') }}</a>

    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Vendor JS first, then app JS (all deferred, so execution order is preserved) --}}
    @stack('vendor-scripts')
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
