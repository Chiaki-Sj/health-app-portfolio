@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%; border-radius: 1rem; border: none;">
        <h2 class="text-center fw-bold mb-4 text-purple">Edit Your Profile 💫</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Introduction -->
            <div class="mb-3">
                <label for="introduction" class="form-label fw-semibold">Introduction</label>
                <textarea class="form-control" name="introduction" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                @error('introduction') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Avatar -->
            <div class="mb-3">
                <label for="avatar" class="form-label fw-semibold">Profile Image</label>
                <input class="form-control" type="file" name="avatar">
                @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Button -->
            <div class="text-center mt-4">
                <button class="btn btn-gradient-purple px-4 py-2" type="submit">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
