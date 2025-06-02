<?php
// app/Http/Controllers/AnalyticsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\FoodRecord;
use App\Models\ExerciseRecord;
use App\Models\User;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // 週間レポートを表示
    public function weeklyReport(Request $request)
    {
        $user = Auth::user();
        
        // 表示する週の開始日を決定（デフォルトは今週の月曜日）
        $startDate = Carbon::now()->startOfWeek();
        
        // リクエストで特定の週が指定されていれば、その週に設定
        if ($request->has('week_start')) {
            $startDate = Carbon::parse($request->week_start)->startOfWeek();
        }
        
        // 週の終了日（日曜日）
        $endDate = (clone $startDate)->endOfWeek();
        
        // 前週・次週の日付を計算
        $prevWeek = (clone $startDate)->subWeek()->format('Y-m-d');
        $nextWeek = (clone $startDate)->addWeek()->format('Y-m-d');
        
        // 週ごとの食事記録を取得
        $foodRecords = $user->foodRecords()
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('date')
            ->orderBy('time')
            ->get();
            
        // 週ごとの運動記録を取得
        $exerciseRecords = $user->exerciseRecords()
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('date')
            ->orderBy('time')
            ->get();
            
        // 日ごとの摂取カロリーを集計
        $dailyCaloriesIntake = [];
        $totalCaloriesIntake = 0;
        
        for ($day = clone $startDate; $day <= $endDate; $day->addDay()) {
            $date = $day->format('Y-m-d');
            $calories = $foodRecords->where('date', $date)->sum('calories');
            $dailyCaloriesIntake[$date] = $calories;
            $totalCaloriesIntake += $calories;
        }
        
        // 日ごとの消費カロリーを集計
        $dailyCaloriesBurned = [];
        $totalCaloriesBurned = 0;
        
        for ($day = clone $startDate; $day <= $endDate; $day->addDay()) {
            $date = $day->format('Y-m-d');
            $calories = $exerciseRecords->where('date', $date)->sum('calories_burned');
            $dailyCaloriesBurned[$date] = $calories;
            $totalCaloriesBurned += $calories;
        }
        
        // 日ごとのカロリー収支（摂取 - 消費）
        $dailyCaloriesBalance = [];
        foreach ($dailyCaloriesIntake as $date => $intake) {
            $burned = $dailyCaloriesBurned[$date] ?? 0;
            $dailyCaloriesBalance[$date] = $intake - $burned;
        }
        
        // 週間の合計カロリー収支
        $weeklyCaloriesBalance = $totalCaloriesIntake - $totalCaloriesBurned;
        
        // 食事タイプ別の集計（朝食・昼食・夕食・間食など）
        $mealTypeCalories = $foodRecords->groupBy('meal_type')
            ->map(function ($records) {
                return $records->sum('calories');
            });
            
        // 運動タイプ別の集計
        $exerciseTypeCalories = $exerciseRecords->groupBy('exercise_name')
            ->map(function ($records) {
                return [
                    'calories' => $records->sum('calories_burned'),
                    'duration' => $records->sum('duration'),
                ];
            });
            
        return view('analytics.weekly_report', compact(
            'startDate',
            'endDate',
            'prevWeek',
            'nextWeek',
            'dailyCaloriesIntake',
            'dailyCaloriesBurned',
            'dailyCaloriesBalance',
            'totalCaloriesIntake',
            'totalCaloriesBurned',
            'weeklyCaloriesBalance',
            'mealTypeCalories',
            'exerciseTypeCalories',
            'foodRecords',
            'exerciseRecords'
        ));
    }
}
