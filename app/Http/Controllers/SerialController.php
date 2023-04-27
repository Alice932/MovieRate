<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serial;

class SerialController extends Controller
{
    public function index()
    {
        $serials = Serial::all();
        return view('serials.index', compact('serials'));
    }

    public function show(Serial $serial)
    {
        return view('serials.show', compact('serial'));
    }
}
