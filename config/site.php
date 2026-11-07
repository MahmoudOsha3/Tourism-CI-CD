<?php

/**
 * Site-wide presentation data used by the header, footer and homepage partials.
 * Keeps contact info / navigation in ONE place (DRY) and out of the Blade templates.
 * Every `route` value is a named route (see the example routes in the notes).
 */
return [

    'name'            => env('APP_NAME', 'AL-GEWAR Travel & Tourism'),
    'tagline'         => 'Your trusted travel partner in Egypt. We make your journeys unforgettable.',
    'currency_symbol' => '$',

    'phone'      => '+20 100 123 4567',
    'phone_link' => '+201001234567',
    'email'      => 'info@al-gewar.com',
    'address'    => '12 El Tahrir St., Dokki, Giza, Egypt',

    // code => label (flag SVGs live in public/assets/images/flags/{code}.svg)
    'languages' => [
        'en' => 'English',
        'fr' => 'Français',
        'de' => 'Deutsch',
        'ru' => 'Русский',
    ],

    // Primary navigation (header + mobile menu). `active` is a routeIs() pattern.
    'nav' => [
        ['label' => 'Home',          'route' => 'home',            'active' => 'home'],
        ['label' => 'Tours',         'route' => 'tours.index',     'active' => 'tours.*'],
        ['label' => 'Hotels',        'route' => 'hotels.index',    'active' => 'hotels.*'],
        ['label' => 'Flights',       'route' => 'flights.index',   'active' => 'flights.*'],
        ['label' => 'Visa Services', 'route' => 'visa.index',      'active' => 'visa.*'],
        ['label' => 'Transfers',     'route' => 'transfers.index', 'active' => 'transfers.*'],
        ['label' => 'Contact Us',    'route' => 'contact',         'active' => 'contact'],
    ],

    'book_now_route' => 'booking.create',

    // Search box tabs. One <form> is rendered per tab (see components/search-form).
    'search_tabs' => [
        'hotels' => [
            'label' => 'Hotels', 'icon' => 'bi-buildings-fill', 'route' => 'hotels.index',
            'destination_label' => 'Destination', 'placeholder' => 'Where are you going?',
            'from_label' => 'Check-in', 'to_label' => 'Check-out', 'show_rooms' => true,
        ],
        'flights' => [
            'label' => 'Flights', 'icon' => 'bi-airplane-fill', 'route' => 'flights.index',
            'destination_label' => 'Flying to', 'placeholder' => 'Where are you flying?',
            'from_label' => 'Departure', 'to_label' => 'Return', 'show_rooms' => false,
        ],
        'tours' => [
            'label' => 'Tours', 'icon' => 'bi-geo-alt-fill', 'route' => 'tours.index',
            'destination_label' => 'Destination', 'placeholder' => 'Which city or attraction?',
            'from_label' => 'From', 'to_label' => 'To', 'show_rooms' => false,
        ],
        'transfers' => [
            'label' => 'Transfers', 'icon' => 'bi-car-front-fill', 'route' => 'transfers.index',
            'destination_label' => 'Pick-up', 'placeholder' => 'Airport, hotel or address',
            'from_label' => 'Pick-up date', 'to_label' => 'Return date', 'show_rooms' => false,
        ],
    ],

    'features' => [
        ['icon' => 'bi-buildings',    'title' => 'Hotel Booking',     'text' => 'Best hotels at the best prices', 'route' => 'hotels.index'],
        ['icon' => 'bi-airplane',     'title' => 'Flight Booking',    'text' => 'Domestic & International',       'route' => 'flights.index'],
        ['icon' => 'bi-car-front',    'title' => 'Airport Transfers', 'text' => 'Comfortable & Safe Transfers',   'route' => 'transfers.index'],
        ['icon' => 'bi-person-vcard', 'title' => 'Visa Services',     'text' => 'Visa & Security Approvals',      'route' => 'visa.index'],
        ['icon' => 'bi-camera',       'title' => 'Daily Tours',       'text' => 'Amazing Egypt Experiences',      'route' => 'tours.index'],
        ['icon' => 'bi-suitcase-lg',  'title' => 'Holiday Packages',  'text' => 'Customizable Packages',          'route' => 'packages.index'],
    ],

    'benefits' => [
        ['icon' => 'bi-clock-history', 'title' => '24/7 Online Booking',   'text' => 'Book anytime, anywhere'],
        ['icon' => 'bi-tag',           'title' => 'Best Price Guarantee',  'text' => 'We offer the best prices'],
        ['icon' => 'bi-shield-check',  'title' => 'Instant Confirmation',  'text' => 'Get confirmation instantly'],
        ['icon' => 'bi-lock',          'title' => 'Secure Payment',        'text' => 'Your payment is 100% safe'],
        ['icon' => 'bi-headset',       'title' => '24/7 Customer Support', 'text' => 'We are here to help you'],
    ],

    // Footer "Quick Links" (rendered in two CSS columns)
    'quick_links' => [
        ['label' => 'Home',             'route' => 'home'],
        ['label' => 'Tours',            'route' => 'tours.index'],
        ['label' => 'Transfers',        'route' => 'transfers.index'],
        ['label' => 'Flights',          'route' => 'flights.index'],
        ['label' => 'Visa Services',    'route' => 'visa.index'],
        ['label' => 'Holiday Packages', 'route' => 'packages.index'],
        ['label' => 'Hotels',           'route' => 'hotels.index'],
        ['label' => 'Contact Us',       'route' => 'contact'],
    ],

    'socials' => [
        ['label' => 'Facebook',  'icon' => 'bi-facebook',  'url' => 'https://facebook.com/'],
        ['label' => 'Instagram', 'icon' => 'bi-instagram', 'url' => 'https://instagram.com/'],
        ['label' => 'WhatsApp',  'icon' => 'bi-whatsapp',  'url' => 'https://wa.me/201001234567'],
        ['label' => 'YouTube',   'icon' => 'bi-youtube',   'url' => 'https://youtube.com/'],
    ],

    // public/assets/images/payments/{name}.svg
    'payments' => ['visa', 'mastercard', 'meeza'],

    // ---- Why choose us (replace the numbers with your real figures) ----
    'why_us' => [
        'reasons' => [
            ['icon' => 'bi-patch-check', 'title' => 'Licensed Local Experts', 'text' => 'Egyptian travel specialists who know every destination first-hand.'],
            ['icon' => 'bi-cash-coin',   'title' => 'Transparent Prices',     'text' => 'No hidden fees. What you see at booking is what you pay.'],
            ['icon' => 'bi-lightning',   'title' => 'Fast Confirmation',      'text' => 'Most bookings are confirmed within minutes.'],
            ['icon' => 'bi-headset',     'title' => 'Support On The Ground',  'text' => 'A real person on call before, during and after your trip.'],
        ],
        'stats' => [
            ['value' => '10K+', 'label' => 'Happy travelers'],
            ['value' => '150+', 'label' => 'Tours & packages'],
            ['value' => '300+', 'label' => 'Partner hotels'],
            ['value' => '12',   'label' => 'Years of experience'],
        ],
    ],

    // ---- FAQ ----
    'faqs' => [
        ['q' => 'How do I book a tour or hotel?',            'a' => 'Use the search box at the top of the page, choose your dates and send your request. Our team confirms availability and your final price.'],
        ['q' => 'Can I get a visa through you?',             'a' => 'Yes. Open the Visa Services page, submit your details and we guide you through the approval steps for your nationality.'],
        ['q' => 'Do you offer airport pick-up?',             'a' => 'Yes. Airport transfers are available in all major cities, with a driver waiting at arrivals.'],
        ['q' => 'What is your cancellation policy?',         'a' => 'Cancellation terms depend on the hotel or tour provider. They are shown clearly before you confirm any booking.'],
        ['q' => 'Which payment methods do you accept?',      'a' => 'We accept major credit and debit cards through a secure payment page.'],
    ],

    'whatsapp_url' => 'https://wa.me/201001234567',
];
