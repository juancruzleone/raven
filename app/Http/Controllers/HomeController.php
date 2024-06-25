<?php

namespace App\Http\Controllers;

use App\Models\Post; 

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::orderBy('created_at', 'desc')->limit(2)->get();

        return view('home', ['featuredPosts' => $featuredPosts]);
        
    }

    public function vip()
    {
        return view('vip'); 
    }
}
