<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index(){
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->get();
        return view('posts.index')->with('posts',$posts);
    }

    public function about(){
        $data = array(
            'title'=>'services',
            'services'=>['SEO','Web Design','Software Development']
        );
        return view('pages.about')->with($data);
    }
}
