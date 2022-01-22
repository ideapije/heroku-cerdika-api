<?php

use App\Http\Controllers\API\QuestionApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'questions', 'middleware' => 'auth:api'], function () {
    Route::get('/', [QuestionApiController::class, 'index'])->name('api.questions.constancy.index');
    Route::post('/', [QuestionApiController::class, 'store'])->name('api.questions.constancy.store');
});