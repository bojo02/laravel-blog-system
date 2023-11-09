<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tags',
        'taggable_type',
        'taggable_id'
    ];

    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }
}
