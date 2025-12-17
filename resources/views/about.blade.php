@extends('layouts.app')

@section('content')

<!-- Hero Banner -->
<section class="hero text-center d-flex flex-column align-items-center justify-content-center"
         style="min-height:50vh;
                background-color: var(--cream);
                background-size: 200px;"
         data-aos="fade-up">
    <h1 class="mb-3" style="color: var(--accent);" data-aos="fade-up">
        About Pawfect Care Pet Grooming Spa
    </h1>
    <p class="fs-5" style="color: var(--accent);" data-aos="fade-up" data-aos-delay="200">
        More than grooming — it’s an act of love.
    </p>
</section>

<!-- Filler Strip -->
<div class="text-center my-5" data-aos="zoom-in">
    <img src="{{ asset('images/filler.png') }}" alt="Cute pet icon" class="img-fluid rounded"
         style="max-width: 200px;">
</div>

<!-- Mission Section -->
<section class="section section-light text-center" data-aos="fade-up">
    <h2>Our Mission</h2>
    <p>
        At Pawfect Care Pet Grooming Spa, we believe grooming is more than a routine — it’s an act of love. 
        Our mission is to create a calm, welcoming space where pets feel safe and owners feel confident. 
        Every wag, purr, and cuddle deserves the best care.
    </p>
</section>

<!-- Founder Section -->
<section class="section" style="background-color: var(--dark-grey);" data-aos="fade-up">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5">
            <h2 class="text-start" style="color: var(--accent);">Meet Our Founder</h2>
            <div class="divider my-3"></div>
            <p style="color: var(--cream);">
                Founded by lifelong pet lover <strong>Taylor Allison</strong>, Pawfect Care combines skill with compassion. 
                Taylor's vision was to create a spa where pets are treated like family, with thoughtful touches 
                like paw balm massages, aromatherapy baths, and playful styling accessories.
            </p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/owner.png') }}" alt="Founder Taylor Allison" class="img-fluid rounded shadow">
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section section-dark text-center" data-aos="fade-up">
    <h2>Our Grooming Team</h2>
    <p>
        Our certified groomers bring years of experience and a gentle touch. 
        Each appointment is tailored to your pet’s unique needs, ensuring they leave looking fabulous and feeling relaxed.
    </p>
    <div class="row g-4 justify-content-center mt-4">
        <div class="col-md-3">
            <img src="{{ asset('images/groomer1.jpg') }}" alt="Groomer 1" class="img-fluid rounded shadow mb-2">
            <p><strong>Ana</strong> — Specialist in small breeds</p>
        </div>
        <div class="col-md-3">
            <img src="{{ asset('images/groomer2.jpg') }}" alt="Groomer 2" class="img-fluid rounded shadow mb-2">
            <p><strong>Jana</strong> — Expert in coat styling</p>
        </div>
        <div class="col-md-3">
            <img src="{{ asset('images/groomer3.jpg') }}" alt="Groomer 3" class="img-fluid rounded shadow mb-2">
            <p><strong>Mike</strong> — Gentle with senior pets</p>
    </div>
</section>

<!-- Call to Action -->
<section class="section text-center" data-aos="fade-up">
    <h2>Ready for a Pawfect Spa Day?</h2>
    <a href="/appointments/create" class="btn btn-accent btn-lg mt-3">Book Now</a>
</section>

@endsection