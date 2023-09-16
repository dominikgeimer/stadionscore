<?php

namespace App\Http\Controllers;

use App\Models\User as AppUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Spatie\Permission\Models\Role;
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
            ->sendToDatabase(Role::findByName('admin')->users);

        auth()->login($user);

        return $this->sendPasswordSavedResponse();
    }

    public function sendPasswordSavedResponse(): Response
    {
        return redirect()->route('team');
    }
}
