@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 style="color: var(--accent);">Manage Groomers</h2>
    <a href="{{ route('admin.groomers.create') }}" class="btn btn-success mb-3">Add Groomer</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groomers as $groomer)
                <tr>
                    <td>{{ $groomer->full_name }}</td>
                    <td>{{ $groomer->email }}</td>
                    <td>{{ ucfirst($groomer->employment_status) }}</td>
                    <td>
                        <a href="{{ route('admin.groomers.edit', $groomer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.groomers.destroy', $groomer->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection