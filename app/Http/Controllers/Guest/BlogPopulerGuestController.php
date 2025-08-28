<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategoryMaster;
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
        $category = $request->query('category');
        $categoryArr = is_array($category) ? array_filter($category) : ($category ? [$category] : []);

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
            ->when($categoryArr, function ($q) use ($categoryArr) {
                $q->whereHas('categories.master', function($qq) use ($categoryArr) {
                    $qq->whereIn('name', $categoryArr);
                });
            })
            ->orderByDesc('view_count')
            ->paginate(12)
            ->appends(['filter' => $filter, 'category' => $categoryArr]);

        $categories = BlogCategoryMaster::orderBy('name')->get();

        return view('guest.pages.blog.populer.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'blogs' => $blogs,
            'filter' => $filter,
            'categories' => $categories,
            'selectedCategory' => $categoryArr,
        ]);
    }
}
