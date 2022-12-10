@extends('admin.layouts.master')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.among_my_brands') }}</h3>
      <div class="box-tools pull-right">
        @can('create', \App\Models\AmongMyBrand::class)
          <a href="javascript:void(0)" data-link="{{ route('admin.catalog.among-my-brand.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_among_my_brand') }}</a>
        @endcan
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            @can('massDelete', \App\Models\AmongMyBrand::class)
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
                    {{-- <li><a href="javascript:void(0)" data-link="{{ route('admin.catalog.among-my-brand.massTrash') }}" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> {{ trans('app.trash') }}</a></li> --}}
                    {{-- <li><a href="javascript:void(0)" data-link="{{ route('admin.catalog.among-my-brand.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a></li> --}}
                    <li><a href="javascript:void(0)" data-link="{{ route('admin.catalog.among-my-brand.massTrash') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a></li>
                  </ul>
                </div>
              </th>
            @endcan
            <th>{{ trans('app.image') }}</th>
            <th>{{ trans('app.name') }}</th>
            <th>{{ trans('app.order') }}</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          @foreach ($among_my_brands as $among_my_brand)
            <tr>
              @can('massDelete', \App\Models\AmongMyBrand::class)
                <td><input id="{{ $among_my_brand->id }}" type="checkbox" class="massCheck"></td>
              @endcan
              <td>
                <img src="{{ get_logo_url($among_my_brand, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
              </td>
              <td>
                <p class="indent10">
                  {{ $among_my_brand->name }}
                </p>
              </td>
              <td>{{ $among_my_brand->orderBy }}</td>
              <td class="row-options">
                  @can('view', $among_my_brand)
                    <a href="javascript:void(0)" data-link="{{ route('admin.catalog.among-my-brand.show', $among_my_brand->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;
                  @endcan

                  @can('update', $among_my_brand)
                    <a href="javascript:void(0)" data-link="{{ route('admin.catalog.among-my-brand.edit', $among_my_brand->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
                  @endcan

                  @can('delete', $among_my_brand)
                    {!! Form::open(['route' => ['admin.catalog.among-my-brand.destroy', $among_my_brand->id], 'method' => 'delete', 'class' => 'data-form']) !!}
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                    {!! Form::close() !!}
                  @endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
@endsection
