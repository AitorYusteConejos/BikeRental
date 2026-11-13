<?php


use App\Http\Controllers\BikeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/


// Catálogo de bicicletas
Route::get('/', [BikeController::class, 'index'])
    ->name('bikes.index');


// Detalle de una bicicleta
Route::get('/bikes/{bike}', [BikeController::class, 'show'])
    ->name('bikes.show');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {
    // Reservar una bicicleta
    Route::get('/bikes/{bike}/book', [BookingController::class, 'create'])
        ->name('bookings.create');


    Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');


    // Consultar y cancelar reservas propias
    Route::get('/my-bookings', [BookingController::class, 'index'])
        ->name('bookings.index');


    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');


    Route::patch('/my-bookings/{booking}/cancel', [BookingController::class, 'cancel'])
        ->name('bookings.cancel');


    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');


    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';