{{-- Popular destinations carousel. Requires $destinations (iterable of Eloquent models). --}}
@push('vendor-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.1.14/swiper-bundle.min.css">
@endpush

@push('vendor-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11.1.14/swiper-bundle.min.js" defer></script>
@endpush

<section class="section destinations" id="destinations" aria-labelledby="destinationsTitle">
    <div class="container">
        <x-section-heading id="destinationsTitle" :title="__('Popular Destinations')">
            <a class="link-arrow" href="{{ route('destinations.index') }}">
                {{ __('View all destinations') }}
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </x-section-heading>

        @if (count($destinations))
            <div class="destination-slider">
                <div class="swiper destination-swiper" data-destination-slider
                     aria-label="{{ __('Popular destinations') }}">
                    <div class="swiper-wrapper">
                        @foreach ($destinations as $destination)
                            <div class="swiper-slide">
                                <x-destination-card :destination="$destination" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="slider-arrow slider-arrow--prev" data-slider-prev
                        aria-label="{{ __('Previous destinations') }}">
                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                </button>
                <button type="button" class="slider-arrow slider-arrow--next" data-slider-next
                        aria-label="{{ __('Next destinations') }}">
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        @else
            <p class="text-center text-secondary py-5">{{ __('New destinations are coming soon.') }}</p>
        @endif
    </div>
</section>
