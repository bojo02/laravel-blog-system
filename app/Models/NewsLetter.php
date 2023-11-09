<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class NewsLetter extends Model
{
    use HasFactory, Searchable;

    protected $table = 'newsletters';

    protected $fillable = ['title', 'content', 'user_id', 'count', 'subject'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function toSearchableArray(){
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
