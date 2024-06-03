<?php

namespace App\Controllers;

use Prism\Http\Controller;

class HomeController extends Controller {
    public function show() {
        return view('home');
    }
}