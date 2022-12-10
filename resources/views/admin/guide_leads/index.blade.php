@extends('admin.layouts.master')
@section('page-style')
  <style>
    .d-none{display: none}
  </style>
@endsection
@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.guide_leads') }}</h3>
      <div class="box-tools pull-right">
        @can('create', \App\Models\GuideLead::class)
          <a href="javascript:void(0)" data-link="{{ route('admin.utility.guide-lead.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_guide_lead') }}</a>
        @endcan
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            @can('massDelete', \App\Models\GuideLead::class)
              <th class="massActionWrapper">
                <!-- Check all button -->
                <div class="btn-group ">
                  <button type="button" class="btn btn-xs btn-default checkbox-toggle">
                    <i class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="{{ trans('app.select_all') }}"></i>
                  </button>
                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">{{ trans('app.toggle_dropdown') }}</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" data-link="{{ route('admin.utility.page.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a></li>
                  </ul>
                </div>
              </th>
            @endcan
            <th>{{ trans('app.image') }}</th>
            <th>{{ trans('app.title') }}</th>
            <th>{{ trans('app.btn_text') }}</th>
            <th>{{ trans('app.bg_color') }}</th>
            <th>{{ trans('app.color') }}</th>
            <th>{{ trans('app.is_featured') }}</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          @foreach ($guide_leads as $guide_lead)
            <tr>
              @can('massDelete', \App\Models\GuideLead::class)
                <td><input id="{{ $guide_lead->id }}" type="checkbox" class="massCheck"></td>
              @endcan
              <td>
                <img src="{{ get_storage_file_url(optional($guide_lead->image)->path, 'cover_thumb') }}" class="img-sm" alt="{{ trans('app.cover_image') }}">
              </td>
              <td width="45%">
                <strong>{!! $guide_lead->title !!}</strong>
              </td>
              <td>{{ $guide_lead->btn_text  }}</td>
              <td>{{ $guide_lead->bg_color  }}</td>
              <td>{{ $guide_lead->color  }}</td>
              <td>{{ $guide_lead->is_featured  }}</td>
              <td class="row-options text-muted small">
                @can('update', $guide_lead)
                  <a href="javascript:void(0)" data-link="{{ route('admin.utility.guide-lead.edit', $guide_lead) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
                @endcan
                @can('delete', $guide_lead)
                  {!! Form::open(['route' => ['admin.utility.guide-lead.destroy', $guide_lead], 'method' => 'delete', 'class' => 'data-form']) !!}
                  {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                  {!! Form::close() !!}
                @endcan
              </td>
            </tr>
          {{--<tr>
              @can('massDelete', \App\Models\GuideLead::class)
                <td><input id="{{ $guide_lead->id }}" type="checkbox" class="massCheck"></td>
              @endcan
              <td>
                <img src="{{ get_storage_file_url(optional($guide_lead->coverImage)->path, 'cover_thumb') }}" class="img-sm" alt="{{ trans('app.cover_image') }}">
              </td>
              <td width="45%">
                @can('update', $guide_lead)
                  <a href="javascript:void(0)" data-link="{{ route('admin.utility.page.edit', $guide_lead) }}" class="ajax-modal-btn"><strong>{!! $guide_lead->title !!}</strong></a>
                @else
                  <strong>{!! $guide_lead->title !!}</strong>
                @endcan
                @if (is_null($guide_lead->published_at))
                  <span class="indent10 label label-default">{{ strtoupper(trans('app.draft')) }}</span>
                @endif
              </td>
              <td>{!! $guide_lead->visibilityName() !!}</td>
              <td>{!! $guide_lead->viewPosition() !!}</td>
              <td>{{ $guide_lead->author->getName() }}</td>
              <td class="small">
                @if ($guide_lead->published_at)
                  @if (\Carbon\Carbon::now() < $guide_lead->published_at)
                    {{ trans('app.schedule_published_at') }}<br />
                    {{ optional($guide_lead->published_at)->toDayDateTimeString() }}
                  @else
                    {{ trans('app.published_at') }}<br />
                    {{ optional($guide_lead->published_at)->toFormattedDateString() }}
                  @endif
                @else
                  {{ trans('app.updated_at') }}<br />
                  {{ $guide_lead->updated_at->toFormattedDateString() }}
                @endif
              </td>
              <td class="row-options text-muted small">
                @can('update', $guide_lead)
                  <a href="javascript:void(0)" data-link="{{ route('admin.utility.page.edit', $guide_lead) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
                @endcan
                @can('delete', $guide_lead)
                  @if (in_array($guide_lead->id, config('system.freeze.pages')))
                    <i class="fa fa-bell-o text-muted" data-toggle="tooltip" data-placement="left" title="{{ trans('messages.freezed_model') }}"></i>
                  @else
                    {!! Form::open(['route' => ['admin.utility.page.trash', $guide_lead], 'method' => 'delete', 'class' => 'data-form']) !!}
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                    {!! Form::close() !!}
                  @endif
                @endcan
              </td>
            </tr>  --}}
          @endforeach
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

@endsection

@push('script')
  <script>
    // $(document).ready(function(){
    //   $("body").on('change','#attach_type', function(){
    //     if($(this).val() == 'pdf'){
    //       $('#link_attach').addClass('d-none');
    //       $('#file_attach').removeClass('d-none');
    //     }else if($(this).val() == 'video'){
    //       $('#file_attach').addClass('d-none');
    //       $('#link_attach').removeClass('d-none');
    //     }else{
    //       $('#file_attach').removeClass('d-none');
    //       $('#link_attach').removeClass('d-none');
    //     }
    //   });
    // });
  </script>
@endpush