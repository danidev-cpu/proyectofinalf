<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ContactController;

// Rutas de información simple (pueden quedarse como funciones o Route::view)
Route::view('/', 'pages.index')->name('index');
Route::view('/location', 'pages.location')->name('where-to-find-us');
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-conditions', 'pages.terms-conditions')->name('terms-conditions');

// Rutas de contacto
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas que requieren lógica (necesitan controladores)
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/tienda', [EventController::class, 'tienda'])->name('tienda');

// Rutas de autenticación
Route::get('login', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('signup', [LoginController::class, 'signupForm'])->name('signup');
Route::post('signup', [LoginController::class, 'signup'])->name('signup.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('account', [LoginController::class, 'account'])->name('users.account')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::delete('/account/delete', [LoginController::class, 'destroy'])->name('users.destroy');
    Route::post('/events/{event}/like', [EventController::class, 'toggleLike'])->name('events.like');
});

// Rutas de recursos para jugadores (CRUD) - públicas para ver, protegidas para crear/editar
Route::get('/jugadores', [PlayersController::class, 'index'])->name('jugadores.index');

// Rutas protegidas para admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::delete('/events/{event}/players/{player}', [EventController::class, 'detachPlayer'])->name('events.players.detach');

    Route::get('/añadir-evento', [EventController::class, 'create'])->name('events.legacy.create');
    Route::get('/mensajes', [ContactController::class, 'index'])->name('mensaje');
    Route::get('/mensajes/{message}', [ContactController::class, 'showMessage'])->name('mensaje.show');
    Route::delete('/mensajes/{message}', [ContactController::class, 'destroyMessage'])->name('mensaje.destroy');
    Route::get('/jugadores/create', [PlayersController::class, 'create'])->name('jugadores.create');
    Route::post('/jugadores', [PlayersController::class, 'store'])->name('jugadores.store');
    Route::post('/jugadores/{id}/toggle-visibility', [PlayersController::class, 'toggleVisibility'])->name('jugadores.toggleVisibility');
});

Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show')->middleware('auth');

Route::get('/jugadores/{jugadore}', [PlayersController::class, 'show'])->name('jugadores.show')->middleware('auth');
