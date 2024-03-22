<x-mail::message>
You have been invited to join a team.

To accept your invitation, just click the button below and set up your account:

<x-mail::button :url="$acceptUrl">
{{ __('Accept Invitation') }}
</x-mail::button>

{{ __('If you did not expect to receive an invitation to this team, you may discard this email.') }}
</x-mail::message>
