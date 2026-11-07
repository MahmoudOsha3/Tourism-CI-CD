{{-- Floating search box overlapping the hero. Tabs are driven by config('site.search_tabs'). --}}
@php
    $tabs      = $tabs ?? config('site.search_tabs');
    $activeTab = array_key_exists(request('tab'), $tabs) ? request('tab') : array_key_first($tabs);
@endphp

<section class="search-box" aria-labelledby="searchBoxTitle">
    <div class="container">
        <h2 class="visually-hidden" id="searchBoxTitle">{{ __('Search your trip') }}</h2>

        {{-- Tabs --}}
        <div class="search-box__tabs">
            <div class="search-tabs" role="tablist" aria-label="{{ __('Search type') }}" data-tabs>
                @foreach ($tabs as $key => $tab)
                    <button type="button" role="tab"
                            @class(['search-tab', 'is-active' => $key === $activeTab])
                            id="tab-{{ $key }}" aria-controls="panel-{{ $key }}"
                            aria-selected="{{ $key === $activeTab ? 'true' : 'false' }}"
                            tabindex="{{ $key === $activeTab ? 0 : -1 }}">
                        <i class="bi {{ $tab['icon'] }}" aria-hidden="true"></i>
                        <span>{{ __($tab['label']) }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Panels (one GET form per tab, each posting to its own named route) --}}
        <div class="search-card">
            @foreach ($tabs as $key => $tab)
                <div role="tabpanel" id="panel-{{ $key }}" aria-labelledby="tab-{{ $key }}"
                     @if ($key !== $activeTab) hidden @endif>
                    <x-search-form :tab="$tab" :tab-key="$key" />
                </div>
            @endforeach
        </div>
    </div>
</section>
