<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class patient extends Authenticatable
{
    use HasFactory,HasRoles;

    public function city()
    {
        return $this->belongsTo(city::class, 'city_id' , 'id');
    }

    public function getActiveStatusAttribute()
    {
        return $this->active == 1 ? 'Active' : 'InActive';
    }
    public function getGenderTypeAttribute(){
        return $this->gender == 'M' ? 'Male':'Female';
    }
}
