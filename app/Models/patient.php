<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class patient extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles;
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];
    public function city()
    {
        return $this->belongsTo(city::class, 'city_id', 'id');
    }

    public function getActiveStatusAttribute()
    {
        return $this->active == 1 ? 'Active' : 'InActive';
    }
    public function getGenderTypeAttribute()
    {
        return $this->gender == 'M' ? 'Male' : 'Female';
    }
    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }
    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
}

    
