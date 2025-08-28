<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogGuestController extends Controller
{
    public function show($slug)
    {
        $blog = Blog::with(['user', 'images', 'categories.master'])
            ->where('slug', $slug)
            ->firstOrFail();

        $blog->increment('view_count');

        $page_title = $blog->title;
        $page_description = $blog->summary;
        $page_meta_description = $blog->summary;

        return view('guest.pages.blog.show', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'blog' => $blog,
        ]);
    }
}
