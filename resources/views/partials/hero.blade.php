{{-- Hero: full-width background image with overlay. Pass a $hero array to override any key. --}}
@php
    $hero = array_merge([
        'image'    => asset('assets/images/destinations/background.avif'),
        'eyebrow'  => __('Explore The Magic Of'),
        'title'    => __('EGYPT'),
        'text'     => __('Book your flights, hotels, and tours in minutes and make your trip unforgettable.'),
        'cta_text' => null,
        'cta_url'  => null,
    ], $hero ?? []);
@endphp

{{-- LCP: preload the hero image so the browser fetches it with top priority --}}
@push('head')
    <link rel="preload" as="image" href="{{ $hero['image'] }}" fetchpriority="high">
@endpush

<section class="hero" aria-labelledby="heroTitle">
    <img class="hero__media" src="{{ $hero['image'] }}" width="1920" height="760" alt=""
         fetchpriority="high" decoding="async">

    <div class="container hero__content">
        <i class="bi bi-airplane-fill hero__icon" aria-hidden="true"></i>

        <h1 class="hero__heading" id="heroTitle">
            <span class="hero__eyebrow">{{ $hero['eyebrow'] }}</span>
            <span class="hero__title">{{ $hero['title'] }}</span>
        </h1>

        <p class="hero__text">{{ $hero['text'] }}</p>

        @if ($hero['cta_url'] && $hero['cta_text'])
            <a class="btn btn-site btn-lg" href="{{ $hero['cta_url'] }}">{{ $hero['cta_text'] }}</a>
        @endif
    </div>
</section>
