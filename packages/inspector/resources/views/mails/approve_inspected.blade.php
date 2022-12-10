@component('mail::message')
{{ trans('inspector::lang.greeting', ['receiver' => $receiver]) }}

{{ trans('inspector::lang.approved_content', ['approved' => $approved]) }}

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('inspector::lang.see_now') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942
{{ trans('inspector::lang.thanks') }},<br>
{{ get_platform_title() }}
<br/>
 --}}
@endcomponent