<?php

namespace App\Livewire\Auth;

use App\Models\Team;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Pages\SimplePage;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class AcceptInvitation extends SimplePage
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string $view = 'livewire.auth.accept-invitation';

    public $invitation;

    public ?array $data = [];

    public function mount(): void
    {
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
            ->label(__('filament-panels::pages/auth/register.form.actions.register.label'))
            ->submit('register');
    }

    public function getHeading(): string
    {
        return 'Accept Invitation';
    }

    public function getSubHeading(): string
    {
        return 'Create your user to accept an invitation';
    }

}
