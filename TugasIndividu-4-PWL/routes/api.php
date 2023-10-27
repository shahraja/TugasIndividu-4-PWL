<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware (['guest']) -> group (function () {
    Route::prefix ('/user') -> group (function () {
        Route::controller (UserController::class) -> group (function () {
            Route::get('/login', 'unauthorize') -> name('login');
            Route::post('/register', 'register');
            Route::post('/login', 'login');
        });
    });
});


Route::middleware (['auth:api']) -> group (function () {
    Route::get('/user/logout', [UserController::class, 'logout']);

    Route::prefix ('/laptop') -> group (function () {
        Route::controller (LaptopController::class) -> group (function () {
            Route::post('update/{laptop}', 'update');
            Route::get('delete/{laptop}', 'delete');
            Route::post('create', 'create');
            Route::get('read', 'read');
        });
    });
});