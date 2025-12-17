@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 style="color: var(--accent);">Edit Groomer</h2>

    <form method="POST" action="{{ route('admin.groomers.update', $groomer->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="full_name" class="form-label">Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $groomer->full_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $groomer->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Groomer</button>
    </form>
</div>
@endsection