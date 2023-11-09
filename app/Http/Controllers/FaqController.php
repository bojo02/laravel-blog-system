<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        if(count(Faq::get()) > 0){
            $faqs = Faq::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $faqs = [];
        }

        return view('admin.faq.index', ['faqs' => $faqs]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $faq = Faq::create([
            'title'=> $request->title,
            'content'=> $request->content
        ]);

        return redirect(route('faq.edit', ['faq' => $faq->id]))->with('success', 'The FAQ was created!');
    }

    public function delete(Faq $faq){
        $faq->delete();

        return redirect()->back()->with('success', 'The FAQ was deleted!');
    }

    public function create(){
        return view('admin.faq.create');
    }
    public function edit(Faq $faq){
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq){
        $request->validate([
            'title'=> 'required',
            'content'=> 'required'
        ]);

        $faq->update($request->all());

        return redirect()->back()->with('success', 'The FAQ was updated!');
    }
}
