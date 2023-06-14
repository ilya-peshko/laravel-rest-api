<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $loggedUser, User $user): bool
    {
        return $loggedUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $loggedUser, User $user): bool
    {
        return $loggedUser->id === $user->id;
    }
}
