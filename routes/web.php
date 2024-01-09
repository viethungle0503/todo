<?php

use App\Http\Controllers\GoogleBardController;
use App\Http\Controllers\ToDoAppContrller;
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

Route::get('/', [ToDoAppContrller::class, 'index'])->name('todo');
Route::get('/home', [ToDoAppContrller::class, 'home'])->name('home');
Route::post('/todos', [ToDoAppContrller::class, 'store'])->name('store');
Route::put('/todos/{id}', [ToDoAppContrller::class, 'update']);
Route::put('/todos_status/{id}', [ToDoAppContrller::class, 'updateStatus']);
Route::get('/todos/{id}/edit', [ToDoAppContrller::class, 'edit'])->name('edit');
Route::delete('/todos/{id}', [ToDoAppContrller::class, 'destroy']);

Route::get('/export/csv', [ToDoAppContrller::class, 'exportCsv'])->name('export');
Route::get('/export/xlsx', [ToDoAppContrller::class, 'exportXlsx']);

Route::get('/chatBot', [GoogleBardController::class, 'index']);
Route::post('/process-nlp', [GoogleBardController::class, 'processNLP']);
