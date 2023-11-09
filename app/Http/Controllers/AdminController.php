<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::count();

        $posts = Post::count();

        $comments = Comment::count();

        return view('admin.dashboard', ['posts' => $posts, 'users' => $users, 'comments' => $comments]);
    }
}
