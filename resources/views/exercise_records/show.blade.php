@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Exercise Record Details</h1>

    <div class="card shadow-sm p-4">
        <h5><strong>Exercise:</strong> {{ $exerciseRecord->exercise_name }}</h5>
        <p><strong>Calories Burned:</strong> {{ $exerciseRecord->calories_burned }} kcal</p>
        <p><strong>Duration:</strong> {{ $exerciseRecord->duration }} min</p>
        <p><strong>Date:</strong> {{ $exerciseRecord->date }}</p>
        <p><strong>Time:</strong> {{ $exerciseRecord->time }}</p>
        <p><strong>Notes:</strong><br>{{ $exerciseRecord->notes }}</p>
        
        @if ($exerciseRecord->youtube_url)
        <p>
            <strong>YouTube:</strong>
            <a href="{{ $exerciseRecord->youtube_url }}" target="_blank">{{ $exerciseRecord->youtube_url }}</a>
        </p>
        @endif
    
        <div class="mt-4">
            <a href="{{ route('exercise-records.edit', $exerciseRecord->id) }}" class="btn btn-outline-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('exercise-records.destroy', $exerciseRecord->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
            <a href="{{ route('exercise-records.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
