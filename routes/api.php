<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCategoryController;
use App\Http\Controllers\CompanyController;

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

Route::group(['prefix' => 'company'], function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{id}', [CompanyController::class, 'show']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::post('/{id}',[CompanyController::class, 'update']);
    Route::delete('/{id}',[CompanyController::class, 'destroy']);
});
