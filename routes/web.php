<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

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

Route::get('/', [Todo::class, 'index'])->name('todo');
Route::post('/todos', [Todo::class, 'store'])->name('store');
Route::put('/todos/{id}', [Todo::class, 'update']);
Route::put('/todos_status/{id}', [Todo::class, 'update_status']);
Route::delete('/todos/{id}', [Todo::class, 'destroy']);

Route::get('/todos/{id}/edit', [Todo::class, 'edit'])->name('edit');