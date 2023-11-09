<?php

namespace App\Http\Controllers;

use App\Models\Sub;
use App\Models\Notification;
use Illuminate\Http\Request;

class SubController extends Controller
{
    public function index(){
        if(count(Sub::get()) > 0){
            $subs = Sub::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $subs = [];
        }
        

        return view('admin.subs.index', ['subs' => $subs]);
    }
    public function searchSub(Request $request){
        if(empty($request['search'])){
            return back()->with('wrong', 'You didn\'t type anything...');
        }
        if(count(Sub::search($request['search'])->get()) > 0){
            $subs = Sub::search($request['search'])->get()->toQuery()->latest()->paginate(10);

            if($subs->count() == 0){
                $subs = [];
            }
    
            return view('admin.subs.index', ['subs' => $subs, 'searchterm' => $request->search]);
        }
        return redirect(route('admin.subs'))->with('wrong', 'We did not find any results...');
    }

    public function create(){
        return view('admin.subs.create');
    }

    public function edit(Sub $sub){
        return view('admin.subs.edit', ['sub' => $sub]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $sub = Sub::create($request->all());

        return redirect(route('sub.edit', ['sub' => $sub]))->with('success','The sub was created');
    }


    public function update(Request $request, Sub $sub){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $sub->name = $request->name;
        $sub->email = $request->email;
        $sub->save();

        return redirect()->back()->with('success','The sub was created');
    }

    public function delete(Sub $sub){
        $sub->delete();

        return redirect()->back()->with('success', 'The subscriber has been deleted!');
    }

    public function deletePage(Request $request){
        if(!Sub::where('email', '=', $request->email)->first()){
            return redirect()->back()->with('wrong', 'A user with this email does not exist...');
        }
        Sub::where('email', '=', $request->email)->first()->delete();

        return redirect()->back()->with('success', 'You have been removed from the list!');
    }

    public function new(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $sub = Sub::create($request->all());

        Notification::create([
            'title' => 'New Subscription from ' . $sub->name,
            'content' => 'A user with name: ' . $sub->name . ' subscribed to the newsletter. <a href="'. route("sub.edit", ["sub" => $sub->id]) . '"> Click to check the user </a>',
            'seen' => false
        ]);

        return redirect()->back()->with('success','Thank you for your subscription!');
    }
}
