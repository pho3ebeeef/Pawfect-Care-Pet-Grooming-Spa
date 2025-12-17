@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 40px; padding-bottom: 40px;" data-aos="fade-up">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 12px;">
        <h2 class="text-center mb-4" style="color: var(--accent);">Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label" style="color: var(--dark-grey);">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label" style="color: var(--dark-grey);">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="client">Client</option>
                    <option value="groomer">Groomer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label" style="color: var(--dark-grey);">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label" style="color: var(--dark-grey);">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label" style="color: var(--dark-grey);">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-accent w-100">Register</button>
        </form>

        <div class="text-center mt-3">
            Already have an account? 
            <a href="{{ route('login') }}" style="color: var(--accent);">Sign in</a>
        </div>
</div>
    </div>
</div>
@endsection