<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogGuestController extends Controller
{
    public function show()
    {
        $page_title = 'Blog';
        $page_description = 'Some description for the page';
        $page_meta_description = 'Some meta description for the page';

        return view('guest.pages.blog.show', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
        ]);
    }
}
