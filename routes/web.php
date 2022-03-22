<?php

use App\Http\Controllers\LogbookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'cerdika'], function(){
    Route::get('logbook/{member}/index', [LogbookController::class, 'index'])->name('cerdika.logbook.index');
    Route::get('logbook/{member}/create', [LogbookController::class, 'create'])->name('cerdika.logbook.create');
    Route::post('logbook/{member}/create', [LogbookController::class, 'store'])->name('cerdika.logbook.store');
    Route::get('logbook/{member}/show', [LogbookController::class, 'show'])->name('cerdika.logbook.show');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
