<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PanierController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'verified'])->group(function () {
    // La route index doit être en dernier pour éviter les conflits
    Route::get('/films/{film}/edit', [ApiController::class, 'edit'])->name('films.edit');
    Route::put('/films/{film}', [ApiController::class, 'update'])->name('films.update');
    Route::delete('/films/{film}', [ApiController::class, 'destroy'])->name('films.destroy');
    Route::get('/films/{film}', [ApiController::class, 'getFilmDetail'])->name('detail');
    Route::get('/films', [ApiController::class, 'getFilms'])->name('films.index');
});


Route::get('/stocks', function () {
    return view('stocks');
})->middleware(['auth', 'verified'])->name('stocks');

Route::get('/stocks', [ApiController::class, 'getFilms'])->name('stocks');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/detail', function () {
    return view('detail');
})->middleware(['auth', 'verified'])->name('detail');

Route::get('/films/{filmId}', [ApiController::class, 'getFilmDetail'])->name('detail');

//Route::post('someurl', 'YourController@someMethod');

Route::get('/panier', [PanierController::class, 'index'])->name('panier');
// Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
// Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
// Route::delete('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');


Route::get('/stocks', [ApiController::class, 'getAllStocks'])->name('stocks');
Route::get('/stocks/{id}', [ApiController::class, 'getStockDetail'])->name('stocks.show');
Route::get('/stocks/{id}/update', [ApiController::class, 'getStockUpdate'])->name('stocks.update');
Route::get('/stocks/{id}/delete', [ApiController::class, 'getStockDelete'])->name('stocks.delete');

require __DIR__.'/auth.php';
