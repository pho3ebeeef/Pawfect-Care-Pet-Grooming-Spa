@extends('layouts.app')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <!-- Dashboard Header -->
    <div class="mb-4">
        <h2 style="color: var(--accent);">Welcome, Groomer!</h2>
        <p class="text-muted">Manage your assigned appointments below.</p>
    </div>

    <!-- Assigned Appointments -->
    <div class="card shadow-sm p-4" style="border-radius: 12px;">
        <h4 style="color: var(--accent);">Assigned Appointments</h4>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Pet</th>
                    <th>Breed</th>
                    <th>Owner</th>
                    <th>Service</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->pet_name }}</td>
                        <td>{{ $appointment->breed }}</td>
                        <td>{{ $appointment->client->full_name ?? 'N/A' }}</td>
                        <td>{{ $appointment->service->name }} (₱{{ $appointment->service->price }})</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y - h:i A') }}</td>
                        <td>
                            <!-- Status update form -->
                            <form method="POST" action="{{ route('groomer.updateStatus', $appointment->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in-progress" {{ $appointment->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="no-show" {{ $appointment->status == 'no-show' ? 'selected' : '' }}>No Show</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <!-- Notes update form -->
                            <form method="POST" action="{{ route('groomer.updateNotes', $appointment->id) }}">
                                @csrf
                                @method('PATCH')
                                <textarea name="notes" class="form-control form-control-sm" rows="2">{{ $appointment->admin_notes }}</textarea>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Save</button>
                            </form>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($appointment->status) }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No assigned appointments.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection