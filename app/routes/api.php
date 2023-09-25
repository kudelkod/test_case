<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Request\RequestController;
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

Route::group(['prefix' => 'auth/'], function ($route){
    $route->post('sign_in/', [AuthController::class, 'login'])->name('auth.sign_in');
    $route->post('sign_up/', [AuthController::class, 'register'])->name('auth.sign_up');
    $route->post('refresh/', [AuthController::class, 'refresh'])->name('auth.refresh');
    $route->post('logout/', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'requests/'], function ($route){
    $route->put('/{id}', [RequestController::class, 'resolveRequest'])->middleware('auth')->name('requests.resolve_requests');
    $route->get('/', [RequestController::class, 'getRequests'])->middleware('auth')->name('requests.get_requests');
    $route->post('/', [RequestController::class, 'createRequest'])->name('requests.send_request');
});
