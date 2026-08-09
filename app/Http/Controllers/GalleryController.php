<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order')->latest('id')->paginate(12)->withQueryString();

        return view('pages.dokumentasi', compact('galleries'));
    }
}
