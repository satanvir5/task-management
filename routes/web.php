<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/tasks'); // Redirect to dashboard if authenticated
    } else {
        return redirect('/login'); // Redirect to login if not authenticated
    }
});


Auth::routes();
// User Registration
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// User Login/Logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Task Creation
Route::middleware('auth')->group(function () {
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('task-store', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('taskAssign', [TaskController::class, 'taskAssign'])->name('taskAssign');

    Route::get('tasks', [TaskController::class, 'allTasks'])->name('tasks');
    Route::get('api/tasks', [TaskController::class, 'index'])->name('api-tasks');
});

// Task Assignment
// Add necessary routes for task assignment

// Add other necessary routes as per your requirements




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
