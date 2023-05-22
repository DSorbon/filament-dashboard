<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
    ];
}
