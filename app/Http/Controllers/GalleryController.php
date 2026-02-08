<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('photos')->get();
        return view('galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }
}