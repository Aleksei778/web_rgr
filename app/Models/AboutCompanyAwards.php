<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutCompanyAwards extends Model
{
    use HasTranslations;

    protected $table = "awards";

    protected $fillable = [
        'title', 'content'
    ];

    public $translatable = ['title', 'content'];
}
