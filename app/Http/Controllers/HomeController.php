<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Serial;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $movies = Movie::orderBy('created_at', 'desc')->take(4)->get();
        $serial = Serial::orderBy('created_at', 'desc')->take(4)->get();
        return view('home', compact('movies', 'serial'));
    }
}
