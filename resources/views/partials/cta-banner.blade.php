{{-- Closing call-to-action before the footer. --}}
<section class="section cta" aria-labelledby="ctaTitle">
    <div class="container">
        <div class="cta-banner">
            <div>
                <h2 class="cta-banner__title" id="ctaTitle">{{ __('Ready to plan your trip?') }}</h2>
                <p class="cta-banner__text">{{ __('Tell us where and when. We will send you the best options within hours.') }}</p>
            </div>

            <div class="cta-banner__actions">
                <a class="btn btn-site btn-lg" href="{{ route(config('site.book_now_route')) }}">
                    {{ __('Book Now') }}
                    <i class="bi bi-airplane-fill" aria-hidden="true"></i>
                </a>
                <a class="btn btn-outline-light btn-lg" href="{{ config('site.whatsapp_url') }}"
                   target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp" aria-hidden="true"></i>
                    {{ __('Chat on WhatsApp') }}
                </a>
            </div>
        </div>
    </div>
</section>
