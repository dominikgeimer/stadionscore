<?php

namespace App\Http\Controllers\Auth;

use App\Models\User as AppUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Symfony\Component\HttpFoundation\Response;
use Spatie\WelcomeNotification\WelcomeController;

class InvitationController extends WelcomeController
{
    public function savePassword(Request $request, User $user)
    {
        $request->validate($this->rules());

        $user->password = Hash::make($request->password);
        $user->welcome_valid_until = null;
        $user->save();

        Notification::make()
            ->title($user->name. ' has accepted your invitation.')
            ->sendToDatabase(AppUser::role('admin')->where('team_id', $user->team_id)->get());

        return $this->sendPasswordSavedResponse();
    }

    public function sendPasswordSavedResponse(): Response
    {
        return redirect('/team');
    }
}
