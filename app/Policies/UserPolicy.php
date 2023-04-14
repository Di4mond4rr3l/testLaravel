<?php

namespace App\Policies;

use App\Models\User;
use Auth;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $me, User $user): Response
    {
        return $user->id === $me->id       
            ? Response::allow()
            : Response::deny('Non ti è concesso visualizzare il profilo di un altro utente');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->id === 15
            ? Response::allow()
            : Response::deny('Non ti è concesso creare un nuovo utente');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $me, User $user): Response
    {
        return $user->id === $me->id       
            ? Response::allow()
            : Response::deny('Non ti è concesso modificare il profilo di un altro utente');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $me, User $user): Response
    {
        return $user->id === $me->id       
            ? Response::allow()
            : Response::deny('Non ti è concesso eliminare il profilo di un altro utente');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $me, User $user): Response
    {
        return $user->id === $me->id       
            ? Response::allow()
            : Response::deny('Non ti è concesso eliminare il profilo di un altro utente');
    }
}
