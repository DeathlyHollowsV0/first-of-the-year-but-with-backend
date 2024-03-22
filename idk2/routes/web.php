<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('Home');
});

Route::get('/check',[AbsenceController::class,'import'])->name("check-absence");

Route::get('/ajouter',[StudentController::class,"affiche"])->name("ajouter-absence");
Route::get('/search', 'StudentController@search')->name('search');



Route::get('/search',[StudentController::class,"search"]);

Route::post('/absence-student',[AbsenceController::class,"absence_student"]);
Route::post('/absence-update',[AbsenceController::class,"absence_update"]);

Route::get('/filterByGroup', [StudentController::class, 'filterByGroup'])->name('filterByGroup');

// for check 
Route::get('/filterByGroupp', [AbsenceController::class, 'filterByGroup'])->name('filterByGroupp');
Route::get('/searchh',[AbsenceController::class,"search"]);

Route::get('/detail-student/{cef}', [AbsenceController::class, 'detail_student']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
