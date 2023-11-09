<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Sub extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'email'
    ];

    public function toSearchableArray(){
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
