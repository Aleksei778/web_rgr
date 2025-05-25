<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    protected $table = 'property_categories';

    protected $fillable = [
        'name', 'parent_id'
    ];

    // Связь с родительской категорией
    public function parent()
    {
        return $this->belongsTo(PropertyCategory::class, 'parent_id');
    }

    // Связь с дочерней категорией
    public function child() {
        return $this->hasMany(PropertyCategory::class, 'parent_id');
    }

    // Связь с объектами недвижимости
    public function properties()
    {
        return $this->hasMany(Property::class, 'category_id');
    }
}
