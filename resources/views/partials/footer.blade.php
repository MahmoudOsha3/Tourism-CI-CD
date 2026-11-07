{{-- Site footer. Optional: $footerDestinations (collection) – inject with a View Composer. --}}
@php
    $footerDestinations = $footerDestinations ?? collect();
@endphp

<footer class="site-footer">

    {{-- Trust strip --}}
    <div class="footer-benefits">
        <div class="container">
            <ul class="benefits row row-cols-1 row-cols-md-3 row-cols-xl-5 g-3 list-unstyled mb-0">
                @foreach (config('site.benefits') as $benefit)
                    <li class="col">
                        <div class="benefit">
                            <i class="bi {{ $benefit['icon'] }} benefit__icon" aria-hidden="true"></i>
                            <div>
                                <p class="benefit__title">{{ __($benefit['title']) }}</p>
                                <p class="benefit__text">{{ __($benefit['text']) }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Main footer --}}
    <div class="footer-main">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 gy-4">

                {{-- Brand --}}
                <div class="col footer-col">
                    <a href="{{ route('home') }}" class="footer-logo" aria-label="{{ config('site.name') }}">
                        <img src="{{ asset('assets/images/logo.svg') }}" width="170" height="40"
                             alt="{{ config('site.name') }}" loading="lazy" decoding="async">
                    </a>
                    <p class="footer-about">{{ __(config('site.tagline')) }}</p>

                    <ul class="social-links list-unstyled">
                        @foreach (config('site.socials') as $social)
                            <li>
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                   aria-label="{{ $social['label'] }}">
                                    <i class="bi {{ $social['icon'] }}" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Quick links --}}
                <nav class="col footer-col" aria-labelledby="footerQuickLinks">
                    <h2 class="footer-title" id="footerQuickLinks">{{ __('Quick Links') }}</h2>
                    <ul class="footer-links">
                        @foreach (config('site.quick_links') as $link)
                            <li><a href="{{ route($link['route']) }}">{{ __($link['label']) }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                {{-- Top destinations --}}
                <nav class="col footer-col" aria-labelledby="footerDestinations">
                    <h2 class="footer-title" id="footerDestinations">{{ __('Top Destinations') }}</h2>
                    <ul class="footer-links">
                        @foreach ($footerDestinations as $destination)
                            <li><a href="{{ route('destinations.show', $destination) }}">{{ $destination->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('destinations.index') }}">{{ __('All Destinations') }}</a></li>
                    </ul>
                </nav>

                {{-- Contact --}}
                <div class="col footer-col">
                    <h2 class="footer-title">{{ __('Contact Us') }}</h2>
                    <address class="footer-contact">
                        <p><i class="bi bi-telephone" aria-hidden="true"></i>
                            <a href="tel:{{ config('site.phone_link') }}">{{ config('site.phone') }}</a></p>
                        <p><i class="bi bi-envelope" aria-hidden="true"></i>
                            <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></p>
                        <p><i class="bi bi-geo-alt" aria-hidden="true"></i>
                            <span>{{ config('site.address') }}</span></p>
                    </address>
                </div>

                {{-- Newsletter --}}
                <div class="col footer-col">
                    <h2 class="footer-title">{{ __('Newsletter') }}</h2>
                    <p class="footer-about">{{ __('Subscribe to get our best deals and offers.') }}</p>

                    <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <label class="visually-hidden" for="newsletterEmail">{{ __('Email address') }}</label>
                        <div class="newsletter-form__group">
                            <input type="email" class="form-control" id="newsletterEmail" name="email"
                                   value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}"
                                   autocomplete="email" required
                                   @error('email') aria-invalid="true" aria-describedby="newsletterFeedback" @enderror>
                            <button type="submit" class="btn btn-site" aria-label="{{ __('Subscribe') }}">
                                <i class="bi bi-send" aria-hidden="true"></i>
                            </button>
                        </div>

                        @error('email')
                            <p class="newsletter-form__feedback is-error" id="newsletterFeedback" role="alert">{{ $message }}</p>
                        @enderror
                        @if (session('newsletter_status'))
                            <p class="newsletter-form__feedback" role="status">{{ session('newsletter_status') }}</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="footer-bottom">
        <div class="container footer-bottom__inner">
            <p class="mb-0">&copy; {{ now()->year }} {{ config('site.name') }}. {{ __('All Rights Reserved.') }}</p>

            <ul class="footer-legal list-unstyled mb-0">
                <li><a href="{{ route('pages.privacy') }}">{{ __('Privacy Policy') }}</a></li>
                <li><a href="{{ route('pages.terms') }}">{{ __('Terms & Conditions') }}</a></li>
            </ul>

            <ul class="payment-icons list-unstyled mb-0">
                @foreach (config('site.payments') as $payment)
                    <li>
                        <img src="{{ asset('assets/images/payments/' . $payment . '.svg') }}"
                             width="44" height="28" alt="{{ ucfirst($payment) }}" loading="lazy" decoding="async">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <button type="button" class="back-to-top" data-back-to-top hidden aria-label="{{ __('Back to top') }}">
        <i class="bi bi-chevron-up" aria-hidden="true"></i>
    </button>
</footer>
