<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    protected $fillable = [
        'category_id', 'title', 'description', 'price', 'address', 'latitude', 'longitude', 'is_active'
    ];

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'category_id');
    }

    // Связь с изображением
    public function images() {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }
}
