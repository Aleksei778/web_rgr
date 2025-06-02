<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCompanyServices extends Model
{
    protected $table = "services";

    protected $fillable = [
        'title', 'content'
    ];
}
