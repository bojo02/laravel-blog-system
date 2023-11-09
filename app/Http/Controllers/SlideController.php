<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index(){
        if(count(Slide::get()) > 0){
            $slides = Slide::get()->toQuery()->orderBy('order')->paginate(10);
        }
        else{
            $slides = [];
        }
        

        return view("admin.slides.index",compact("slides"));
    }
    public function create(){
        return view('admin.slides.create');
    }

    public function edit(Slide $slide){
        return view('admin.slides.edit', ['slide' => $slide]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $slide = Slide::create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order
        ]);

        Storage::put('/public/slides/', $request->file('image'));

        Image::create([
            'image_path' => '/storage/slides/' . $request->file('image')->hashName(),
            'imageable_type' => 'App\Models\Slide',
            'imageable_id' => $slide->id,
        ]);

        return redirect(route('slide.edit', ['slide' => $slide->id]))->with('success', 'The slide has been created!');
    }

    public function update(Request $request, Slide $slide){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if($request->has('image')){
            $request->validate([
                'image' => 'required|image',
            ]);

            Storage::delete(str_replace('storage', 'public', $slide->image->image_path));

            $slide->image->delete();

            Storage::put('/public/slides/', $request->file('image'));

            Image::create([
                'image_path' => '/storage/slides/' . $request->file('image')->hashName(),
                'imageable_type' => 'App\Models\Slide',
                'imageable_id' => $slide->id
            ]);
        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->order = $request->order;

        $slide->save();

        return redirect()->back()->with('success', 'The slide has been updated!');

    }

    public function delete(Slide $slide){
        Storage::delete(str_replace('storage', 'public', $slide->image->image_path));

        $slide->image->delete();

        $slide->delete();

        return redirect()->back()->with('success','The slide was deleted!');
    }
}
