<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCompanyAwards extends Model
{
    protected $table = "awards";

    protected $fillable = [
        'title', 'content'
    ];
}
