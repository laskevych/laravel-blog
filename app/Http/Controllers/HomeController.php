<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', ['meta_title' => __('Home')]);
    }

    public function contact()
    {
        return view('contact', ['meta_title' => __('Contact')]);
    }

    public function secret()
    {
        return view('secret', ['meta_title' => __('Secret')]);
    }
}
