@component('mail::message')
{{ trans('wallet::lang.mail.greeting', ['receiver' => $receiver]) }}

{{ trans('wallet::lang.mail.approved_amount', ['amount' => $amount]) }}

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('wallet::lang.mail.see_now') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942
{{ trans('inspector::lang.thanks') }},<br>
{{ get_platform_title() }}
<br/>
 --}}
@endcomponent