{{-- Section title with gold underline bar. Optional slot = action link on the right. --}}
@props(['title', 'id' => null])

<div {{ $attributes->class(['section-heading']) }}>
    <div>
        <h2 class="section-heading__title" @if ($id) id="{{ $id }}" @endif>{{ $title }}</h2>
        <span class="section-heading__bar" aria-hidden="true"></span>
    </div>

    @if (! $slot->isEmpty())
        <div class="section-heading__action">{{ $slot }}</div>
    @endif
</div>
