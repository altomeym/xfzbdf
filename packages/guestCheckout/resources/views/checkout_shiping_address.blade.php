@if (isset($one_checkout_form))
  @include('guestCheckout::address_form')
@else
  @include('guestCheckout::address_form', ['countries' => $business_areas->pluck('name', 'id')])
@endif

{{--  php tag added by hassan00942 --}}
@php
  $user_email = auth()->guard('customer')->check() ? auth()->guard('customer')->user()->email : '';
@endphp

{{--  2nd paramter from null to $user_email modified by hassan00942 --}}
<div class="form-group">
  {!! Form::email('email', $user_email, ['class' => 'form-control flat', 'placeholder' => trans('guestCheckout::lang.email'), 'maxlength' => '100', 'autocomplete' => 'new-customer-email', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

{{-- condition added by hassan00942 --}}
@if($user_email == '')
<div class="checkbox">
  <label>
    {!! Form::checkbox('create-account', null, null, ['id' => 'create-account-checkbox', 'class' => 'i-check']) !!} {!! trans('theme.create_account') !!}
  </label>
</div>

<div id="create-account" class="space30" style="display: none;">
  <div class="row">
    <div class="col-md-6 nopadding-right">
      <div class="form-group">
        {!! Form::password('password', ['class' => 'form-control flat', 'id' => 'acc-password', 'placeholder' => trans('guestCheckout::lang.password'), 'autocomplete' => 'new-customer-password', 'data-minlength' => '6']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>

    <div class="col-md-6 nopadding-left">
      <div class="form-group">
        {!! Form::password('password_confirmation', ['class' => 'form-control flat', 'placeholder' => trans('guestCheckout::lang.confirm_password'), 'autocomplete' => 'new-customer-password', 'data-match' => '#acc-password']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>

  @if (config('system_settings.ask_customer_for_email_subscription'))
    <div class="checkbox">
      <label>
        {!! Form::checkbox('accepts_marketing', null, null, ['class' => 'i-check']) !!} {!! trans('theme.input_label.subscribe_to_the_newsletter') !!}
      </label>
    </div>
  @endif
  
  <p class="text-info small">
    <i class="fas fa-info-circle"></i>
    {!! trans('theme.help.create_account_on_checkout', ['link' => get_page_url(\App\Models\Page::PAGE_TNC_FOR_CUSTOMER)]) !!}
  </p>
</div>
@endif

{{-- <small class="help-block text-muted pull-right">* {{ trans('theme.help.required_fields') }}</small> --}}
