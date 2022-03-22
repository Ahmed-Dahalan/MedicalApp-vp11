<?php

namespace App\Policies;

use App\Models\admin;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admin $admin)
    {
        //
        return $admin->hasPermissionTo('Read-permissions')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(admin $admin, permission $permission)
    {
        //
        return $admin->hasPermissionTo('Read-permissions')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admin $admin)
    {
        //
        return $admin->hasPermissionTo('Create-permission')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admin $admin, permission $permission)
    {
        //
        return $admin->hasPermissionTo('Update-permission')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admin $admin, permission $permission)
    {
        //
        return $admin->hasPermissionTo('Delete-permission')
            ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admin $admin, permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admin $admin, permission $permission)
    {
        //
    }
}
