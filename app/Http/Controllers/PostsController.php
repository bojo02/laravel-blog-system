<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Post::all()->count() > 0){
            $posts = Post::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $posts = [];
        }

        return view('posts.index', ['posts' => $posts]);
    }

    public function indexAdmin()
    {
        if(Post::all()->count() > 0){
            $posts = Post::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $posts = [];
        }
        

        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function searchPost(Request $request){
        if(empty($request['search'])){
            return back()->with('wrong', 'You didn\'t type anything...');
        }
        if(count(Post::search($request['search'])->get()) > 0){
            $posts = Post::search($request['search'])->get()->toQuery()->latest()->paginate(10);

            if($posts->count() == 0){
                $posts = [];
            }
    
            return view('posts.search', ['posts' => $posts, 'searchterm' => $request->search]);
        }
        return back()->with('wrong', 'We did not find any results...');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image',
            'categories' => 'required|array|min:1',
            'permalink' => ['required', Rule::unique('posts', 'permalink')],

        ]);

        $incomingFields['user_id'] = auth()->user()->id;

        $post = Post::create($incomingFields);

        if(isset($request['tags'])){

            Tag::create([
                'tags' => $request->tags,
                'taggable_id' => $post->id,
                'taggable_type' => 'App\Models\Post'
            ]);

        }

        foreach($request['categories'] as $category){
            PostCategory::create([
                'post_id' => $post->id,
                'category_id' => $category
            ]);
        }

        Storage::put('/public/posts/', $request->file('image'));

        Image::create(['image_path' => '/storage/posts/'. $request->file('image')->hashName(), 'imageable_type' => 'App\Models\Post', 'imageable_id' => $post->id]);

        return redirect(route('post.admin.edit', ['post' => $post['id']]))->with('success', 'The post has been created!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $tags = explode (",", $post->tags->tags);  

        return view('posts.show', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::get();

        return view('admin.posts.edit', ['post' => $post, 'tags' => $post->tags, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($post->permalink != $request->permalink){
            $incomingFields = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'categories' => 'required|array|min:1',
                'permalink' => ['required', Rule::unique('posts', 'permalink')],
            ]);

            $post->permalink = $incomingFields['permalink'];
        }
        else{
            $incomingFields = $request->validate([
                'title' => 'required',
                'categories' => 'required|array|min:1',
                'content' => 'required',
            ]);
        }
       

        $incomingFields['user_id'] = auth()->user()->id;

        $post->title = $incomingFields['title'];
        $post->content = $incomingFields['content'];
        
        $post->user_id = $incomingFields['user_id'];

        $post->save();

        if(isset($request['tags'])){

            if(!empty($post->tags)){
                $post->tags->delete();
            }
            

            Tag::create([
                'tags' => $request->tags,
                'taggable_id' => $post->id,
                'taggable_type' => 'App\Models\Post'
            ]);

        }

        if($request->file('image')){
            $incomingFields = $request->validate([
                'image' => 'required|image',
            ]);

            $post->image->delete();

            Storage::put('/public/posts/', $request->file('image'));

            Storage::delete(str_replace("storage", "public", $post->image->image_path) );

            Image::create(['image_path' => '/storage/posts/'. $request->file('image')->hashName(), 'imageable_type' => 'App\Models\Post', 'imageable_id' => $post->id]);
        }

        $postCategories = PostCategory::where('post_id', "=", $post->id)->get();

        foreach($postCategories as $postCat){
            $postCat->delete();
        }
       
        foreach($request['categories'] as $category){
            PostCategory::create([
                'post_id' => $post->id,
                'category_id' => $category
            ]);
        }

        return redirect(route('post.admin.edit', ['post' => $post['id']]))->with('success', 'The post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete(str_replace("storage", "public", $post->image->image_path) );

        $post->image->delete();

        $post->tags->delete();

        $post->delete();

        return redirect()->back()->with('success', 'The post has been deleted!');
    }

    public function slugify($text, string $divider = '-')
    {
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
    }
}

