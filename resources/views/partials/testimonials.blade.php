{{-- Customer reviews. Requires $testimonials (objects with name, country, rating, text). Hidden when empty. --}}
@if (! empty($testimonials) && count($testimonials))
    <section class="section testimonials" id="testimonials" aria-labelledby="testimonialsTitle">
        <div class="container">
            <x-section-heading id="testimonialsTitle" :title="__('What Our Travelers Say')" />

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($testimonials as $testimonial)
                    <div class="col">
                        <x-testimonial-card :testimonial="$testimonial" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
