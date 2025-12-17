@extends('layouts.app')

@section('content')

<!-- Hero Banner -->
<section class="hero text-center d-flex flex-column align-items-center justify-content-center"
         style="min-height:25vh; background-color: var(--cream);" data-aos="fade-up">
    <h1 class="mb-2" style="color: var(--accent);">Our Services</h1>
    <p class="fs-6" style="color: var(--accent);">Grooming, spa treatments, and add-ons — all in one glance</p>
</section>

<!-- Services Tables -->
<section class="section text-center py-3" data-aos="zoom-in">
    <div class= "bg-transparent background-0">
        <div class="row g-4 justify-content-center">

            <!-- Core Grooming -->
            <div class="col-md-4">
                <h4 style="color: var(--accent);">Core Grooming</h4>
                <table class="table table-sm table-borderless text-start">
                    <tbody>
                        <tr>
                            <td><strong>Full Groom Package</strong><br><small>Bath, haircut, nail trim, ear cleaning</small></td>
                            <td>₱1,200</td>
                        </tr>
                        <tr>
                            <td><strong>Quick Bath & Brush</strong><br><small>Refresh between full grooms</small></td>
                            <td>₱600</td>
                        </tr>
                        <tr>
                            <td><strong>Pawdicure</strong><br><small>Nail trim with paw balm massage</small></td>
                            <td>₱350</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Specialty Spa -->
            <div class="col-md-4">
                <h4 style="color: var(--accent);">Specialty Spa</h4>
                <table class="table table-sm table-borderless text-start">
                    <tbody>
                        <tr>
                            <td><strong>Deluxe Spa Treatment</strong><br><small>Aromatherapy bath with coat conditioning</small></td>
                            <td>₱1,800</td>
                        </tr>
                        <tr>
                            <td><strong>De‑Shedding Treatment</strong><br><small>Coat thinning and brushing for heavy shedders</small></td>
                            <td>₱950</td>
                        </tr>
                        <tr>
                            <td><strong>Sensitive Skin Care</strong><br><small>Hypoallergenic shampoo with soothing rinse</small></td>
                            <td>₱1,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add-Ons -->
            <div class="col-md-4">
                <h4 style="color: var(--accent);">Add‑Ons</h4>
                <table class="table table-sm table-borderless text-start">
                    <tbody>
                        <tr>
                            <td><strong>Teeth Brushing</strong><br><small>Gentle dental cleaning for fresh breath</small></td>
                            <td>₱250</td>
                        </tr>
                        <tr>
                            <td><strong>Ear Cleaning</strong><br><small>Safe removal of wax and debris</small></td>
                            <td>₱200</td>
                        </tr>
                        <tr>
                            <td><strong>Flea & Tick Treatment</strong><br><small>Protective rinse to eliminate pests</small></td>
                            <td>₱500</td>
                        </tr>
                        <tr>
                            <td><strong>Bow or Bandana Styling</strong><br><small>Playful accessory for a polished look</small></td>
                            <td>₱150</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section text-center py-4" data-aos="fade-up">
    @guest
    <a href="{{ route('login') }}" class="btn btn-danger">Book Now</a>
@endguest

@auth
    <a href="{{ route('appointments.create') }}" class="btn btn-danger">Book Now</a>
@endauth

</section>

@endsection