<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Slide;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $posts = Post::orderBy('id', 'desc')->take(3)->get();
        if(Slide::count() > 0){
            $slides = Slide::get()->toQuery()->orderBy('order')->get();
        }else{
            $slides = [];
        }
        if(Faq::count() > 0){
            $faqs = Faq::get();
        }else{
            $faqs = [];
        }

        return view('home', ['posts' => $posts, 'slides' => $slides, 'faqs' => $faqs]);
    }

    public function contact(){
        return view('contact');
    }
}
