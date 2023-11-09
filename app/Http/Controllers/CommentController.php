<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment' => ['required', 'min:10'],
            'commentable_id' => ['required']
        ]);

        $comment = Comment::create([
            'content' => $request->comment,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => 'App\Models\Post',
            'user_id' => auth()->user()->id
        ]);

        Notification::create([
            'title' => 'New Comment from ' . $comment->user->name,
            'content' => 'A user with id: ' . $comment->user->id . ' published a <a href="'. route("comment.admin.edit", ["comment" => $comment->id]). '">comment</a>. User: <a href="'. route('user.admin.edit', ['user' => $comment->user->id]) .'">'. $comment->user->name . ' ' . $comment->user_lastname . '</a>',
            'seen' => false
        ]);

        return redirect()->back()->with('success', 'Your comment has been posted!');
    }

    public function indexAdmin(){
        if(Comment::get()->count() != 0){
            $comments = Comment::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $comments = [];
        }
        

        return view('admin.comments.index', ['comments' => $comments]);
    }
    public function edit(Comment $comment){
        return view('admin.comments.edit', ['comment' => $comment]);
    }
    public function update(Request $request, Comment $comment){
       $request->validate([
        'comment' => 'required|min:10'
       ]);

       $comment->content = $request->comment;
       $comment->save();

       return redirect()->back()->with('success', 'The comment has been updated!');
    }
    public function destroy(Comment $comment){
        $comment->delete();

        return redirect()->back()->with('success', 'The comment has been deleted!');
    }
}
