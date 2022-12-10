@extends('admin.layouts.master')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.team_page_setting') }}</h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      {!! Form::model($team_page_setting, ['method' => 'PUT', 'route' => ['admin.utility.team-page-setting.update', $team_page_setting], 'files' => false, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="form-group">
          {!! Form::label('title', trans('app.form.title') . '*') !!}
          {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title')]) !!}
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          {!! Form::label('description', trans('app.form.description') . '*') !!}
          {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.description')]) !!}
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          {!! Form::label('meta_title', trans('app.form.meta_title')) !!}
          {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_title')]) !!}
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          {!! Form::label('meta_keywords', trans('app.form.meta_keywords')) !!}
          {!! Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_keywords')]) !!}
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          {!! Form::label('meta_description', trans('app.form.meta_description')) !!}
          {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_description')]) !!}
          <div class="help-block with-errors"></div>
        </div>
        @can('update', $team_page_setting)
        {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        @endcan
      {!! Form::close() !!}
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
@endsection
