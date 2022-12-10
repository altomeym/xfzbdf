@component('mail::message')
#{{ trans('notifications.shop_deleted.greeting') }}

{{ trans('notifications.shop_deleted.message') }}

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
