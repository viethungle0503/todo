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

/*
|--------------------------------------------------------------------------
| Route Groups
|--------------------------------------------------------------------------
|
| In this code, the prefix option is used to specify a common URI prefix for all routes in  
| the group, and the as option is used to specify a common name prefix for all routes in the group.
| The todos routes are further grouped together to keep the code organized and maintainable.
|
*/

Route::group(['prefix' => '/', 'as' => ''], function () {
  Route::get('/', [ToDoAppContrller::class, 'index'])->name('index');
  Route::get('/home', [ToDoAppContrller::class, 'home'])->name('home');
  
  Route::group(['prefix' => 'todos', 'as' => 'todos.'], function () {
      Route::post('/', [ToDoAppContrller::class, 'store'])->name('store');
      Route::get('/{id}/edit', [ToDoAppContrller::class, 'edit'])->name('edit');
      Route::put('/status/{id}', [ToDoAppContrller::class, 'updateStatus']);
      Route::put('/task/{id}', [ToDoAppContrller::class, 'update']);
      Route::delete('/{id}', [ToDoAppContrller::class, 'destroy'])->name('destroy');
  });
});

Route::group(['prefix' => 'export', 'as' => 'export.'], function () {
    Route::get('/csv', [ToDoAppContrller::class, 'exportCsv'])->name('csv');
    Route::get('/xlsx', [ToDoAppContrller::class, 'exportXlsx'])->name('xlsx');
});

Route::get('/chatBot', [GoogleBardController::class, 'index']);
Route::post('/process-nlp', [GoogleBardController::class, 'processNLP']);
