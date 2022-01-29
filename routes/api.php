<?php

use App\Http\Controllers\API\BloodMeasureApiController;
use App\Http\Controllers\API\CalendarApiController;
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
    Route::get('/show', [QuestionApiController::class, 'show'])->name('api.questions.constancy.show');
    Route::post('/', [QuestionApiController::class, 'store'])->name('api.questions.constancy.store');
});

Route::group(['prefix' => 'blood-measure', 'middleware' => 'auth:api'], function () {
    Route::get('/', [BloodMeasureApiController::class, 'index'])->name('api.blood-measure.index');
    Route::post('/', [BloodMeasureApiController::class, 'store'])->name('api.blood-measure.store');
});

Route::group(['prefix' => 'cerdika'], function(){
    Route::get('calendar/{member}', [CalendarApiController::class, 'index'])->name('api.cerdika.calendar.index');
});