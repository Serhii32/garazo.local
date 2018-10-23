<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->role()->first()->id === 1;
    }
}
