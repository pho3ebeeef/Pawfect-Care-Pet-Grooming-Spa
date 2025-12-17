@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="hero text-center d-flex flex-column align-items-center justify-content-center"
         style="min-height:70vh;
                background-color: var(--dark-grey);
                background-image: url('{{ asset('images/logo 2.png') }}');
                background-repeat: repeat;
                background-position: center;
                background-size: 300px;"
         data-aos="fade-up">
    <h1 class="text-light mb-3" data-aos="fade-up">Gentle Grooming, Happy Pets, Pawfect Care.</h1>
    <p class="fs-5" style="color: var(--cream);" data-aos="fade-up" data-aos-delay="200">
        Because every wag, purr, and cuddle deserves the best.
    </p>
    <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
        @auth
            @if(auth()->user()->role === 'client')
                <!-- Logged-in Client → go to Client Dashboard -->
                <a href="/client" class="btn btn-accent btn-lg me-2">Book Appointment</a>
            @elseif(auth()->user()->role === 'groomer')
                <!-- Groomer → go to Groomer Dashboard -->
                <a href="/groomer" class="btn btn-accent btn-lg me-2">View Appointments</a>
            @elseif(auth()->user()->role === 'admin')
                <!-- Admin/Reception → go to Admin Dashboard -->
                <a href="/admin" class="btn btn-accent btn-lg me-2">Manage Appointments</a>
            @else
                <!-- Fallback for other roles -->
                <a href="{{ route('login') }}" class="btn btn-accent btn-lg me-2">Book Appointment</a>
            @endif
        @else
            <!-- Not logged in → redirect to Sign In -->
            <a href="{{ route('login') }}" class="btn btn-accent btn-lg me-2">Book Appointment</a>
        @endauth

    </div>
</section>

<!-- Services Section -->
<section class="section text-center" data-aos="fade-up">
    <h2>Our Services</h2>
    <div class="row g-4 justify-content-center">

        <!-- Core Grooming Card -->
        <div class="col-md-4" data-aos="zoom-in">
            <div class="card p-3 bg-transparent background-0">
                <h5 class="mb-3">Core Grooming</h5>
                <p class="service-desc">Bath, haircut, nail trim, and ear cleaning — the essentials for a fresh, happy pet.</p>
                <img src="{{ asset('images/core-grooming.jpg') }}" alt="Core Grooming" class="img-fluid rounded">
            </div>
        </div>

        <!-- Specialty Spa Treatments Card -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="card p-3 bg-transparent background-0">
                <h5 class="mb-3">Specialty Spa Treatments</h5>
                  <p class="service-desc">Aromatherapy baths, coat conditioning, and soothing treatments for sensitive skin or heavy shedders.</p>
                <img src="{{ asset('images/spa.jpg') }}" alt="Spa Treatments" class="img-fluid rounded">
            </div>
        </div>

        <!-- Add-Ons Card -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="card p-3 bg-transparent background-0">
                <h5 class="mb-3">Add-Ons</h5>
                <p class="service-desc">Extra touches like nail trims, paw balm massages, bows, and playful styling accessories.</p>
                <img src="{{ asset('images/haircut.jpg') }}" alt="Add-Ons" class="img-fluid rounded">
            </div>
        </div>

    </div>

    <a href="/services" class="btn btn-accent mt-4">View All Services</a>
</section>

<!-- Filler Image -->
<div class="text-center my-5" data-aos="zoom-in">
    <img src="{{ asset('images/icon.png') }}" alt="Cute pet" class="img-fluid rounded" 
    style="max-width: 50px;" >
</div>

<!-- About teaser -->
<section class="section section-light text-center" data-aos="fade-up">
    <h2>About Us</h2>
    <p>At Pawfect Care Pet Grooming Spa, we believe grooming is more than a routine — it’s an act of love. Founded by pet enthusiast Taylor Allison, our mission is to create a calm, welcoming space where pets feel safe and owners feel confident.
Our certified groomers combine skill with compassion, offering services from full grooming packages to specialty spa treatments for sensitive skin or heavy shedders. Every visit is tailored to your pet’s unique needs, with thoughtful touches like paw balm massages, aromatherapy baths, and playful styling accessories.
What sets us apart is our commitment to community and connection. We keep detailed notes after each appointment, ensuring personalized care every time. Whether it’s a puppy’s first trim or a senior cat’s gentle spa day, Pawfect Care makes the experience easy, enjoyable, and pawfectly tailored to your furry family.</p>
    <a href="/about" class="btn btn-outline-accent">Learn More</a>
</section>

@endsection