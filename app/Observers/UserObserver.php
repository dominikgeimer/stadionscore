<?php

namespace App\Observers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        if (!auth()->check()) {
            $user->team_id = Team::create()->id;
            $user->assignRole('admin');
        }
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (auth()->check()) {
            $user->sendWelcomeNotification(now()->addWeek());
        }
    }
}
