<?php

use App\Models\User;
use Prism\Auth\Auth;
use Prism\Http\Response;
use Prism\Routing\Route;

Auth::routes();

Route::get('/', function () {
    if (isGuest()) {
        return Response::text('Guest');
    }

    return Response::text(auth()->name);
});

Route::get('/form', fn () => view("form"));
Route::get('/user/{user}', fn (User $user) => json($user->toArray()));
Route::get('/route/{param}', fn (string $param) => json(["param" => $param]));