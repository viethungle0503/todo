<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoAppContrller;
use App\Http\Controllers\GoogleBardController;

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

Route::get('/', [ToDoAppContrller::class, 'index'])->name('todo');
Route::get('/home', [ToDoAppContrller::class, 'home'])->name('home');
Route::post('/todos', [ToDoAppContrller::class, 'store'])->name('store');
Route::put('/todos/{id}', [ToDoAppContrller::class, 'update']);
Route::put('/todos_status/{id}', [ToDoAppContrller::class, 'update_status']);
Route::get('/todos/{id}/edit', [ToDoAppContrller::class, 'edit'])->name('edit');
Route::delete('/todos/{id}', [ToDoAppContrller::class, 'destroy']);

Route::get('/export/csv', [ToDoAppContrller::class, 'exportCSV'])->name('export');
Route::get('/export/xlsx', [ToDoAppContrller::class, 'exportXLSX']);

Route::get('/chatBot', [GoogleBardController::class, 'index']);
Route::post('/process-nlp', [GoogleBardController::class, 'processNLP']);
