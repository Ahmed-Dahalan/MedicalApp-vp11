<?php

namespace App\Policies;

use App\Models\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admin $adminAuth)
    {
        //
        return $adminAuth->hasPermissionTo('Read-admins')
            ? $this->allow() : $this->deny('Don\'t have permissions', 403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(admin $adminAuth, admin $admin)
    {
        //
        return $adminAuth->hasPermissionTo('Read-admins')
            ? $this->allow() : $this->deny('Don\'t have permissions', 403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admin $adminAuth)
    {
        //
        return $adminAuth->hasPermissionTo('Create-admin')
            ? $this->allow() : $this->deny('Don\'t have permissions', 403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(admin $adminAuth, admin $admin)
    {
        //
        return $adminAuth->hasPermissionTo('Update-admin')
            ? $this->allow() : $this->deny('Don\'t have permissions', 403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(admin $adminAuth, admin $admin)
    {
        //
        return $adminAuth->hasPermissionTo('Delete-admin')
            ? $this->allow() : $this->deny('Don\'t have permissions', 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(admin $adminAuth, admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(admin $adminAuth, admin $admin)
    {
        //
    }
}
