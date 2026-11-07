{{-- Site header: top bar + sticky primary navigation --}}
@php
    $locale    = app()->getLocale();
    $languages = config('site.languages');
@endphp

<header class="site-header" data-site-header>

    {{-- Top bar --}}
    <div class="topbar">
        <div class="container topbar__inner">
            <div class="topbar__group">

                {{-- Language selector --}}
                <div class="dropdown-lite" data-dropdown>
                    <button type="button" class="topbar__link" data-dropdown-toggle
                            aria-haspopup="true" aria-expanded="false" aria-controls="languageMenu">
                        <img class="topbar__flag" src="{{ asset('assets/images/flags/' . $locale . '.svg') }}"
                             width="20" height="14" alt="">
                        <span>{{ $languages[$locale] ?? strtoupper($locale) }}</span>
                        <i class="bi bi-chevron-down" aria-hidden="true"></i>
                    </button>

                    <ul class="dropdown-lite__menu" id="languageMenu" data-dropdown-menu hidden>
                        @foreach ($languages as $code => $label)
                            <li>
                                <a @class(['dropdown-lite__item', 'is-active' => $code === $locale])
                                   href="{{ route('locale.switch', $code) }}"
                                   hreflang="{{ $code }}" lang="{{ $code }}"
                                   @if ($code === $locale) aria-current="true" @endif>{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <span class="topbar__link">
                    <i class="bi bi-clock" aria-hidden="true"></i>
                    <span>{{ __('24/7 Support') }}</span>
                </span>
            </div>

            <a class="topbar__link" href="tel:{{ config('site.phone_link') }}">
                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                <span>{{ config('site.phone') }}</span>
            </a>
        </div>
    </div>

    {{-- Main navigation --}}
    <nav class="navbar navbar-expand-lg site-nav" aria-label="{{ __('Primary') }}">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}" aria-label="{{ config('site.name') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" width="170" height="40" alt="{{ config('site.name') }}">
            </a>

            <button type="button" class="site-nav__toggler d-lg-none" data-nav-toggle
                    aria-controls="primaryMenu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <i class="bi bi-list" aria-hidden="true"></i>
            </button>

            <div class="collapse navbar-collapse" id="primaryMenu" data-nav-menu>
                <ul class="navbar-nav me-auto ms-lg-5">
                    @foreach (config('site.nav') as $item)
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => request()->routeIs($item['active'])])
                               href="{{ route($item['route']) }}"
                               @if (request()->routeIs($item['active'])) aria-current="page" @endif>{{ __($item['label']) }}</a>
                        </li>
                    @endforeach
                </ul>

                <a class="btn btn-site btn-lg site-nav__cta" href="{{ route(config('site.book_now_route')) }}">
                    {{ __('Book Now') }}
                    <i class="bi bi-airplane-fill" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </nav>
</header>
