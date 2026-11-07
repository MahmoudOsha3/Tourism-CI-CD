{{--
    Reusable search form.
    Props: $tab (array from config('site.search_tabs')), $tabKey (unique suffix for ids).
    Submits via GET with: destination, check_in, check_out, guests, rooms.
--}}
@props(['tab', 'tabKey'])

@php
    $guests = max(1, (int) request('guests', 2));
    $rooms  = max(1, (int) request('rooms', 1));
@endphp

<form class="search-form" action="{{ route($tab['route']) }}" method="GET" role="search" data-search-form>

    {{-- Destination --}}
    <div class="search-field">
        <label class="search-field__label" for="destination-{{ $tabKey }}">{{ __($tab['destination_label']) }}</label>
        <div class="search-field__control">
            <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
            <input type="search" class="form-control search-field__input" id="destination-{{ $tabKey }}"
                   name="destination" value="{{ old('destination', request('destination')) }}"
                   placeholder="{{ __($tab['placeholder']) }}" autocomplete="off">
        </div>
    </div>

    {{-- Date from --}}
    <div class="search-field">
        <label class="search-field__label" for="date-from-{{ $tabKey }}">{{ __($tab['from_label']) }}</label>
        <div class="search-field__control">
            <i class="bi bi-calendar-event" aria-hidden="true"></i>
            <input type="date" class="form-control search-field__input" id="date-from-{{ $tabKey }}"
                   name="check_in" value="{{ old('check_in', request('check_in')) }}"
                   min="{{ now()->toDateString() }}" data-date-from>
        </div>
    </div>

    {{-- Date to --}}
    <div class="search-field">
        <label class="search-field__label" for="date-to-{{ $tabKey }}">{{ __($tab['to_label']) }}</label>
        <div class="search-field__control">
            <i class="bi bi-calendar-event" aria-hidden="true"></i>
            <input type="date" class="form-control search-field__input" id="date-to-{{ $tabKey }}"
                   name="check_out" value="{{ old('check_out', request('check_out')) }}"
                   min="{{ now()->toDateString() }}" data-date-to>
        </div>
    </div>

    {{-- Guests & rooms --}}
    <div class="search-field search-field--guests" data-dropdown data-guest-picker
         data-label-guest-one="{{ __('Guest') }}" data-label-guest-many="{{ __('Guests') }}"
         data-label-room-one="{{ __('Room') }}" data-label-room-many="{{ __('Rooms') }}">

        <span class="search-field__label" id="guests-label-{{ $tabKey }}">
            {{ $tab['show_rooms'] ? __('Guests & Rooms') : __('Guests') }}
        </span>

        <button type="button" class="search-field__control search-field__toggle" data-dropdown-toggle
                aria-haspopup="true" aria-expanded="false" aria-controls="guests-menu-{{ $tabKey }}"
                aria-labelledby="guests-label-{{ $tabKey }} guests-summary-{{ $tabKey }}">
            <i class="bi bi-person-fill" aria-hidden="true"></i>
            <span id="guests-summary-{{ $tabKey }}" data-guest-summary>
                {{ $guests }} {{ $guests === 1 ? __('Guest') : __('Guests') }}@if ($tab['show_rooms']), {{ $rooms }} {{ $rooms === 1 ? __('Room') : __('Rooms') }}@endif
            </span>
            <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
        </button>

        <div class="guest-menu" id="guests-menu-{{ $tabKey }}" data-dropdown-menu hidden>
            <div class="guest-menu__row">
                <label for="guests-{{ $tabKey }}">{{ __('Guests') }}</label>
                <div class="stepper">
                    <button type="button" class="stepper__btn" data-step="-1" aria-label="{{ __('Fewer guests') }}">
                        <i class="bi bi-dash-lg" aria-hidden="true"></i>
                    </button>
                    <input type="number" class="stepper__input" id="guests-{{ $tabKey }}" name="guests"
                           value="{{ $guests }}" min="1" max="20" inputmode="numeric" data-guest-input>
                    <button type="button" class="stepper__btn" data-step="1" aria-label="{{ __('More guests') }}">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            @if ($tab['show_rooms'])
                <div class="guest-menu__row">
                    <label for="rooms-{{ $tabKey }}">{{ __('Rooms') }}</label>
                    <div class="stepper">
                        <button type="button" class="stepper__btn" data-step="-1" aria-label="{{ __('Fewer rooms') }}">
                            <i class="bi bi-dash-lg" aria-hidden="true"></i>
                        </button>
                        <input type="number" class="stepper__input" id="rooms-{{ $tabKey }}" name="rooms"
                               value="{{ $rooms }}" min="1" max="10" inputmode="numeric" data-room-input>
                        <button type="button" class="stepper__btn" data-step="1" aria-label="{{ __('More rooms') }}">
                            <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-site btn-lg search-form__submit">
        <i class="bi bi-search" aria-hidden="true"></i>
        {{ __('Search') }}
    </button>
</form>
