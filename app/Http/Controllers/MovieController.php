<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(12);
        return view('movies.index', compact('movies'));
    }
    public function show($id)
        {
        $movie = Movie::find($id);
        return view('movies.show', ['movie' => $movie]);
        }
}
