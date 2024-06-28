<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SuguanController;
use App\Http\Controllers\BroadcastSuguanController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\VerseOfTheWeekController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
    
Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::get('/', [SchedulerController::class, 'index']);

Route::get('/scheduler', [SchedulerController::class, 'index'])->name('scheduler.index');


Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::put('/reminders/{reminder}', [ReminderController::class, 'update'])->name('reminders.update');
Route::delete('/reminders/{reminder}', [ReminderController::class, 'destroy'])->name('reminders.destroy');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

Route::post('/events/updateStatus', [EventController::class, 'updateStatus'])->name('events.updateStatus');
Route::get('/events/filter', [EventController::class, 'filterEvents'])->name('events.filter');



Route::get('/suguan', [SuguanController::class, 'index'])->name('suguan.index');
Route::post('/suguan', [SuguanController::class, 'store'])->name('suguan.store');
Route::put('/suguan/{suguan}', [SuguanController::class, 'update'])->name('suguan.update');
Route::delete('/suguan/{suguan}', [SuguanController::class, 'destroy'])->name('suguan.destroy');

Route::get('/scheduler', [SchedulerController::class, 'index'])->name('scheduler.index');
Route::get('/verseoftheweek', [VerseOfTheWeekController::class, 'index'])->name('verseoftheweek.index');
Route::post('/verseoftheweek', [VerseOfTheWeekController::class, 'store'])->name('verseoftheweek.store');
Route::put('/verseoftheweek/{id}', [VerseOfTheWeekController::class, 'update'])->name('verseoftheweek.update');
Route::delete('/verseoftheweek/{id}', [VerseOfTheWeekController::class, 'destroy'])->name('verseoftheweek.destroy');


Route::resource('broadcast_suguan', BroadcastSuguanController::class);
Route::get('broadcast_suguan/export/csv', [BroadcastSuguanController::class, 'exportCSV'])->name('broadcast_suguan.export_csv');
Route::post('/broadcast_suguan/import', [BroadcastSuguanController::class, 'import'])->name('broadcast_suguan.import');
