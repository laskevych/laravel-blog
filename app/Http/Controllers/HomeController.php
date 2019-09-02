<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', ['meta_title' => __('Home')]);
    }
    
    public function about()
    {
        return view('about', ['meta_title' => __('About')]);
    }

    public function secret()
    {
        return view('secret', ['meta_title' => __('Secret')]);
    }
}
