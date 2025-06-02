@extends('layouts.app')

@section('content')



<div class="container bg-white rounded shadow p-5 my-5 text-center">
  <h1 class="display-4 fw-bold text-gradient-purple">Eat Well, Move Smart, Live Strong 💚</h1>
  <p class="lead mt-3">Simple tracking. Real results. Your wellness journey starts here.</p>

  <div class="my-4">
    <a href="{{ route('food-records.index') }}" class="btn btn-purple m-2 px-4 py-2 rounded-pill shadow-sm">
        <i class="fas fa-utensils me-2"></i> View Food Records
    </a>
    <a href="{{ route('exercise-records.index') }}" class="btn btn-purple m-2 px-4 py-2 rounded-pill shadow-sm">
        <i class="fas fa-dumbbell me-2"></i> View Exercise Records
    </a>
  </div>

  <img src="{{ asset('images/healthy-lifestyle.png') }}" class="img-fluid rounded shadow-lg" alt="Healthy Dashboard">
</div>

<style>
.text-gradient-purple {
  background: linear-gradient(to right, #6a11cb, #2575fc);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.btn-purple {
  background: linear-gradient(to right, #6a11cb, #2575fc);
  color: white;
  border: none;
}
.btn-purple:hover {
  opacity: 0.9;
}
</style>
@endsection
