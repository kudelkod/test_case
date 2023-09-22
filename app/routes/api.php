<?php

use App\Http\Controllers\Auth\AuthController;
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

Route::get('/', function (){
    $request  = new \App\Models\Request();
    \App\Events\ResolveRequestEvent::dispatch($request->find(3));
    return true;
});

Route::group(['prefix' => 'auth/'], function ($route){
    $route->post('sign_in/', [AuthController::class, 'login'])->name('auth.sign_in');
    $route->post('sign_up/', [AuthController::class, 'register'])->name('auth.sign_up');
    $route->post('refresh/', [AuthController::class, 'refresh'])->name('auth.refresh');
    $route->post('logout/', [AuthController::class, 'logout'])->name('auth.logout');
});
