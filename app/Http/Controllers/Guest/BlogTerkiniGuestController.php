<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogTerkiniGuestController extends Controller
{
    public function index()
    {
        $page_title = 'Blog Terkini';
        $page_description = 'Some description for the page';
        $page_meta_description = 'Some meta description for the page';

        return view('guest.pages.blog.terkini.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
        ]);
    }
}
