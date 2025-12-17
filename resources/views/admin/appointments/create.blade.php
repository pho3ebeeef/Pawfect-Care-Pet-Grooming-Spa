@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Appointment</h2>
    <form method="POST" action="{{ route('admin.appointments.store') }}">
        @csrf
        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-select" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Service</label>
            <select name="service_id" class="form-select" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
         <!-- Groomer (✅ place it here) -->
        <div class="mb-3">
            <label>Groomer</label>
            <select name="groomer_id" class="form-select" required>
                @foreach($groomers as $groomer)
                    <option value="{{ $groomer->id }}">{{ $groomer->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Groomer</label>
            <select name="groomer_id" class="form-select" required>
                @foreach($groomers as $groomer)
                    <option value="{{ $groomer->id }}">{{ $groomer->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Pet Name</label>
            <input type="text" name="pet_name" class="form-control" placeholder="Pet Name" required>
            <select name="species" class="form-select" required>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Rabbit">Rabbit</option>
                <option value="Bird">Bird</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Breed</label>
            <input type="text" name="breed" class="form-control"placeholder="Breed">
        </div>
        <div class="mb-3">
            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="no-show">No Show</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection