<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayerController;

// Rutas de información simple (pueden quedarse como funciones o Route::view)
Route::view('/', 'pages.index')->name('index');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/location', 'pages.location')->name('where-to-find-us');

// Rutas que requieren lógica (necesitan controladores)
Route::get('/jugadores', [EventController::class, 'jugadores'])->name('jugadores');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/tienda', [EventController::class, 'tienda'])->name('tienda');

// Rutas de autenticación
Route::get('login', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('signup', [LoginController::class, 'signupForm'])->name('signup');
Route::post('signup', [LoginController::class, 'signup'])->name('signup.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('account', [LoginController::class, 'account'])->name('users.account');

// Rutas de administración
/* Route::get('/añadir-jugador', [EventController::class, 'añadirJugador'])->name('players.store'); */
Route::get('/añadir-evento', [EventController::class, 'añadirEvento'])->name('events.store');
Route::get('/mensaje', [EventController::class, 'mensaje'])->name('mensaje');

Route::middleware('auth')->group(function () {
    Route::delete('/account/delete', [LoginController::class, 'destroy'])->name('users.destroy');
});

// Rutas de recursos para jugadores (CRUD)
Route::resource('jugadores', PlayerController::class);
