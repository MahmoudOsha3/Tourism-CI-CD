@extends('layouts.app')

@section('title', config('site.name') . ' | ' . __('Flights, Hotels, Tours & Visa Services in Egypt'))

@section('content')

    @include('partials.hero')

    @include('partials.search-box')

    @include('partials.features')

    @include('partials.destinations')

    @include('partials.why-us')

    @include('partials.testimonials')

    @include('partials.faq')

    @include('partials.cta-banner')

@endsection
