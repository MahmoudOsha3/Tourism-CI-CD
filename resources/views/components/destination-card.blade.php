{{--
    Destination card bound to an Eloquent model.
    Expects: $destination->name, ->image, ->price, ->description (+ route-model binding key for the show route).
    If you store images on the public disk, swap asset(...) for Storage::url(...) or an accessor like ->image_url.
--}}
@props(['destination'])

<article {{ $attributes->class(['destination-card']) }}>
    <figure class="destination-card__media">
        <img class="destination-card__img" src="{{ asset($destination->image) }}"
             alt="{{ $destination->name }}" width="640" height="480" loading="lazy" decoding="async">
    </figure>

    <div class="destination-card__body">
        <h3 class="destination-card__title">{{ $destination->name }}</h3>
        <p class="destination-card__text">{{ $destination->description }}</p>

        <div class="destination-card__footer">
            <p class="destination-card__price">
                <span class="destination-card__from">{{ __('From') }}</span>
                <strong>{{ config('site.currency_symbol') }}{{ number_format($destination->price) }}</strong>
            </p>

            <a class="btn btn-site-dark" href="{{ route('destinations.show', $destination) }}"
               aria-label="{{ __('View details for :name', ['name' => $destination->name]) }}">
                {{ __('View Details') }}
            </a>
        </div>
    </div>
</article>
