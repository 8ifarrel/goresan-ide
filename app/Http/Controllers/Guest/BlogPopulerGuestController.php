<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogPopulerGuestController extends Controller
{
    public function index()
    {
        $page_title = 'Blog Populer';
        $page_description = 'Blog dengan pembaca terbanyak.';
        $page_meta_description = 'Blog populer dan banyak dibaca.';

        $blogs = Blog::with(['user', 'primaryImage', 'categories.master'])
            ->orderByDesc('view_count')
            ->take(12)
            ->get();

        return view('guest.pages.blog.populer.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'blogs' => $blogs,
        ]);
    }
}
