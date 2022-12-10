@component('mail::message')
{{ trans('api.delivery_boy_password_reset') }}
<br/>

@component('mail::button', ['url' => '', 'color' => 'blue'])
{{ $token }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
