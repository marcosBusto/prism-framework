<?php

use Prism\Http\Response;
use Prism\Routing\Route;

Route::get('/', fn ($request) => Response::text("Prism Framework"));
Route::get('/form', fn ($request) => view("form"));