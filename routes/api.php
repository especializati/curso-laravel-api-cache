<?php

use App\Http\Controllers\Api\{
    CourseController
};
use Illuminate\Support\Facades\Route;

Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{identify}', [CourseController::class, 'destroy']);
Route::get('/courses/{identify}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'index']);

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});