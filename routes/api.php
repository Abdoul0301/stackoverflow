<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Routes for Users
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

// Routes for Questions
Route::get('questions', [QuestionController::class, 'index']);
Route::get('questions/{id}', [QuestionController::class, 'show']);
Route::post('questions', [QuestionController::class, 'store']);
Route::put('questions/{id}', [QuestionController::class, 'update']);
Route::delete('questions/{id}', [QuestionController::class, 'destroy']);

// Routes for Answers
Route::get('answers', [AnswerController::class, 'index']);
Route::get('answers/{id}', [AnswerController::class, 'show']);
Route::post('answers', [AnswerController::class, 'store']);
Route::put('answers/{id}', [AnswerController::class, 'update']);
Route::delete('answers/{id}', [AnswerController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
