<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('pages.welcome');
    }

    public function home()
    {
        return view('pages.home');
    }
}
