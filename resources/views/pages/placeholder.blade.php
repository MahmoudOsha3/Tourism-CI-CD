@extends('layouts.app')

@section('title', $title . ' | ' . config('site.name'))

@section('content')
    <section class="section">
        <div class="container py-5 text-center">
            <h1 class="section-heading__title">{{ __($title) }}</h1>
            <p class="text-secondary mt-3">{{ __('This page is coming soon.') }}</p>
            <a class="btn btn-site mt-3" href="{{ route('home') }}">{{ __('Back to home') }}</a>
        </div>
    </section>
@endsection
