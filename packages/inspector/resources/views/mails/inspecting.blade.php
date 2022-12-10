@component('mail::message')
{{ trans('inspector::lang.greeting', ['receiver' => $receiver]) }}

{{ trans('inspector::lang.inspecting_content', ['inspecting' => $inspecting]) }}
<br/>
{!! trans('inspector::lang.inspecting_message', ['caught' => $caught, 'keywords' => $keywords]) !!}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('inspector::lang.update') }}
@endcomponent

{{-- commented by hassan00942 + emailTemplateUiUpgrade00942
{{ trans('inspector::lang.thanks') }},<br>
{{ get_platform_title() }}
<br/>
 --}}
@endcomponent