@extends('layouts.app')

@section('content')

<div class="container py-5" data-aos="fade-up">
    <!-- Dashboard Header -->
    <div class="mb-4">
        <h2 style="color: var(--accent);">Welcome, Client!</h2>
    </div>

    <!-- Create Appointment -->
    <div class="card mb-4 shadow-sm p-4" style="border-radius: 12px;">
        <h4 style="color: var(--accent);">Create Grooming Appointment</h4>
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            <!-- Pet & Owner Details -->
            <div class="mb-3">
                <label for="pet_name" class="form-label" style="color: var(--dark-grey);">Pet Name</label>
                <input type="text" name="pet_name" id="pet_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="species" class="form-label" style="color: var(--dark-grey);">Species</label>
                <input type="text" name="species" id="species" class="form-control" placeholder="e.g. Dog, Cat" required>
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label" style="color: var(--dark-grey);">Breed</label>
                <input type="text" name="breed" id="breed" class="form-control">
            </div>
            <div class="mb-3">
                <label for="service_id" class="form-label" style="color: var(--dark-grey);">Service Type</label>
                <select name="service_id" id="service_id" class="form-select" required>
                    @foreach($services as $service) 
                        <option value="{{ $service->id }}">
                            {{ $service->name }} — {{ $service->description }} (₱{{ number_format($service->price, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="scheduled_at" class="form-label" style="color: var(--dark-grey);">Preferred Date & Time</label>
                <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-accent w-100">Book Appointment</button>
        </form>
    </div>

    <!-- Upcoming Appointments -->
    <div class="card mb-4 shadow-sm p-4" style="border-radius: 12px;">
        <h4 style="color: var(--accent);">Upcoming Appointments</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pet</th>
                    <th>Service</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcomingAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->pet->name }}</td>
                        <td>{{ $appointment->service->name }} (₱{{ number_format($appointment->service->price, 2) }})</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y - h:i A') }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning">Update</a>
                            <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No upcoming appointments.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Past Appointments -->
    <div class="card shadow-sm p-4" style="border-radius: 12px;">
        <h4 style="color: var(--accent);">Past Appointments</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pet</th>
                    <th>Service</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pastAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->pet->name }}</td>
                        <td>{{ $appointment->service->name }} (₱{{ number_format($appointment->service->price, 2) }})</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y - h:i A') }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No past appointments.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection