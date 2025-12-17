@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 style="color: var(--accent);">Edit Appointment</h2>
    <p class="text-muted">Update the details of this appointment below.</p>

    <div class="card shadow-sm p-4" style="border-radius: 12px;">
        <form method="POST" action="{{ route('admin.appointments.update', $appointment->id) }}">
            @csrf
            @method('PUT')

            <!-- Client -->
            <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select name="client_id" id="client_id" class="form-select" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $appointment->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pet -->
            <div class="mb-3">
                <label for="pet_id" class="form-label">Pet</label>
                <select name="pet_id" id="pet_id" class="form-select" required>
                    @foreach($clients as $client)
                        @foreach($client->pets as $pet)
                            <option value="{{ $pet->id }}" {{ $appointment->pet_id == $pet->id ? 'selected' : '' }}>
                                {{ $pet->name }} ({{ $pet->breed }}) — Owner: {{ $client->full_name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <!-- Service -->
            <div class="mb-3">
                <label for="service_id" class="form-label">Service</label>
                <select name="service_id" id="service_id" class="form-select" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} (₱{{ $service->price }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Groomer -->
            <div class="mb-3">
                <label for="groomer_id" class="form-label">Assign Groomer (optional)</label>
                <select name="groomer_id" id="groomer_id" class="form-select">
                    <option value="">-- No Groomer Assigned --</option>
                    @foreach($groomers as $groomer)
                        <option value="{{ $groomer->id }}" {{ $appointment->groomer_id == $groomer->id ? 'selected' : '' }}>
                            {{ $groomer->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date/Time -->
            <div class="mb-3">
                <label for="scheduled_at" class="form-label">Date & Time</label>
                <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control"
                       value="{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ $appointment->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="no-show" {{ $appointment->status == 'no-show' ? 'selected' : '' }}>No Show</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="admin_notes" class="form-label">Admin Notes</label>
                <textarea name="admin_notes" id="admin_notes" class="form-control" rows="3">{{ $appointment->admin_notes }}</textarea>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Update Appointment</button>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection