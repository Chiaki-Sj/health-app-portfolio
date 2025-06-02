@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #f9fafe, #eef3ff); min-height: 100vh;">

    <h1 class="mb-4 text-center fw-bold" style="color: #667eea;">
        <i class="fas fa-dumbbell me-2"></i> Exercise Records
    </h1>

    @if ($exerciseRecords->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-dumbbell fa-2x d-block mb-2"></i>
            No exercise records found. Start tracking your workouts!
        </div>
    @endif

    <a href="{{ route('exercise-records.create') }}"
       class="btn text-white mb-4"
       style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
        <i class="fas fa-plus-circle me-1"></i> Add New Exercise
    </a>

    @foreach ($exerciseRecords as $exercise)
        <div class="card mb-4 shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5>{{ $exercise->exercise_name }}</h5>

                @php
                    $burned = $exercise->calories_burned;
                    if ($burned < 200) {
                        $barColor = 'bg-info';
                        $label = 'Too Low 🔻';
                    } elseif ($burned < 500) {
                        $barColor = 'bg-warning';
                        $label = 'Moderate 💡';
                    } else {
                        $barColor = 'bg-success';
                        $label = 'Great Job! 💪';
                    }
                    $width = min($burned / 20, 100);
                @endphp

                <div class="mb-2 fw-bold">Calories Burned: {{ $burned }} kcal
                    <span class="badge {{ $barColor }}">{{ $label }}</span>
                </div>
                <div class="progress mb-3" style="height: 30px;">
                    <div class="progress-bar {{ $barColor }} fs-5 fw-bold text-white progress-bar-striped progress-bar-animated"
                         role="progressbar"
                         style="width: {{ $width }}%;"
                         aria-valuenow="{{ $burned }}" aria-valuemin="0" aria-valuemax="3000">
                        {{ $burned }} kcal
                    </div>
                </div>

                <p><i class="fas fa-stopwatch me-1 text-secondary"></i> <strong>Duration:</strong> {{ $exercise->duration }} min</p>
                <hr>
                <p><i class="fas fa-sticky-note me-1 text-secondary"></i> <strong>Notes:</strong> {{ $exercise->notes }}</p>

                @if ($exercise->youtube_url)
                    <p><strong>YouTube:</strong> <a href="{{ $exercise->youtube_url }}" target="_blank">{{ $exercise->youtube_url }}</a></p>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('exercise-records.edit', $exercise->id) }}"
                       class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- モーダル起動ボタン -->
                    <button type="button"
                            class="btn text-white btn-sm"
                            style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;"
                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $exercise->id }}">
                        <i class="fas fa-trash-alt me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>

        <!-- 削除モーダル -->
        <div class="modal fade" id="deleteModal{{ $exercise->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $exercise->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-3">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel{{ $exercise->id }}">
                            <i class="fas fa-exclamation-triangle me-2"></i> Confirm Deletion
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong>{{ $exercise->exercise_name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('exercise-records.destroy', $exercise->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn text-white btn-sm"
                                    style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
                                <i class="fas fa-trash-alt me-1"></i> Yes, delete
                            </button>
                        </form>

                        <button type="button"
                                class="btn text-white btn-sm"
                                style="background: #adb5bd;"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
