@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Client</h2>
    <form method="POST" action="{{ route('admin.clients.store') }}">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection