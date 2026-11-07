{{-- FAQ accordion built with native <details> (no JS) + FAQPage structured data. --}}
@php
    $faqs = $faqs ?? config('site.faqs');
@endphp

@push('head')
    <script type="application/ld+json">{!! json_encode([
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => collect($faqs)->map(fn ($faq) => [
            '@type'          => 'Question',
            'name'           => __($faq['q']),
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => __($faq['a'])],
        ])->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush

<section class="section faq" id="faq" aria-labelledby="faqTitle">
    <div class="container faq__container">
        <x-section-heading id="faqTitle" :title="__('Frequently Asked Questions')" />

        @foreach ($faqs as $faq)
            <details class="faq-item">
                <summary class="faq-item__question">
                    <span>{{ __($faq['q']) }}</span>
                    <i class="bi bi-plus-lg faq-item__icon" aria-hidden="true"></i>
                </summary>
                <p class="faq-item__answer">{{ __($faq['a']) }}</p>
            </details>
        @endforeach
    </div>
</section>
