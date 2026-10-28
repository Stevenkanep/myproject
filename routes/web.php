<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('categories', CategoryController::class)->except(['show']);

Route::get('/about', [PageController::class, 'about']);

Route::get('/tasks/{id}', [PageController::class, 'task']);
Route::get('/tasks', [TaskController::class, 'index'])
 ->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])
 ->name('tasks.store');

