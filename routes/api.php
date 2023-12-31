<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthUserApiController;
use App\Http\Controllers\CategoryController;

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

Route::group(['prefix' =>'users', 'controller' => UserController::class], function(){
    Route::get('/', 'index');
    Route::get('/{user}', 'show');
    Route::post('/', 'store');
    Route::put('/{user}', 'update');
    Route::delete('/{user}', 'destroy');

});

Route::group(['prefix' =>'authors', 'controller' => AuthorController::class], function(){
    Route::get('/', 'index');
    Route::get('/{author}', 'show');
    Route::post('/', 'store');
    Route::put('/{author}', 'update');
    Route::delete('/{author}', 'destroy');

});
Route::group(['prefix' =>'books', 'controller' => BookController::class], function(){
    Route::get('/', 'index');
    Route::get('/{book}', 'show');
    Route::post('/', 'store');
    Route::put('/{book}', 'update');
    Route::delete('/{book}', 'destroy');

});
Route::group(['prefix' =>'categories', 'controller' => CategoryController::class], function(){
    Route::get('/', 'index');
    Route::get('/{category}', 'show');
    Route::post('/', 'store');
    Route::put('/{category}', 'update');
    Route::delete('/{category}', 'destroy');
});

Route::post('/login', [AuthUserApiController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);


/* The `Route::group(['middleware' =>['auth:sanctum']], function(){})` is creating a group of routes
that require authentication using the Sanctum middleware. This means that any routes defined within
this group can only be accessed by authenticated users. */
Route::group(['middleware' =>['auth:sanctum']], function(){
    Route::post('/logout', [AuthUserApiController::class, 'logout']);
    Route::get('/profile', [AuthUserApiController::class, 'profile']);

    Route::group(['prefix' =>'users', 'controller' => UserController::class], function(){
        Route::get('/', 'index');
        Route::get('/{user}', 'show');
        Route::post('/', 'store');
        Route::put('/{user}', 'update');
        Route::delete('/{user}', 'destroy');
    });
});
