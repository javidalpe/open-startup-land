<?php

namespace App\Policies;

use App\User;
use App\Startup;
use Illuminate\Auth\Access\HandlesAuthorization;

class StartupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the startup.
     *
     * @param  \App\User  $user
     * @param  \App\Startup  $startup
     * @return mixed
     */
    public function view(User $user, Startup $startup)
    {
	    return $user->id === $startup->user_id;
    }

    /**
     * Determine whether the user can create startups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the startup.
     *
     * @param  \App\User  $user
     * @param  \App\Startup  $startup
     * @return mixed
     */
    public function update(User $user, Startup $startup)
    {
	    return $user->id === $startup->user_id;
    }

    /**
     * Determine whether the user can delete the startup.
     *
     * @param  \App\User  $user
     * @param  \App\Startup  $startup
     * @return mixed
     */
    public function delete(User $user, Startup $startup)
    {
	    return $user->id === $startup->user_id;
    }
}
