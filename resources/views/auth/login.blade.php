@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;" data-aos="fade-up">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 12px;">
        <h2 class="text-center mb-4" style="color: var(--accent);">Sign in</h2>

    <form method="POST" action="{{ route('login') }}" class="p-3 rounded shadow-sm" style="background-color: var(--light);">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label text-start w-100">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-start w-100">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger small">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="btn btn-accent w-100 mt-2">Login</button>
    </form>

    <p class="text-center mt-3 small">
        Don't have an account? <a href="{{ route('register') }}" style="color: var(--accent);">Sign up here</a>
    </p>
</div>
@endsection