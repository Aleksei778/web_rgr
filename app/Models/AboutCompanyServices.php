<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutCompanyServices extends Model
{
    use HasTranslations;

    protected $table = "services";

    protected $fillable = [
        'title', 'content'
    ];

    public $translatable = ['title', 'content'];
}
