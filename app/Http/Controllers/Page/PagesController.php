<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\ContentController;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('pages.welcome');
    }

    public function home()
    {
        //return view('pages.home');
        return (new ContentController(request()))->index();
    }
}
