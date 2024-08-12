<?php

use App\Http\Controllers\client\clientController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\filter\cityController;
use App\Http\Controllers\filter\clientFilterController;
use App\Http\Controllers\filter\employeeFilterController;
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
    return ['Laravel' => app()->version()];
});


Route::middleware('auth')->group(function () {
    // Route for employee
});
Route::resource('/employee', employeeController::class);
Route::prefix('employee')->group(function () {
    Route::get('/filter/{column}', [employeeFilterController::class, 'index']);
    Route::post('/filter', [employeeFilterController::class, 'filter']);
    Route::get('/sort/{column}/{direction}', [employeeFilterController::class, 'sort']);
    Route::get('/search/{search}', [employeeFilterController::class, 'search']);
});
// Route for client
Route::resource('/client', clientController::class);
Route::prefix('client')->group(function () {
    Route::get('/filter/{column}', [clientFilterController::class, 'index']);
    Route::post('/filter', [clientFilterController::class, 'filter']);
    Route::get('/sort/{column}/{direction}', [clientFilterController::class, 'sort']);
    Route::get('/search/{search}', [clientFilterController::class, 'search']);
});
require __DIR__ . '/auth.php';
