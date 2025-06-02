@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <div class="p-4 rounded-4 shadow-sm" style="background: #f9fafe;">
        <h1 class="text-center mb-4 fw-bold" style="color: #667eea;">
            <i class="fas fa-carrot me-2"></i> New Food Record
        </h1>
        

    <form method="POST" action="{{ route('food-records.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- 食べ物の名前 -->
        <div class="mb-3">
            <label for="food_name" class="form-label">Food Name</label>
            <input type="text" name="food_name" class="form-control" required>
        </div>

        <!-- カロリー -->
        <div class="mb-3">
            <label for="calories" class="form-label">Calories</label>
            <input type="number" name="calories" class="form-control" required>
        </div>

        <!-- 日付 -->
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <!-- 時間 -->
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" name="time" class="form-control">
        </div>

        <!-- 食事タイプ -->
        <div class="mb-3">
            <label for="meal_type" class="form-label">Meal Type</label>
            <select name="meal_type" class="form-control">
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
                <option value="snack">Snack</option>
            </select>
        </div>

        <!-- メモ -->
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <!-- 🔥 画像アップロード -->
        <div class="mb-3">
            <label for="image" class="form-label">Photo</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit"
        class="btn text-white w-100 mt-3"
        style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
        <i class="fas fa-save me-1"></i> Save
        </button>

        <a href="{{ route('food-records.index') }}"
        class="btn text-white w-100 mt-2"
        style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>

    </form>
</div>

</div>
@endsection
