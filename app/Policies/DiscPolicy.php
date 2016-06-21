<?php

namespace App\Policies;

use App\User;
use App\Disc;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function destroy(User $user, Disc $disc)
    {
        //return $user->id === $disc->user_id;
        // Debido a que un disco no se asocia a un único usuario
        
        return true;
    }
}
