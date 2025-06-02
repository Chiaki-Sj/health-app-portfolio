<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodRecordController;
use App\Http\Controllers\ExerciseRecordController;
use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
// デフォルトのウェルカムページ
// Route::get('/', function () {
//     return view('welcome');
// });

// 認証ルート（Laravel UI/Jetsrteamでの認証設定後）
Auth::routes();

// ダッシュボード（ログイン後のホーム）

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('food-records', FoodRecordController::class);
    Route::resource('exercise-records', ExerciseRecordController::class);

    Route::get('/analytics/weekly', [AnalyticsController::class, 'weeklyReport'])->name('analytics.weekly');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/locale/{lang}', function ($lang) {
        session(['locale' => $lang]);
        App::setLocale($lang);
        return redirect()->back();
    });

    Route::get('/check-locale', function () {
        return 'Current locale: ' . session('locale', 'not set');
    });
});