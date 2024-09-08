<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\StudentsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('students', [StudentsController::class , 'index']);
Route::post('students/create', [StudentsController::class , 'store']);
Route::get('students/{id}/find', [StudentsController::class , 'show']);
Route::put('students/{id}/edit', [StudentsController::class, 'update']);
Route::delete('students/{id}/delete', [StudentsController::class , 'destroy']);
