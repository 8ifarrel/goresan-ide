<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogTerkiniGuestController extends Controller
{
    public function index()
    {
        $page_title = 'Blog Terkini';
        $page_description = 'Kumpulan blog terbaru dari berbagai penulis.';
        $page_meta_description = 'Blog terkini, terbaru, dan terupdate.';

        $blogs = Blog::with(['user', 'primaryImage', 'categories.master'])
            ->latest()
            ->take(12)
            ->get();

        return view('guest.pages.blog.terkini.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'blogs' => $blogs,
        ]);
    }
}
