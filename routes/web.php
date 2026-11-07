<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (default / placeholder)
|--------------------------------------------------------------------------
| Every route below points to the single default SiteController.
| Later: replace each `page` route with its own controller (ToursController, ...).
| `->defaults('title', ...)` is passed to SiteController@page as $title.
*/

Route::get('/', [SiteController::class, 'home'])->name('home');

// Main pages (placeholders)
Route::get('/tours',     [SiteController::class, 'page'])->name('tours.index')->defaults('title', 'Tours');
Route::get('/hotels',    [SiteController::class, 'page'])->name('hotels.index')->defaults('title', 'Hotels');
Route::get('/flights',   [SiteController::class, 'page'])->name('flights.index')->defaults('title', 'Flights');
Route::get('/visa',      [SiteController::class, 'page'])->name('visa.index')->defaults('title', 'Visa Services');
Route::get('/transfers', [SiteController::class, 'page'])->name('transfers.index')->defaults('title', 'Transfers');
Route::get('/packages',  [SiteController::class, 'page'])->name('packages.index')->defaults('title', 'Holiday Packages');
Route::get('/contact',   [SiteController::class, 'page'])->name('contact')->defaults('title', 'Contact Us');
Route::get('/booking',   [SiteController::class, 'page'])->name('booking.create')->defaults('title', 'Book Now');

// Destinations
Route::get('/destinations',         [SiteController::class, 'destinations'])->name('destinations.index');
Route::get('/destinations/{slug}',  [SiteController::class, 'destination'])->name('destinations.show');

// Static pages
Route::get('/privacy-policy',       [SiteController::class, 'page'])->name('pages.privacy')->defaults('title', 'Privacy Policy');
Route::get('/terms-and-conditions', [SiteController::class, 'page'])->name('pages.terms')->defaults('title', 'Terms & Conditions');

// Newsletter + language switch
Route::post('/newsletter',        [SiteController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/language/{locale}',  [SiteController::class, 'switchLocale'])->name('locale.switch');
