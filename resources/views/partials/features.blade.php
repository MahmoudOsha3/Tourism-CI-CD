{{-- Features row. Pass $features to override config('site.features'). --}}
@php
    $features = $features ?? config('site.features');
@endphp

<section class="section features" id="features" aria-labelledby="featuresTitle">
    <div class="container">
        <x-section-heading id="featuresTitle" :title="__('Our Features')" />

        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 g-3">
            @foreach ($features as $feature)
                <div class="col">
                    <x-feature-card :icon="$feature['icon']"
                                    :title="__($feature['title'])"
                                    :text="__($feature['text'])"
                                    :href="route($feature['route'])" />
                </div>
            @endforeach
        </div>
    </div>
</section>
