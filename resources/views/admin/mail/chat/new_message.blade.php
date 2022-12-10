@component('mail::message')
#{{ trans('notifications.new_chat_message.greeting', ['receipent' => $receipent]) }}

{!! trans('notifications.new_chat_message.message', ['message' => $message]) !!}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('notifications.new_chat_message.button_text') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942 
{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
--}}
@endcomponent
