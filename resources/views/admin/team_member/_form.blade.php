<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.name') . '*') !!}
      {!! Form::text('name', null, ['class' => isset($team_member) ? 'form-control' : 'form-control makeSlug', 'placeholder' => trans('app.placeholder.name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('designation', trans('app.form.designation') . '*') !!}
      {!! Form::text('designation', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.designation'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('working_date', trans('app.form.working_date') . '*') !!}
  {!! Form::text('working_date', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.working_date'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('position', trans('app.form.position')) !!}
  {!! Form::number('position', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.designation')]) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('facebook_profile', trans('app.form.facebook_profile')) !!}
  {!! Form::text('facebook_profile', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.facebook')]) !!}
  <div class="help-block with-errors"></div>
</div> 

<div class="form-group">
  {!! Form::label('twitter_profile', trans('app.form.twitter_profile')) !!}
  {!! Form::text('twitter_profile', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.twitter')]) !!}
  <div class="help-block with-errors"></div>
</div> 

<div class="form-group">
  {!! Form::label('skype_profile', trans('app.form.skype_profile')) !!}
  {!! Form::text('skype_profile', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.skype')]) !!}
  <div class="help-block with-errors"></div>
</div> 


<div class="form-group">
  <label for="exampleInputFile"> {{ trans('app.image') . '*' }}</label>
  @if (isset($team_member) && $team_member->_profile)
    <img src="{{ get_storage_file_url(optional($team_member->image)->path, 'small') }}" width="" alt="{{ trans('app.image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image[image]', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.image') }}
    </span>
  @endif

  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
      <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }}</span>
        <input type="file" name="image" id="uploadBtn" class="upload" />
      </div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>
