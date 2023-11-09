<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('parent_id', '=', 0)->latest()->paginate(10);

        return view('admin.categories.index', ['categories' => $categories]);
    }
    public function create(){
        $categories = Category::get();

        return view('admin.categories.create', ['categories' => $categories]);
    }
    public function edit(Category $category){
        $categories = Category::get();

        return view('admin.categories.edit', ['categories' => $categories, 'category' => $category]);
    }
    
    public function store(Request $request){
        if($request->has('category')){
            $request->validate([
                'name' => 'required',
                'slug' => ['required', Rule::unique('categories', 'slug')],
                'category' => 'required'
            ]);

            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->category
            ]);
        }
        else{
            $request->validate([
                'name' => 'required',
            ]);

            $category = Category::create([
                'name' => $request->name,
                'parent_id' => 0
            ]);
        }
        
        return redirect(route('category.admin.edit', ['category' => $category->id]))->with('success', 'The category has been created!');
    }

    public function delete(Category $category){
        $this->deleteRecursive($category);

        $category->delete();

        return redirect()->back()->with('success', 'The category has been deleted!');
    }

    public function deleteRecursive($category){
        foreach($category->subCategory as $sub){
            if(!empty($sub->subCategory)){
                $this->deleteRecursive($sub);
            }

            $sub->delete();
        }
    }

    public function update(Category $category, Request $request){
        if($category->slug != $request->slug){
            $request->validate([
                'name' => 'required',
                'slug' => ['required', Rule::unique('categories', 'slug')],
            ]);
        }
        else{
            $request->validate([
                'name' => 'required',
            ]);
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->category;

        $category->save();
        
        
        return redirect()->back()->with('success', 'The category has been updated!');
    }

    public function indexCategories(Category $category)
    {
        $posts = $this->getAllPostsFromCategoriesAndSubs($category);

        $sorted = $posts->sortBy('created_at')->reverse();

        $postsPagination = collect($sorted)->paginate(10);


        return view('admin.posts.category-posts', ['posts' => $postsPagination, 'category' => $category]);
    }

    private function getAllPostsFromCategoriesAndSubs($category){
        $posts = $category->posts;

        foreach($category->subCategory as $cat){
            $posts = $posts->merge($cat->posts);

            $posts = $posts->merge($this->getAllPostsFromCategoriesAndSubs($cat));

        }

        return $posts;
    }
}
