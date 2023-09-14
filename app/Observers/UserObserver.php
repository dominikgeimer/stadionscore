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
        $user->team_id = match (auth()->check()) {
            true => auth()->user()->team->id,
            default => Team::create()->id,
        };
    }
}
