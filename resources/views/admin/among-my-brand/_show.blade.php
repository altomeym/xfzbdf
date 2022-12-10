<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-body" style="padding: 20px;">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

      <div class="col-md-3 nopadding" style="margin-top: 10px;">
        <img src="{{ get_logo_url($among_amy_brand, 'medium') }}" class="thumbnail-" width="100%" alt="{{ trans('app.logo') }}">
      </div>

      <div class="col-md-9 nopadding">
        <table class="table no-border">
          <tr>
            <th class="text-right">{{ trans('app.name') }}:</th>
            <td style="width: 75%;">{{ $among_amy_brand->name }}</td>
          </tr>
          <tr>
            <th class="text-right">{{ trans('app.order') }}:</th>
            <td style="width: 75%;">{{ $among_amy_brand->order }}</td>
          </tr>
        </table>
      </div>
      <div class="clearfix"></div>
    </div>
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
