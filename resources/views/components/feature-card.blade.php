{{-- Horizontal feature card. Props: icon (Bootstrap Icons class), title, text, href --}}
@props(['icon', 'title', 'text', 'href' => null])

<{{ $href ? 'a' : 'div' }} {{ $attributes->class(['feature-card'])->merge($href ? ['href' => $href] : []) }}>
    <i class="bi {{ $icon }} feature-card__icon" aria-hidden="true"></i>
    <div>
        <h3 class="feature-card__title">{{ $title }}</h3>
        <p class="feature-card__text">{{ $text }}</p>
    </div>
</{{ $href ? 'a' : 'div' }}>
