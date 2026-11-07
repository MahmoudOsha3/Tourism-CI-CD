{{-- Review card. Expects $testimonial->name, ->country, ->rating (1-5), ->text --}}
@props(['testimonial'])

<figure {{ $attributes->class(['testimonial-card']) }}>
    <div class="testimonial-card__stars" role="img"
         aria-label="{{ __(':rating out of 5 stars', ['rating' => $testimonial->rating]) }}">
        @for ($i = 1; $i <= 5; $i++)
            <i class="bi {{ $i <= $testimonial->rating ? 'bi-star-fill' : 'bi-star' }}" aria-hidden="true"></i>
        @endfor
    </div>

    <blockquote class="testimonial-card__text">{{ $testimonial->text }}</blockquote>

    <figcaption class="testimonial-card__author">
        <span class="testimonial-card__avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($testimonial->name, 0, 1)) }}</span>
        <span>
            <strong class="d-block">{{ $testimonial->name }}</strong>
            <span class="testimonial-card__country">{{ $testimonial->country }}</span>
        </span>
    </figcaption>
</figure>
