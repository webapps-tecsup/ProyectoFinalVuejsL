<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\CancionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneroController;
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

Route::middleware('auth:sanctum')->resource('/albums', AlbumController::class)->only([
    'destroy', 'index', 'store', 'update',
]);
Route::middleware('auth:sanctum')->resource('/artistas', ArtistaController::class)->only([
    'destroy', 'index', 'store', 'update',
]);
Route::middleware('auth:sanctum')->resource('/canciones', CancionController::class)->only([
    'destroy', 'index', 'store', 'update',
]);

Route::middleware('auth:sanctum')->get('/albums/{id}', [AlbumController::class, 'show']);

Route::middleware('auth:sanctum')->resource('/generos', GeneroController::class)->only([
    'destroy', 'index', 'store', 'update',
]);

// Route::get('/album/{id}', [App\Http\Controllers\AlbumController::class, 'show'])->name('album');

// Route::middleware('auth:sanctum')->post('/subir-musica', [App\Http\Controllers\AlbumController::class, 'subir'])->name('musica');

Route::middleware('auth:sanctum')->get('/canciones_por_artista/{id}', [App\Http\Controllers\CancionController::class, 'cancionesPorArtista'])->name('cancionesPorArtista');

//Autentificacion
Route::post('/user/register', [RegisterController::class, 'create'])->name('create');

Route::post('/user/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/user/info', [UserController::class, 'info'])->name('info');

// Route::delete('/delete/{_id}', [App\Http\Controllers\AlbumController::class, 'destroy']);
// Route::get('/albums', [App\Http\Controllers\AlbumController::class, 'index'])->name('albums');
// Route::post('/albums', [App\Http\Controllers\AlbumController::class, 'create'])->name('create-Albums');
// Route::post('/albums', [App\Http\Controllers\AlbumController::class, 'create'])->name('create-Albums');