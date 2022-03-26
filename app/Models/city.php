<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $casts = [
        'created_at' => 'datetime:H:ia',
        // 'created_at' => 'datetime:Y-m-d',
        'active' => 'boolean',
    ];

    protected $hidden = [
        'updated_at',
        // 'created_at'
    ];
    use HasFactory;
    public function patients()
    {
        // return $this->hasMany(user::class); بنفع هيك
        return $this->hasMany(patient::class, 'city_id', 'id');
    }

    public function getActiveStatusAttribute()
    {
        return $this->active == 1 ? 'Active' : 'InActive';
    }
}
