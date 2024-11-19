<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('todo')->group(function () {
    Route::get('/',[TodoController::class, 'index']);
    Route::get('/show/{id}',[TodoController::class, 'show']);
    Route::post('/store',[TodoController::class, 'store']);
    Route::post('/update/{id}',[TodoController::class, 'update']);
    Route::delete('/delete/{id}',[TodoController::class, 'delete']);
});
