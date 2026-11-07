{{-- Why choose us: reasons + key figures. Data comes from config('site.why_us'). --}}
@php
    $whyUs = $whyUs ?? config('site.why_us');
@endphp

<section class="section why-us" id="why-us" aria-labelledby="whyUsTitle">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-4">
                <h2 class="why-us__title" id="whyUsTitle">{{ __('Why Travel With Us') }}</h2>
                <span class="section-heading__bar" aria-hidden="true"></span>
                <p class="why-us__lead">{{ __('Everything you need for a smooth trip to Egypt, handled by people who live here.') }}</p>
            </div>

            <div class="col-lg-8">
                <ul class="row row-cols-1 row-cols-md-2 g-4 list-unstyled mb-0">
                    @foreach ($whyUs['reasons'] as $reason)
                        <li class="col">
                            <div class="why-us__reason">
                                <i class="bi {{ $reason['icon'] }} why-us__icon" aria-hidden="true"></i>
                                <div>
                                    <h3 class="why-us__reason-title">{{ __($reason['title']) }}</h3>
                                    <p class="why-us__reason-text">{{ __($reason['text']) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <dl class="why-us__stats row row-cols-2 row-cols-md-4 g-3 mb-0">
            @foreach ($whyUs['stats'] as $stat)
                <div class="col">
                    <div class="why-us__stat">
                        <dt class="why-us__stat-label">{{ __($stat['label']) }}</dt>
                        <dd class="why-us__stat-value">{{ $stat['value'] }}</dd>
                    </div>
                </div>
            @endforeach
        </dl>
    </div>
</section>
