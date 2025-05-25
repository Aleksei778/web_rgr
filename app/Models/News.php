<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'author_id', 'title', 'content', 'preview_image'
    ];

    // Связь с юзерами
    public function category()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
