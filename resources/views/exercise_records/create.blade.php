@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f8faff; border-radius: 12px;">

    <h1>Add New Exercise</h1>

    <form method="POST" action="{{ route('exercise-records.store') }}">
        @csrf

        <!-- エクササイズ名 -->
        <div class="mb-3">
            <label for="exercise_name" class="form-label">Exercise Name</label>
            <input type="text" name="exercise_name" class="form-control" required>
        </div>

        <!-- 消費カロリー -->
        <div class="mb-3">
            <label for="calories_burned" class="form-label">Calories Burned</label>
            <input type="number" name="calories_burned" class="form-control" required>
        </div>

        <!-- 時間 -->
        <div class="mb-3">
            <label for="duration" class="form-label">Duration (minutes)</label>
            <input type="number" name="duration" class="form-control">
        </div>

        <!-- 日付 -->
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <!-- 時間（任意） -->
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" name="time" class="form-control">
        </div>

        <!-- メモ -->
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>
        <!-- YouTubeリンク -->
        <div class="mb-3">
          <label for="youtube_url" class="form-label">YouTube Link</label>
          <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $exerciseRecord->youtube_url ?? '') }}">
        </div>
        <!-- 登録ボタン -->
        <button type="submit"
        class="btn text-white w-100"
        style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
         <i class="fas fa-save me-1"></i> Save
        </button>


        <!-- 戻るボタン -->
        <a href="{{ route('exercise-records.index') }}"
   class="btn text-white w-100 mt-3"
   style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
    <i class="fas fa-arrow-left me-1"></i> Back to List
</a>


        
    </form>
</div> 



@endsection
