@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Food Record</h1>
<div class="card shadow-sm p-4">
  <form method="POST" action="{{ route('food-records.update', $foodRecord->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- 食べ物の名前 -->
    <div class="mb-3">
        <label for="food_name" class="form-label">Food Name</label>
        <input type="text" name="food_name" class="form-control" value="{{ old('food_name', $foodRecord->food_name) }}" required>
    </div>

    <!-- カロリー -->
    <div class="mb-3">
        <label for="calories" class="form-label">Calories</label>
        <input type="number" name="calories" class="form-control" value="{{ old('calories', $foodRecord->calories) }}" required>
    </div>

    <!-- 日付 -->
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" class="form-control" value="{{ old('date', $foodRecord->date) }}" required>
    </div>

    <!-- 時間 -->
    <div class="mb-3">
        <label for="time" class="form-label">Time</label>
        <input type="time" name="time" class="form-control" value="{{ old('time', $foodRecord->time) }}">
    </div>

    <!-- 食事タイプ -->
    <div class="mb-3">
        <label for="meal_type" class="form-label">Meal Type</label>
        <select name="meal_type" class="form-control">
            <option value="breakfast" {{ $foodRecord->meal_type === 'breakfast' ? 'selected' : '' }}>Breakfast</option>
            <option value="lunch" {{ $foodRecord->meal_type === 'lunch' ? 'selected' : '' }}>Lunch</option>
            <option value="dinner" {{ $foodRecord->meal_type === 'dinner' ? 'selected' : '' }}>Dinner</option>
            <option value="snack" {{ $foodRecord->meal_type === 'snack' ? 'selected' : '' }}>Snack</option>
        </select>
    </div>

    <!-- メモ -->
    <div class="mb-3">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" class="form-control">{{ old('notes', $foodRecord->notes) }}</textarea>
    </div>

    <!-- 画像アップロード -->
    <div class="mb-3">
        <label for="image" class="form-label">Photo (optional)</label>
        <input type="file" name="image" class="form-control">

        @if ($foodRecord->image_path)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $foodRecord->image_path) }}" class="img-thumbnail" style="max-width: 200px;">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
    
    <a href="{{ route('food-records.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
    
</div>
@endsection
