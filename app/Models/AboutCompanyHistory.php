<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCompanyHistory extends Model
{
    protected $table = "history";

    protected $fillable = [
        'title', 'content'
    ];
}
