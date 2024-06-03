<?php

use App\Controllers\HomeController;
use Prism\Auth\Auth;
use Prism\Routing\Route;

Auth::routes();

Route::get('/', fn () => redirect('/home'));
Route::get('/home', [HomeController::class, 'show']);