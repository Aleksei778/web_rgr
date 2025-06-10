<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutCompanyHistory extends Model
{
    use HasTranslations;

    protected $table = "history";

    protected $fillable = [
        'title', 'content'
    ];

    public $translatable = ['title', 'content'];
}
