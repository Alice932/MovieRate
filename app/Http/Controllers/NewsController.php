<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(12);
        return view('news.index', compact('news'));
    }
    public function show($id)
    {
        $new = News::find($id);
        return view('news.show', ['new' => $new]);
    }
}
