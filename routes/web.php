<?php

use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\client\clientController;
use App\Http\Controllers\project\projectController;
use App\Http\Controllers\filter\clientFilterController;
use App\Http\Controllers\filter\projectFilterController;
use App\Http\Controllers\filter\employeeFilterController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\teamController;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;

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


Route::middleware('auth')->group(function () {});
// Route for employee
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
// Route for client
Route::resource('/project', projectController::class);

Route::prefix('project')->group(function () {
    Route::get('/filter/{column}', [projectFilterController::class, 'index']);
    Route::post('/filter', [projectFilterController::class, 'filter']);
    Route::get('/sort/{column}/{direction}', [projectFilterController::class, 'sort']);
    Route::get('/search/{search}', [projectFilterController::class, 'search']);
    Route::post('/assignTeam', [teamController::class, 'assign']);
    Route::get('/getTeam/{id}', [teamController::class, 'listTeam']);
});
// Route for task
Route::resource('/task', taskController::class);
Route::prefix('task')->group(function () {
    Route::post('/updateStatus', [taskController::class, 'updateStatus']);
    Route::post('/assignCoolab', [taskController::class, 'assignCoolab']);
    Route::post('/assignAttachment', [taskController::class, 'assignAttachment']);
    Route::delete('/deleteAttachment/{id}', [taskController::class, 'deleteAttachment']);
});
// TODO: Get client for select input
Route::get('/getClient', function () {
    $clients = Cache::rememberForever('clientList', function () {
        return Client::all();
    });
    return response()->json($clients);
});
// TODO: Get employee for select input
Route::get('/getEmployee', function () {
    $employees = Cache::rememberForever('employeeList', function () {
        return Employee::all();
    });
    return response()->json($employees);
});
// TODO: Get employee for select input
Route::get('/getProject', function () {
    $projects = Cache::rememberForever('projectList', function () {
        return Project::all();
    });
    return response()->json($projects);
});

// TODO: Counting route
Route::get('/counting', function () {
    $count = [];
    $count['client'] = Client::count();
    $count['employee'] = Employee::count();
    $count['projects'] = Project::count();
    $count['amount'] = Project::sum('amount');
    return response()->json($count);
});
require __DIR__ . '/auth.php';
