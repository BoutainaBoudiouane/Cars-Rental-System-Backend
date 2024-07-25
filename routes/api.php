<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ImageController;


/* 
Route::middleware('auth:sanctum')->group(function () {
    
}); */

Route::prefix('v1')->group(function () {

    // Users routes
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Cars routes
    Route::get('/cars', [CarController::class, 'index']);
    Route::post('/cars', [CarController::class, 'store']);
    Route::get('/cars/{car}', [CarController::class, 'show']);
    Route::put('/cars/{car}', [CarController::class, 'update']);
    Route::delete('/cars/{car}', [CarController::class, 'destroy']);

    // Rentals routes
    Route::get('/rentals', [RentalController::class, 'index']);
    /* Route::post('/rentals', [RentalController::class, 'store']); */
    Route::get('/rentals/{rental}', [RentalController::class, 'show']);
    Route::put('/rentals/{rental}', [RentalController::class, 'update']);
    Route::delete('/rentals/{rental}', [RentalController::class, 'destroy']);

    // Authentication routes
    Route::group(['middleware' => ['web']], function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('/rentals', [RentalController::class, 'store']);
    Route::get('/user/rented-cars/{user}', [UserController::class, 'getRentedCars']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:sanctum');
});
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

   
});
Route::get('/images/{filename}', [ImageController::class, 'getImage'])->name('images.show');




/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */