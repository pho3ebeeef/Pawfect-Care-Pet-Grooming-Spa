@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Clients</h2>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-success mb-3">Add Client</a>
    <table class="table table-striped">
        <thead><tr><th>Name</th><th>Email</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->full_name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
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