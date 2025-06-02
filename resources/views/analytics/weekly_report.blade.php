@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="fas fa-chart-line"></i> @lang('messages.weekly_report')</h1>

    <p class="text-muted">@lang('messages.date_range'): {{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}</p>

    <!-- Calorie Summary -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-utensils"></i> @lang('messages.total_intake')</h5>
                    <p class="card-text h4">{{ $totalCaloriesIntake }} kcal</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-running"></i> @lang('messages.total_burned')</h5>
                    <p class="card-text h4">{{ $totalCaloriesBurned }} kcal</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-balance-scale"></i> @lang('messages.balance')</h5>
                    <p class="card-text h4">{{ $weeklyCaloriesBalance }} kcal</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Tables -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>@lang('messages.daily_intake')</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.date')</th>
                            <th>@lang('messages.calories')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyCaloriesIntake as $date => $calories)
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ $calories }} kcal</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h5>@lang('messages.daily_burned')</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.date')</th>
                            <th>@lang('messages.calories')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyCaloriesBurned as $date => $calories)
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ $calories }} kcal</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card p-3 mb-5">
        <h5>@lang('messages.chart_title')</h5>
        <canvas id="calorieChart"></canvas>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('calorieChart').getContext('2d');
    const calorieChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($dailyCaloriesIntake)) !!},
            datasets: [
                {
                    label: "@lang('messages.intake')",
                    data: {!! json_encode(array_values($dailyCaloriesIntake)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                },
                {
                    label: "@lang('messages.burned')",
                    data: {!! json_encode(array_values($dailyCaloriesBurned)) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
