@extends('admin.layouts.master')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.country_wise_websites') }}</h3>
      <div class="box-tools pull-right">
          <a href="javascript:void(0)" data-link="{{ url('admin/setting/country-wise-website/create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_country_wise_website') }}</a>
        @can('create', \App\Models\Language::class)
        @endcan
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            @can('massDelete', \App\Models\Language::class)
            @endcan
            <th>{{ trans('app.country') }}</th>
            <th>{{ trans('app.website') }}</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          @foreach ($country_wise_websites as $country_wise_website)
          <tr>
            <td><img src="{{ asset(sys_image_path('flags') . array_slice(explode('_', $country_wise_website->country->iso_code), -1)[0] . '.png') }}" class="lang-flag small"> {{ $country_wise_website->country->name }}</td>
            <td>{{ $country_wise_website->website }}</td>
            <td>
              <a href="javascript:void(0)" data-link="{{ route('admin.setting.country-wise-website.edit', $country_wise_website) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;

              {!! Form::open(['route' => ['admin.setting.country-wise-website.destroy', $country_wise_website], 'method' => 'delete', 'class' => 'data-form']) !!}
              {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
              {!! Form::close() !!}
              
            </td>
          </tr>
          <?php /*
            <tr>
                <td><input id="{{ $language->id }}" type="checkbox" class="massCheck"></td>
              @can('massDelete', \App\Models\Language::class)
              @endcan
              <td width="45%">
                <img src="{{ asset(sys_image_path('flags') . array_slice(explode('_', $language->php_locale_code), -1)[0] . '.png') }}" class="lang-flag small" alt="{{ $language->code }}">
                <span class="indent10">{{ $language->language }}</span>
                @if ($language->rtl)
                  <span class="indent10 label label-outline">{{ trans('app.rtl') }}</span>
                @endif
                @if ($language->active)
                  <span class="indent10 label label-primary pull-right">{{ trans('app.active') }}</span>
                  <i class="fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="top" title="{{ trans('help.new_language_info') }}"></i>
                @endif
              </td>
              <td>{!! $language->code !!}</td>
              <td>{!! $language->php_locale_code !!}</td>
              <td class="row-options text-muted small">
                  <a href="javascript:void(0)" data-link="{{ route('admin.setting.language.edit', $language) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
                @can('update', $language)
                @endcan
                  @if (in_array($language->id, config('system.freeze.languages')))
                    <i class="fa fa-bell-o text-muted" data-toggle="tooltip" data-placement="left" title="{{ trans('messages.freezed_model') }}"></i>
                  @else
                    {!! Form::open(['route' => ['admin.setting.language.trash', $language], 'method' => 'delete', 'class' => 'data-form']) !!}
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                    {!! Form::close() !!}
                  @endif
                @can('delete', $language)
                @endcan
              </td>
            </tr>
            */ ?>
          @endforeach
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
@endsection
