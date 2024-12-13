<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ApiBoardListController;
use App\Http\Controllers\ApiCardsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/board_lists', [ApiBoardListController::class, 'index'])->name('board_lists.index');
    Route::get('/board_list/{board_list?}', [ApiBoardListController::class, 'edit'])->name('board.list.edit');
    Route::post('/board_list/create', [ApiBoardListController::class, 'store'])->name('board_list.store');
    Route::post('/board_list/{id}/toggle-status', [BrandController::class, 'toggleStatus']);

    Route::get('/cards/{board_list?}', [ApiCardsController::class, 'index'])->name('cards.index');
    Route::post('/card/create', [ApiCardsController::class, 'store'])->name('cards.store');
});

Route::post('login', function () {
    $user = App\Models\User::first();
    return $user->createToken('api')->plainTextToken;
});
