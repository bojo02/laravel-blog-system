<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'commentable_type', 'commentable_id', 'user_id'];

    public function commetable() : MorphTo{
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
