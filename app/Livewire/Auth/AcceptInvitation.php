<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Pages\SimplePage;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Notifications\Notification;

class AcceptInvitation extends SimplePage
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string $view = 'livewire.auth.accept-invitation';

    public $invitation;

    public ?array $data = [];

    public function mount(): void
    {
        $user = User::find($this->invitation);

        // Überprüfe, ob die Einladung noch gültig ist
        if (!$user || $user->invitation_valid_until === null || $user->invitation_valid_until->isPast()) {
            // Umleitung oder Anzeige einer Nachricht, dass die Einladung ungültig ist
            abort(403, 'This invitation is no longer valid');
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('password')
                    ->label(__('filament-panels::pages/auth/register.form.password.label'))
                    ->password()
                    ->required()
                    ->rule(Password::default())
                    ->same('passwordConfirmation')
                    ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute')),
                TextInput::make('passwordConfirmation')
                    ->label(__('filament-panels::pages/auth/register.form.password_confirmation.label'))
                    ->password()
                    ->required()
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $user = User::find($this->invitation);

        $user->update([
            'password' => $this->form->getState()['password'],
            'invitation_valid_until' => null,
        ]);

        Notification::make()
            ->success()
            ->title($user->name.' joined')
            ->body('The invitation has been accepted.')
            ->sendToDatabase(User::role('admin')->get());

        auth()->login($user);

        $this->redirect('/team');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getRegisterFormAction(),
        ];
    }

    public function getRegisterFormAction(): Action
    {
        return Action::make('register')
            ->label('Accept Invitation')
            ->submit('register');
    }

    public function getHeading(): string
    {
        return 'Welcome to the Team';
    }

    public function getSubHeading(): string
    {
        return 'Set your password to accept your invitation and become part of the team';
    }
}
