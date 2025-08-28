<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BlogPopulerGuestController extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Blog Populer';
        $page_description = 'Blog dengan pembaca terbanyak.';
        $page_meta_description = 'Blog populer dan banyak dibaca.';

        $filter = $request->query('filter', 'month');
        $blogs = Blog::with(['user', 'primaryImage', 'categories.master'])
            ->when($filter === 'week', function ($q) {
                $q->where('created_at', '>=', now()->subWeek());
            })
            ->when($filter === 'month', function ($q) {
                $q->where('created_at', '>=', now()->subMonth());
            })
            ->when($filter === 'year', function ($q) {
                $q->where('created_at', '>=', now()->subYear());
            })
            // 'all' tidak ada filter waktu
            ->orderByDesc('view_count')
            ->paginate(12)
            ->appends(['filter' => $filter]);

        return view('guest.pages.blog.populer.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'blogs' => $blogs,
            'filter' => $filter,
        ]);
    }
}
