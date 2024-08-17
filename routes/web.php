<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherPortalController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home route - Redirect to the teacher portal if authenticated
Route::get('/', function () {
    return redirect('/home');
});

// Authentication routes (login, register, etc.)
Auth::routes();

// Routes for the teacher portal, protected by authentication middleware
Route::middleware('auth')->group(function () {
    Route::get('/home', [TeacherPortalController::class, 'index'])->name('home');
    Route::post('/students/add', [TeacherPortalController::class, 'addStudent']);
    Route::put('/students/{id}', [TeacherPortalController::class, 'updateStudent'])->name('students.update');
    Route::delete('/students/{id}', [TeacherPortalController::class, 'deleteStudent'])->name('students.destroy');
});
