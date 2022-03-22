<?php

namespace App\Policies;

use App\Models\admin;
use App\Models\city;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($patient)
    {
        //
        return $patient->hasPermissionTo('Read-cities')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\city  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($patient, city $city)
    {
        //
        return $patient->hasPermissionTo('Read-cities')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($patient)
    {
        //
        return $patient->hasPermissionTo('Create-city')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\city  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($patient, city $city)
    {
        //
        return $patient->hasPermissionTo('Update-city')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\city  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($patient, city $city)
    {
        //
        return $patient->hasPermissionTo('Delete-city')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\city  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admin $admin, city $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\city  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admin $admin, city $city)
    {
        //
    }
}
