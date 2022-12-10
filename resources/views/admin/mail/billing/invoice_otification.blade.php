@component('mail::message')
#{{ trans('notifications.invoice_created.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.invoice_created.message', ['shop_name' => $shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('notifications.invoice_created.button_text') }}
@endcomponent
{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
