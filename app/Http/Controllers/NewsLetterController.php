<?php

namespace App\Http\Controllers;

use App\Models\Sub;
use App\Models\NewsLetter;
use App\Jobs\SendNewsLetterToSubs;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function index(){
        if(count(NewsLetter::get()) > 0){
            $newsletters = NewsLetter::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $newsletters = [];
        }
        return view('admin.newsletters.index', ['newsletters' => $newsletters]);
    }

    public function create(){
        return view('admin.newsletters.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);

        $newsLetter = NewsLetter::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'subject' => $request->subject,
            'count' => 0,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('newsletter.edit', ['newsLetter' => $newsLetter->id])->with('success','The newsletter was created!');
    }

    public function edit(NewsLetter $newsLetter){
        return view('admin.newsletters.edit', ['newsletter'=> $newsLetter]);
    }

    public function update(Request $request, NewsLetter $newsLetter){
        $request->validate([
            'title' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);

        $newsLetter ->update([
            'title'=> $request->title,
            'content'=> $request->content,
            'subject' => $request->subject,
            'count' => 0,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success','The newsletter was updated!');
    }

    public function delete(NewsLetter $newsLetter){
        $newsLetter->delete();

        return redirect()->back()->with('success', 'The News Letter was deleted!');
    }

    public function sendToSubs(NewsLetter $newsLetter){
        $subs = Sub::get();

        foreach($subs as $sub){
            $this->createJob($newsLetter, $sub);
        }

        $newsLetter->count = count($subs);
        $newsLetter->save();

        return redirect()->back()->with('success', 'The NewsLetter was sent to: ' . $newsLetter->count . ' users.');
    }

    public function createJob($newsLetter, $sub){
        dispatch(new SendNewsLetterToSubs($newsLetter, $sub));
    }

    public function searchNewsletter(Request $request){
        if(empty($request['search'])){
            return back()->with('wrong', 'You didn\'t type anything...');
        }
        if(count(NewsLetter::search($request['search'])->get()) > 0){
            $newsletters = Newsletter::search($request['search'])->get()->toQuery()->latest()->paginate(10);

            if($newsletters->count() == 0){
                $newsletters = [];
            }
    
            return view('admin.newsletters.index', ['newsletters' => $newsletters, 'searchterm' => $request->search]);
        }
        return redirect(route('admin.newsletters'))->with('wrong', 'We did not find any results...');
    }

    public function show(NewsLetter $newsLetter){
        return view('admin.newsletters.show', ['newsletter' => $newsLetter]);
    }
}
