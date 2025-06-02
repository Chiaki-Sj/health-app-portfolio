@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-center mb-4 fw-bold" style="color: #667eea;">
    <i class="fas fa-utensils me-2"></i> My Food Records
  </h1>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('food-records.create') }}"
   class="btn text-white mb-4"
   style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
    <i class="fas fa-plus-circle me-1"></i> Add New Food
    </a>


    @foreach ($foodRecords as $record)
    <div class="card mb-4 shadow-sm border-0 rounded-4">

            <div class="card-body">
                <h5>{{ $record->food_name }}</h5>
                <p>{{ $record->calories }} kcal | {{ $record->date }} {{ $record->time }}</p>
                    @php
                      $calories = $record->calories;

                      if ($calories >= 1500) {
                          $barColor = 'bg-danger';
                          $width = 100;
                      } elseif ($calories >= 1000) {
                          $barColor = 'bg-danger';
                          $width = max(min($calories / 30, 100), 75);
                      } elseif ($calories >= 700) {
                          $barColor = 'bg-warning';
                          $width = max(min($calories / 30, 100), 50);
                      } else {
                          $barColor = 'bg-success';
                          $width = min($calories / 30, 100);
                      }
                  @endphp

<div class="mb-2 fs-6 fw-bold text-secondary">Calories: {{ $calories }} kcal</div>
<div class="progress mb-3" style="height: 25px;">
    <div class="progress-bar {{ $barColor }} progress-bar-striped progress-bar-animated text-white fw-bold"
        role="progressbar"
        style="width: {{ $width }}%;"
        aria-valuenow="{{ $calories }}" aria-valuemin="0" aria-valuemax="3000">
        {{ $calories }} kcal
    </div>
</div>



                <p><strong>Type:</strong> {{ $record->meal_type }}</p>
                <p>{{ $record->notes }}</p>

               

                @if ($record->image_path)
                <img src="{{ asset('storage/' . $record->image_path) }}" class="img-thumbnail rounded-3" style="max-width: 200px;">

                @endif

                <div class="d-flex justify-content-end gap-2 mt-2">
                    <a href="{{ route('food-records.edit', $record->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $record->id }}">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>

        <!-- 削除モーダル -->
        <div class="modal fade" id="deleteModal{{ $record->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $record->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $record->id }}">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong>{{ $record->food_name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('food-records.destroy', $record->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                  class="btn text-white"
                                  style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
                              <i class="fas fa-trash-alt me-1"></i> Yes, delete
                            </button>

                        </form>
                        <button type="button"
                        class="btn text-white"
                        style="background: #adb5bd;">
                          Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
