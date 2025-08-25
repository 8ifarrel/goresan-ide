<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaGuestController extends Controller
{
    public function index()
    {   
        $page_title = 'Beranda';
        $page_description = 'Some description for the page';
        $page_meta_description = 'Some meta description for the page';

        return view('guest.pages.beranda.index', [
            'page_title' => $page_title,
            'page_description' => $page_description,
            'page_meta_description' => $page_meta_description,
        ]);
    }
}
