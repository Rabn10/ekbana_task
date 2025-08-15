<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => ['api.key'] ,'prefix' => 'category'], function () {
    Route::get('/', [CompanyCategoryController::class, 'index']);
    Route::get('/search', [CompanyCategoryController::class, 'search']);
    Route::get('/{id}', [CompanyCategoryController::class, 'show']);
    Route::post('/', [CompanyCategoryController::class, 'store']);
    Route::put('/{id}',[CompanyCategoryController::class, 'update']);
    Route::delete('/{id}',[CompanyCategoryController::class, 'destroy']);
});

Route::group( ['middleware' => ['api.key'] ,'prefix' => 'company'], function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{id}', [CompanyController::class, 'show']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::post('/{id}',[CompanyController::class, 'update']);
    Route::delete('/{id}',[CompanyController::class, 'destroy']);
});


Route::post('/employee', [EmployeeController::class, 'store']);

