<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class);

// TO update the status alone from the table
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');

// to only assign one user
Route::patch('/tasks/{task}/assign', [TaskController::class, 'updateAssignment'])
    ->name('tasks.updateAssignment');

Route::get('/', function () {
    return view('welcome');
});
