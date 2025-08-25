<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BerandaGuestController extends Controller
{
    public function index()
    {   
        $page_title = 'Beranda';
        $page_description = 'Some description for the page';
        $page_meta_description = 'Some meta description for the page';

        // Ambil 3 blog paling populer
        $populer = Blog::with(['user', 'primaryImage', 'categories.master'])
            ->orderByDesc('view_count')
            ->take(3)
            ->get();

        // Ambil 6 blog terbaru
        $terkini = Blog::with(['user', 'primaryImage', 'categories.master'])
            ->latest()
            ->take(6)
            ->get();

        return view('guest.pages.beranda.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'populer' => $populer,
            'terkini' => $terkini,
        ]);
    }
}
