<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthConroller;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\RedirectIfAuthenticated;

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

Route::controller(AuthConroller::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/', 'login_view')->name('login');
        Route::post('/', 'login_process');
    });
    Route::get('/logout', 'logout')->name('logout')->middleware(Authenticate::class);
});

Route::controller(TaskController::class)->middleware(Authenticate::class)->group(function () {
    Route::get('/tasks', 'index')->name('tasks');
    Route::post('/task/create', 'store')->name('task.create');
    Route::post('/task/{task}/edit', 'update')->name('task.edit');
    Route::get('/task/{task}/delete', 'destroy')->name('task.delete');
});

Route::get('/create', function () {
    $data = [
        'name' => 'Ali',
        'email' => 'ali@gmail.com',
        'password' => Hash::make('12345'),
    ];
    User::create($data);
    return redirect()->route('login');
});
