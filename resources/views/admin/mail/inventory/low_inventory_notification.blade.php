@component('mail::message')
#{{ trans('notifications.low_inventory_notification.greeting') }}

{{ trans('notifications.low_inventory_notification.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'red'])
{{ trans('notifications.low_inventory_notification.button_text') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
