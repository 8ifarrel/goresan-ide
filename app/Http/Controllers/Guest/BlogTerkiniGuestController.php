<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategoryMaster;
use Illuminate\Http\Request;

class BlogTerkiniGuestController extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Blog Terkini';
        $page_description = 'Kumpulan blog terbaru dari berbagai penulis.';
        $page_meta_description = 'Blog terkini, terbaru, dan terupdate.';

        $search = $request->query('search');
        $category = $request->query('category');
        $categoryArr = is_array($category) ? array_filter($category) : ($category ? [$category] : []);

        $blogs = Blog::with(['user', 'primaryImage', 'categories.master'])
            ->when($search, function ($q) use ($search) {
                $q->where(function($qq) use ($search) {
                    $qq->where('title', 'like', "%$search%")
                       ->orWhere('summary', 'like', "%$search%");
                });
            })
            ->when($categoryArr, function ($q) use ($categoryArr) {
                $q->whereHas('categories.master', function($qq) use ($categoryArr) {
                    $qq->whereIn('name', $categoryArr);
                });
            })
            ->latest()
            ->paginate(12)
            ->appends(['search' => $search, 'category' => $categoryArr]);

        $categories = BlogCategoryMaster::orderBy('name')->get();

        return view('guest.pages.blog.terkini.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
            'blogs' => $blogs,
            'categories' => $categories,
            'search' => $search,
            'selectedCategory' => $categoryArr,
        ]);
    }
}
