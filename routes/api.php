<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageGalleryController;
use App\Http\Controllers\PackageItemController;
use App\Http\Controllers\PackageScheduleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Package;
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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => ['jwt.verify']], function () {
   Route::get('logout', [ApiController::class, 'logout']);
   Route::get('products', [ProductController::class, 'index']);
   Route::get('products/{id}', [ProductController::class, 'show']);
   Route::post('create', [ProductController::class, 'store']);
   Route::put('update/{product}',  [ProductController::class, 'update']);
   Route::delete('delete/{product}',  [ProductController::class, 'destroy']);
   // User
   Route::group([
      'prefix' => 'user',
      'as' => 'user'
   ], function () {
      Route::get('/show', [UserController::class, 'index']);
      Route::get('/list', [UserController::class, 'list']);
      Route::get('/{id}', [UserController::class, 'show']);
      Route::put('/update', [UserController::class, 'update']);
      Route::delete('/{id}', [UserController::class, 'destroy']);
   });
   // Package
   Route::group([
      'prefix' => 'package',
      'as' => 'package'
   ], function () {
      Route::get('', [PackageController::class, 'index']);
      Route::get('/{id}', [PackageController::class, 'show']);
      Route::post('', [PackageController::class, 'store']);
      Route::put('/{package}',  [PackageController::class, 'update']);
      Route::delete('/{package}',  [PackageController::class, 'destroy']);

      Route::post('/{package}/gallery', [PackageGalleryController::class, 'store']);
      Route::post('/{package}/schedule', [PackageScheduleController::class, 'store']);
      Route::post('/{package}/item', [PackageItemController::class, 'store']);
   });
});
