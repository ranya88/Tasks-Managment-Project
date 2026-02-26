<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::resource('tasks', TaskController::class);

// TO update the status alone from the table
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name(name: 'tasks.updateStatus');

// to only assign one user
Route::patch('/tasks/{task}/assign', [TaskController::class, 'updateAssignment'])
    ->name('tasks.updateAssignment');

Route::get('/', function () {
    return view('welcome');
});


Route::resource('projects', ProjectController::class);
