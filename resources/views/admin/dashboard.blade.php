@extends('layouts.app')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <!-- Dashboard Header -->
    <div class="mb-4">
        <h2 style="color: var(--accent);">Admin Dashboard</h2>
        <p class="text-muted">Manage clients, groomers, services, and appointments.</p>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Total Clients</h5>
                <p class="fs-4">{{ $clientCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Total Groomers</h5>
                <p class="fs-4">{{ $groomerCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Upcoming Appointments</h5>
                <p class="fs-4">{{ $upcomingCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Services</h5>
                <p class="fs-4">{{ $serviceCount }}</p>
            </div>
        </div>
    </div>

    <!-- Clients & Groomers -->
    <div class="row">
        <!-- Clients -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-4">
                <h4 style="color: var(--accent);">Clients</h4>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                                <tr>
                                    <td>{{ $client->full_name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('admin.clients.destroy', $client->id) }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">No clients found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Groomers -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-4">
                <h4 style="color: var(--accent);">Groomers</h4>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($groomers as $groomer)
                                <tr>
                                    <td>{{ $groomer->full_name }}</td>
                                    <td>{{ $groomer->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.groomers.edit', $groomer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('admin.groomers.destroy', $groomer->id) }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">No groomers found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Services & Appointments -->
    <div class="row">
        <!-- Services -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-4">
                <h4 style="color: var(--accent);">Services</h4>
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-success mb-2">Add New Service</a>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr><th>Name</th><th>Description</th><th>Price</th><th>Duration</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>₱{{ number_format($service->price, 2) }}</td>
                                    <td>{{ $service->duration }} mins</td>
                                    <td>
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No services added yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Appointments -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-4">
                <h4 style="color: var(--accent);">Appointments</h4>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Pet</th><th>Breed</th><th>Client</th><th>Service</th>
                                <th>Scheduled At</th><th>Status</th><th>Notes</th><th>Assign Groomer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->pet->name }}</td>
                                    <td>{{ $appointment->pet->breed }}</td>
                                    <td>{{ $appointment->client->full_name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->scheduled_at }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>{{ $appointment->notes }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.appointments.assignGroomer', $appointment->id) }}">
                                            @csrf
                                            <div class="input-group">
                                                <select name="groomer_id" class="form-select form-select-sm" required>
                                                    <option value="">Assign Groomer</option>
                                                    @foreach($groomers as $groomer)
                                                        <option value="{{ $groomer->id }}" {{ $appointment->groomer_id == $groomer->id ? 'selected' : '' }}>
                                                            {{ $groomer->full_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary">Assign</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center">No appointments scheduled.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection