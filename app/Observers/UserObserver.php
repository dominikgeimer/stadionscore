<?php

namespace App\Observers;

use App\Models\Team;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        if (!auth()->check()) {
            $user->team_id = Team::create()->id;
        }
    }
}
