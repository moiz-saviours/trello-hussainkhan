<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiBoardListController;
use App\Http\Controllers\ApiCardsController;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::post('/brands/{id}/update', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::post('/brands/{id}/toggle-status', [BrandController::class, 'toggleStatus']);
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs');


    Route::get('/board_lists', [ApiBoardListController::class, 'index'])->name('board.list.index');
    Route::post('/board_list', [ApiBoardListController::class, 'store'])->name('board.list.store');
    Route::post('/board_list/{id}/toggle-status', [BrandController::class, 'toggleStatus']);

    Route::get('/cards', [ApiCardsController::class, 'index'])->name('cards.index');
    Route::post('/cards', [ApiCardsController::class, 'store'])->name('cards.store');
});
