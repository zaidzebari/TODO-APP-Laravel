<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutCotroller extends Controller
{
    public function index() {
        return inertia('AboutPage');
    }
}
