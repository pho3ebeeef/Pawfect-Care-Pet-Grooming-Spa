@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Client</h2>
    <form method="POST" action="{{ route('admin.clients.update', $client->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $client->full_name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection