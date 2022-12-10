@php
  $countries = \App\Models\Country::select('id','name')->get()->pluck('name','id')->toArray();
@endphp
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('country', trans('app.country').'*', ['class' => 'with-help']) !!}
      {!! Form::select('country_id', array('-1' => 'Please select...') + $countries, null, ['class' => 'form-control', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('website', trans('app.website'), ['class' => 'with-help']) !!}
      {!! Form::text('website' , null, ['class' => 'form-control', 'placeholder' => 'https://']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>