<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'news';

    public $translatable = ['title', 'content'];

    protected $fillable = [
        'author_id', 'title', 'content', 'preview_image'
    ];
}
