<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'permalink',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags(): MorphOne
    {
        return $this->morphOne(Tag::class, 'taggable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->hasManyThrough(Category::class, PostCategory::class, 'post_id', 'id', 'id', 'category_id');
    }
    public function toSearchableArray(){
        return [
            'title' => $this->title,
            'content' => $this->lastname,
        ];
    }
}
