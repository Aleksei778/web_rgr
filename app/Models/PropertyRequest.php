<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\NewPropertyRequestNotification;
use Illuminate\Notifications\Notifiable;

class PropertyRequest extends Model
{
    use Notifiable;
    protected $table = 'property_requests';

    protected $fillable = [
        'user_id', 'property_id', 'title', 'message', 'status', 'admin_message', 'created_at', 'updated_at'
    ];

    // Связь с пользователями
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Связь с недвижимостью
    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
