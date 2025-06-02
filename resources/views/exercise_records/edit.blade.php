@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Exercise Record</h1>

    <div class="card shadow-sm p-4">
        <form method="POST" action="{{ route('exercise-records.update', $exerciseRecord->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exercise_name" class="form-label">Exercise Name</label>
                <input type="text" name="exercise_name" class="form-control" value="{{ old('exercise_name', $exerciseRecord->exercise_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="calories_burned" class="form-label">Calories Burned</label>
                <input type="number" name="calories_burned" class="form-control" value="{{ old('calories_burned', $exerciseRecord->calories_burned) }}" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration (minutes)</label>
                <input type="number" name="duration" class="form-control" value="{{ old('duration', $exerciseRecord->duration) }}">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $exerciseRecord->date) }}" required>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="time" name="time" class="form-control" value="{{ old('time', $exerciseRecord->time) }}">
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" class="form-control" rows="3">{{ old('notes', $exerciseRecord->notes) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Exercise
            </button>
            <a href="{{ route('exercise-records.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </form>
    </div>
</div>
<!-- YouTubeリンク -->
<div class="mb-3">
  <label for="youtube_url" class="form-label">YouTube Link</label>
  <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $exerciseRecord->youtube_url ?? '') }}">
</div>

@endsection