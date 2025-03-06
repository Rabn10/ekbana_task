<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CompanyCategoryController::class, 'index']);
    Route::get('/{id}', [CompanyCategoryController::class, 'show']);
    Route::post('/', [CompanyCategoryController::class, 'store']);
    Route::put('/{id}',[CompanyCategoryController::class, 'update']);
    Route::delete('/{id}',[CompanyCategoryController::class, 'destroy']);
});
