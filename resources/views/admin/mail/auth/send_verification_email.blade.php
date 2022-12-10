@component('mail::message')
#{{ trans('notifications.email_verification.greeting', ['user' => $user->getName()]) }}

{{ trans('notifications.email_verification.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('notifications.email_verification.button_text') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
