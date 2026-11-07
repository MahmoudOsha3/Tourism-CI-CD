<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

/**
 * Default controller – one place for every route while the project is being set up.
 * Split it into dedicated controllers later.
 */
class SiteController extends Controller
{
    public function home(): View
    {
        $destinations = $this->destinationList();

        return view('home', [
            'destinations'       => $destinations,
            'footerDestinations' => $destinations,
            'testimonials'       => $this->testimonialList(),
        ]);
    }

    /** Generic placeholder page used by routes that don't have a real view yet. */
    public function page(string $title): View
    {
        return view('pages.placeholder', [
            'title'              => $title,
            'footerDestinations' => $this->destinationList(),
        ]);
    }

    public function destinations(): View
    {
        return view('pages.placeholder', [
            'title'              => 'All Destinations',
            'footerDestinations' => $this->destinationList(),
        ]);
    }

    public function destination(string $slug): View
    {
        $destination = $this->destinationList()->firstWhere('slug', $slug);
        abort_if(! $destination, 404);

        return view('pages.placeholder', [
            'title'              => $destination->name,
            'footerDestinations' => $this->destinationList(),
        ]);
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email:rfc', 'max:255']]);

        // TODO: store the subscriber (model / mailing provider).

        return back()->with('newsletter_status', __('Thank you for subscribing!'));
    }

    public function switchLocale(string $locale): RedirectResponse
    {
        abort_unless(array_key_exists($locale, config('site.languages')), 404);

        session(['locale' => $locale]);   // apply it with a small middleware: app()->setLocale(session('locale'))

        return back();
    }

    /**
     * Temporary in-memory data.
     * TODO: replace with  Destination::query()->latest()->get();
     */
    private function destinationList(): Collection
    {
        $items = [
            ['name' => 'Egypt',                'slug' => 'egypt',  'price' => 280, 'image' => 'assets/images/destinations/pyrmaids.jpg',  'description' => 'Pyramids, the Nile, and the Red Sea.'],
            ['name' => 'United Arab Emirates', 'slug' => 'uae',    'price' => 620, 'image' => 'assets/images/destinations/khalife.jpg',    'description' => 'Luxury, desert, and modern cities.'],
            ['name' => 'Turkey',               'slug' => 'turkey', 'price' => 450, 'image' => 'assets/images/destinations/turkey.jpg', 'description' => 'Where Europe meets Asia.'],
            ['name' => 'France',               'slug' => 'france', 'price' => 550, 'image' => 'assets/images/destinations/paris.webp', 'description' => 'Art, cuisine, and iconic landmarks.'],
        ];

        return collect($items)->map(fn (array $item) => new Destination($item));
    }

    /**
     * SAMPLE DATA ONLY – replace with real customer reviews (e.g. Testimonial::approved()->latest()->take(3)->get()).
     * Do not publish placeholder reviews on a live site.
     */
    private function testimonialList(): Collection
    {
        return collect([
            ['name' => 'Sample Customer 1', 'country' => 'Germany',        'rating' => 5, 'text' => 'Replace this text with a real customer review.'],
            ['name' => 'Sample Customer 2', 'country' => 'United Kingdom', 'rating' => 5, 'text' => 'Replace this text with a real customer review.'],
            ['name' => 'Sample Customer 3', 'country' => 'Saudi Arabia',   'rating' => 4, 'text' => 'Replace this text with a real customer review.'],
        ])->map(fn (array $item) => (object) $item);
    }
}
