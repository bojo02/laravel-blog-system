<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    public function subCategory(){
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts(){
        return $this->hasManyThrough(Post::class, PostCategory::class, 'category_id', 'id', 'id', 'post_id');
    }
}
