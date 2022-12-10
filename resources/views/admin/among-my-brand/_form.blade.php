<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.name') . '*', ['class' => 'with-help']) !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('order', trans('app.form.order'), ['class' => 'with-help']) !!}
      {!! Form::text('orderBy', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.order')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('industry', trans('app.form.industry'), ['class' => 'with-help']) !!}
      {!! Form::text('industry', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.industry')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('about_my_work', trans('app.form.about_my_work'). '*', ['class' => 'with-help']) !!}
      {!! Form::textarea('about_my_work', null, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.about_my_work'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('about_brand', trans('app.form.about_brand'). '*', ['class' => 'with-help']) !!}
      {!! Form::textarea('about_brand', null, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.about_brand'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('start_date', trans('app.form.start_date'). '*', ['class' => 'with-help']) !!}
      {!! Form::text('start_date', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.start_date'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('end_date', trans('app.form.end_date'). '*', ['class' => 'with-help']) !!}
      {!! Form::text('end_date', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.end_date'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>  
</div>


<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('exampleInputFile', trans('app.form.logo'), ['class' => 'with-help']) !!}
      @if (isset($manufacturer) && $manufacturer->logoImage)
        <label>
          <img src="{{ get_logo_url($manufacturer, 'small') }}" alt="{{ trans('app.logo') }}">
          <span style="margin-left: 10px;">
            {!! Form::checkbox('delete_image[logo]', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_logo') }}
          </span>
        </label>
      @endif
      <div class="row">
        <div class="col-md-9 nopadding-right">
          <input id="uploadFile" placeholder="{{ trans('app.placeholder.logo') }}" class="form-control" disabled="disabled" style="height: 28px;" />
          <div class="help-block with-errors">{{ trans('help.logo_img_size') }}</div>
        </div>
        <div class="col-md-3 nopadding-left">
          <div class="fileUpload btn btn-primary btn-block btn-flat">
            <span>{{ trans('app.form.upload') }}</span>
            <input type="file" name="images[logo]" id="uploadBtn" class="upload" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>
