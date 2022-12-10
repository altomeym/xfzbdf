@component('mail::message')
#{{ trans('notifications.shop_config_updated.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.shop_config_updated.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('notifications.shop_config_updated.button_text') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
