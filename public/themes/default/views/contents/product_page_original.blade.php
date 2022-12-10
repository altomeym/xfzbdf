
<section id="item-desc-section mb-5">
    <div class="container">
      <div class="row">
        @if ($linked_items->count())
          <div class="col-md-4 nopadding-right mb-3 pb-3">
            <div class="section-title">
              <h4 class="mb-4">@lang('theme.section_headings.bought_together'):</h4>
            </div>
            <ul class="sidebar-product-list">
              @include('theme::partials._product_vertical', ['products' => $linked_items])
            </ul>
          </div><!-- /.col-md-2 -->
        @endif
  
        <div class="col-md-{{ $linked_items->count() ? '8' : '12' }}" id="product_desc_section">
          <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#desc_tab" aria-controls="desc_tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('theme.product_desc')</a>
              </li>
              <li role="presentation">
                <a href="#seller_desc_tab" aria-controls="seller_desc_tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.product_desc_seller')</a>
              </li>
              <li role="presentation">
                <a href="#reviews_tab" aria-controls="reviews_tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.customer_reviews')</a>
              </li>
            </ul><!-- /.nav-tab -->
  
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="desc_tab">
  
                {!! $item->product->description !!}
  
                {{-- <div class="clearfix space30"></div> --}}
  
                <hr class="style4 muted my-4" />
  
                <h3 class="mb-3">{{ trans('theme.technical_details') }}: </h3>
  
                <table class="table table-striped noborder">
                  <tbody>
                    @if ($item->product->brand)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.brand') }}: </th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->brand }}</td>
                      </tr>
                    @endif
  
                    @if ($item->expiry_date)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('pharmacy::lang.expiry_date') }}: </th>
                        <td class="noborder" style="width: 65%;">{{ $item->expiry_date }}</td>
                      </tr>
                    @endif
  
                    @if ($item->product->model_number)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.model_number') }}:</th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->model_number }}</td>
                      </tr>
                    @endif
  
                    @if ($item->product->gtin_type && $item->product->gtin)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ $item->product->gtin_type }}: </th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->gtin }}</td>
                      </tr>
                    @endif
  
                    @if ($item->product->mpn)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.mpn') }}: </th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->mpn }}</td>
                      </tr>
                    @endif
  
                    @if ($item->sku)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.sku') }}: </th>
                        <td class="noborder" id="item_sku" style="width: 65%;">{{ $item->sku }}</td>
                      </tr>
                    @endif
  
                    @if (config('system_settings.show_item_conditions'))
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.condition') }}: </th>
                        <td class="noborder" id="item_condition" style="width: 65%;">
                          {{ $item->condition }}
                          @if ($item->condition_note)
                            <sup data-toggle="tooltip" data-placement="top" title="{!! $item->condition_note !!}">
                              <i class="fas fa-question-circle" id="item_condition_note"></i>
                            </sup>
                          @endif
                        </td>
                      </tr>
                    @endif
  
                    @if (optional($item->product->manufacturer)->name)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.manufacturer') }}: </th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->manufacturer->name }}</td>
                      </tr>
                    @endif
  
                    @if ($item->product->origin)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.origin') }}: </th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->origin->name }}</td>
                      </tr>
                    @endif
  
                    <tr class="noborder">
                      <th class="text-right noborder">{{ trans('theme.availability') }}: </th>
                      <td class="noborder" style="width: 65%;">{{ $item->availability }}</td>
                    </tr>
  
                    @if ($item->min_order_quantity)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.min_order_quantity') }}: </th>
                        <td class="noborder" id="item_min_order_qtt" style="width: 65%;">{{ $item->min_order_quantity }}</td>
                      </tr>
                    @endif
  
                    @if ($item->shipping_weight)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.shipping_weight') }}: </th>
                        <td class="noborder" id="item_shipping_weight" style="width: 65%;">{{ $item->shipping_weight . ' ' . config('system_settings.weight_unit') }}</td>
                      </tr>
                    @endif
  
                    @if ($item->product->created_at)
                      <tr class="noborder">
                        <th class="text-right noborder">{{ trans('theme.first_listed_on', ['platform' => get_platform_title()]) }}:</th>
                        <td class="noborder" style="width: 65%;">{{ $item->product->created_at->toFormattedDateString() }}</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
  
              <div role="tabpanel" class="tab-pane fade" id="seller_desc_tab">
                <div id="seller_seller_desc">
                  {!! $item->description !!}
                </div>
  
                @if ($item->shop->config->show_shop_desc_with_listing)
                  @if ($item->description)
                    <br /><br />
                    <hr class="style4 muted" />
                  @endif
                  <br />
                  <h4>{{ trans('theme.seller_info') }}: </h4>
                  {!! $item->shop->description !!}
                @endif
  
                @if ($item->shop->config->show_refund_policy_with_listing && $item->shop->config->return_refund)
                  <br /><br />
                  <hr class="style4 muted" /><br />
  
                  <h4 class="mb-4">{{ trans('theme.return_and_refund_policy') }}: </h4>
                  {!! $item->shop->config->return_refund !!}
                @endif
              </div>
  
              <div role="tabpanel" class="tab-pane fade" id="reviews_tab">
                <div class="reviews-tab">
                  @forelse($item->latestFeedbacks as $feedback)
                    <p>
                      <b>{{ optional($feedback->customer)->getName() }}</b>
  
                      <span class="pull-right small">
                        <b class="text-success">@lang('theme.verified_purchase')</b>
                        <span class="text-muted"> | {{ $feedback->created_at->diffForHumans() }}</span>
                      </span>
                    </p>
  
                    <p>{{ $feedback->comment }}</p>
  
                    @include('theme::layouts.ratings', ['ratings' => $feedback->rating])
  
                    @unless($loop->last)
                      <div class="sep"></div>
                    @endunless
                  @empty
                    <p class="lead text-center text-muted my-4">@lang('theme.no_reviews')</p>
                  @endforelse
                </div>
              </div>
            </div><!-- /.tab-content -->
          </div><!-- /.tabpanel -->
        </div><!-- /.col-md-9 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>
  