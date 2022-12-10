<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('label', trans('app.form.label') . '*') !!}
      {!! Form::text('label', null, ['class' => isset($page) ? 'form-control' : 'form-control makeSlug', 'placeholder' => trans('app.placeholder.label'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-8 nopadding-left">
    <div class="form-group">
      {!! Form::label('title', trans('app.form.guide_lead_title') . '*') !!}
      {!! Form::text('title', null, ['class' => isset($page) ? 'form-control' : 'form-control makeSlug', 'placeholder' => trans('app.placeholder.page_title'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('slug', trans('app.form.slug') . '*') !!}
  {!! Form::text('slug', null, ['class' => isset($page) ? 'form-control' : 'form-control makeSlug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('description', trans('app.form.short_description') . '*') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control summernote-long', 'placeholder' => trans('app.placeholder.description'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('points', trans('app.form.points') . '*') !!}
      {!! Form::text('pages', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.points'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-right nopadding-left">
    <div class="form-group">
      {!! Form::label('type', trans('app.form.type') . '*') !!}
      {!! Form::select('type', ['' => '', 'pdf' => 'pdf', 'video' => 'video'], null, ['id' => 'attach_type', 'class' => 'form-control select2-normal-', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left" id="link_attach">
    <div class="form-group">
      {!! Form::label('link', trans('app.form.link') . '*') !!}
      {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.link')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  {{-- <div class="col-md-4 nopadding-left d-none" id="file_attach">
    <div class="form-group">
      {!! Form::label('file', trans('app.form.file') . '*') !!}
      {!! Form::file('link_file', ['class' => 'form-contro']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div> --}}
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('bg_color', trans('app.form.bg_color') . '*') !!}
      {!! Form::text('bg_color', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.bg_color'), 'required']) !!}
      <div class="">{{ trans('app.form.background_color_code_hint', ['format' => 'hsl(hue, saturation, lightness)']) }}</div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('color', trans('app.form.color') . '*') !!}
      {!! Form::text('color', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('offer_text_1', trans('app.form.offer_text_1')) !!}
      {!! Form::text('offer_text_1', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.offer_text_1')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left nopadding-right">
    <div class="form-group">
      {!! Form::label('offer_text_2', trans('app.form.offer_text_2')) !!}
      {!! Form::text('offer_text_2', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.offer_text_2')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('offer_text_3', trans('app.form.offer_text_3')) !!}
      {!! Form::text('offer_text_3', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.offer_text_3')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('btn_text', trans('app.form.btn_text') . '*') !!}
      {!! Form::text('btn_text', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.btn_text'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('is_featured', trans('app.form.is_featured') . '*') !!}
      {!! Form::select('is_featured', ['1' => trans('app.yes'), '0' => trans('app.no')], null, ['class' => 'form-control', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>


{{--<div class="form-group">
  <label for="exampleInputFile"> {{ trans('app.cover_image') }}</label>
  @if (isset($page) && $page->coverImage)
    <img src="{{ get_storage_file_url(optional($page->coverImage)->path, 'small') }}" width="" alt="{{ trans('app.cover_image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image[cover]', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  @endif

  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.cover_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
      <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }}</span>
        <input type="file" name="images[cover]" id="uploadBtn" class="upload" />
      </div>
    </div>
  </div>
</div>--}}
<div class="form-group">
  <label for="exampleInputFile"> {{ trans('app.image') }}</label>
  @if (isset($guide_lead) && $guide_lead->image)
    <img src="{{ get_storage_file_url(optional($guide_lead->image)->path, 'small') }}" width="" alt="{{ trans('app.cover_image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image[]', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  @endif

  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
      <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }}</span>
        <input type="file" name="images[]" id="uploadBtn" class="upload" />
      </div>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>