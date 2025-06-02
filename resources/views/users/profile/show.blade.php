@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%; border-radius: 1.5rem; border: none;">
        <div class="text-center">

            <!-- Avatar -->
            @if ($user->avatar)
                <img src="{{ $user->avatar }}" alt="avatar"
                     class="rounded-circle shadow mb-3" width="120" height="120">
            @else
                <i class="fas fa-user-circle fa-7x text-muted mb-3"></i>
            @endif

            <!-- Name & Introduction -->
            <h4 class="fw-bold text-purple">{{ $user->name }}</h4>
            <p class="text-muted mb-1">{{ $user->email }}</p>

            @if ($user->introduction)
                <p class="fst-italic text-muted">“{{ $user->introduction }}”</p>
            @endif

            <!-- Edit Button -->
            @if(Auth::id() === $user->id)
            <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-gradient-purple mt-3">
                <i class="fas fa-pencil-alt me-1"></i> Edit Profile
            </a>
        @endif
        
        </div>

        <!-- 食事記録 -->
        <div class="mt-4">
            <h5 class="text-purple">🍽 食べたもの</h5>
            @if ($user->foodRecords->count())
                <ul class="list-group">
                    @foreach ($user->foodRecords as $food)
                        <li class="list-group-item">{{ $food->food_name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">まだ食事記録はありません 🍙</p>
            @endif
        </div>

        <!-- 運動記録 -->
        <div class="mt-4">
            <h5 class="text-purple">💪 やった運動</h5>
            @if ($user->exerciseRecords->count())
                <ul class="list-group">
                    @foreach ($user->exerciseRecords as $exercise)
                        <li class="list-group-item">{{ $exercise->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">まだ運動記録はありません 🧘‍♀️</p>
            @endif
        </div>
    </div>
</div>
@endsection
