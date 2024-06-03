<?php

use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Models\User;
use Prism\Auth\Auth;
use Prism\Http\Response;
use Prism\Routing\Route;

Auth::routes();

Route::get('/', fn () => redirect('/home'));
Route::get('/home', [HomeController::class, 'show']);

Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/create', [ContactController::class, 'create']);
Route::get('/contacts', [ContactController::class, 'store']);