<?php

use Illuminate\Support\Facades\Route;
use BalletSchoolIntranetSystem\Http\Controllers\AssignmentController;

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

Route::get('/assign-costume/{costume}', [App\Http\Controllers\AssignmentController::class, 'assignCostume'])->name('assign-costume');

Route::post('/store-assignment', [App\Http\Controllers\AssignmentController::class, 'storeAssignment'])->name('store-assignment');




