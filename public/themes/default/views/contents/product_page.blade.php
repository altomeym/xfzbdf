@php
$geoip = geoip(get_visitor_IP());
// print_r($geoip);
$shipping_country = $business_areas->where('iso_code', $geoip->iso_code)->first();
// print_r($shipping_country);
$shipping_state = \DB::table('states')
    ->select('id', 'name', 'iso_code')
    ->where([['country_id', '=', $shipping_country->id], ['iso_code', '=', $geoip->state]])
    ->first();

$shipping_zone = get_shipping_zone_of($item->shop_id, $shipping_country->id, optional($shipping_state)->id);
$shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';

$inventories = \App\Models\Inventory::with([
  'feature_inventory',
  'feature_inventory.feature',
  'feature_inventory.feature_value'
  ])->whereProductId($item->product_id)->get();
// print_r($inventories[0]->feature_inventory->toArray());
@endphp

<section id="product-detail">
  <div class="container mb-3 sc-product-item">
    <div class="container product-page-container">
      <div class="row  mb-4">
        <div class="row- col-xs-12 col-sm-12 col-md-8 col-lg-9- justify-content-center bg-white">
          
          <div class="row col-12">
            <div class="h3 fw-bold" style="color:#404145">
              {{ $item->product->name }}
            </div>
          </div>

          <div class="row col-12 px-5 py-3">
            <div class="col-12- w-100">
              <div class="among-my-clients-main-div m-b-16 among-my-clients-rendered">
                <div class="among-my-clients-bar-local">
                  <div class="among-my-clients-bar" data-impression-collected="true">
                    <div class="among-my-clients-title">
                      <span class="tbody-6">
                        <b class="title text-semi-bold">{!! trans('app.model.among_my_brand') !!}</b>&nbsp;
                      </span>&nbsp;
                      <div class="svg-qq svg-qp">
                        <span class="svg-qc">
                            <span
                                class="svg-qv Svg-qp"
                                style="width:16px;height:16px;fill:#95979D"
                                aria-hidden="true">
                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 16 16"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentFill">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16ZM6.667 6.222c0-.228.075-.59.277-.87C7.112 5.12 7.4 4.89 8 4.89c.734 0 1.116.388 1.245.777.136.41.02.867-.405 1.15-.701.468-1.218.92-1.49 1.556-.24.56-.24 1.175-.239 1.752v.098H8.89c0-.728.015-.964.095-1.15.06-.142.21-.356.842-.777a2.751 2.751 0 0 0 1.106-3.19C10.558 3.978 9.488 3.111 8 3.111c-1.179 0-2.001.511-2.5 1.203a3.37 3.37 0 0 0-.611 1.908h1.778Zm2.222 6.667V11.11H7.11v1.778H8.89Z"></path>
                                </svg>
                            </span>
                        </span>
                      </div>
                    </div>
                    <nav class="dynamic-scrollbar-wrapper scroll-hider has-overflow">
                      <button class="left d-none"><span class="svg-qv icon-chevron" aria-hidden="true" style="width: 15px; height: 15px; fill: rgb(122, 125, 133);"><svg width="8" height="15" viewBox="0 0 8 15" xmlns="http://www.w3.org/2000/svg"><path d="M7.2279 0.690653L7.84662 1.30934C7.99306 1.45578 7.99306 1.69322 7.84662 1.83968L2.19978 7.5L7.84662 13.1603C7.99306 13.3067 7.99306 13.5442 7.84662 13.6907L7.2279 14.3094C7.08147 14.4558 6.84403 14.4558 6.69756 14.3094L0.153374 7.76518C0.00693607 7.61875 0.00693607 7.38131 0.153374 7.23484L6.69756 0.690653C6.84403 0.544184 7.08147 0.544184 7.2279 0.690653Z"></path></svg></span></button>
                      <button class="right">
                          <span
                              class="svg-qv icon-chevron"
                              aria-hidden="true"
                              style="width: 15px; height: 15px; fill: rgb(122, 125, 133);">
                              <svg
                                  width="8"
                                  height="16"
                                  viewBox="0 0 8 16"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                      d="M0.772126 1.19065L0.153407 1.80934C0.00696973 1.95578 0.00696973 2.19322 0.153407 2.33969L5.80025 8L0.153407 13.6603C0.00696973 13.8067 0.00696973 14.0442 0.153407 14.1907L0.772126 14.8094C0.918563 14.9558 1.156 14.9558 1.30247 14.8094L7.84666 8.26519C7.99309 8.11875 7.99309 7.88131 7.84666 7.73484L1.30247 1.19065C1.156 1.04419 0.918563 1.04419 0.772126 1.19065Z"></path>
                              </svg>
                          </span>
                      </button>
                      <ul class="scrolled-list">
                        @foreach($among_my_brands as $among_my_brand)
                          <li>
                            <div class="svg-qq among-my-clients-popover" data-brand-logo="{{ get_logo_url($among_my_brand) }}" data-name="{{ $among_my_brand->name }}" data-date="{{ \Carbon\Carbon::parse($among_my_brand->start_date)->format('M-Y') }} - {{ \Carbon\Carbon::parse($among_my_brand->end_date)->format('M-Y') }}" data-about-my-work="{{ $among_my_brand->about_my_work }}" data-about-brand="{{ $among_my_brand->about_brand }}" data-industry="{{ $among_my_brand->industry }}">
                              <span class="svg-qc among-my-client-in-list client">
                                  <div class="logo-wrap">
                                    <div class="among-my-client-logo-wrap small">
                                      <img
                                          class="logo-image"
                                          src="{{ get_logo_url($among_my_brand, 'tiny') }}"
                                          alt="{{ $among_my_brand->name }}">
                                    </div>
                                  </div>
                                  <div class="client-details">
                                    <p class="client-name">{{ $among_my_brand->name }}</p>
                                  </div>
                              </span>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    </nav>
                  </div>
                </div>

                <div class="among-my-clients-popover-content">
                  <div class="">
                    <div class="">
                      <div>
                        <img id="seller-logo" class="pr-2" src="" />
                        <img id="brand-logo" src="" />
                      </div>
                      <div style="padding:10px 0">
                        <div id="about-my-work-with"></div>
                        <div id="date-range-working"></div>
                      </div>
                      <div id="about-my-work-desc">                   
                      </div>
                      <div id="about-my-work">
                        <div id="about-brand-desc"></div>
                        <div id="industry"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-12- col-md-11 product-image-slider-col text-center">
                @include('theme::layouts.product-detail-page-slider', ['item' => $item, 'variants' => $variants])
              </div>
              <div class="col-12 col-md-2 product-title-col">
                <div class="product-single">
                  {{-- @include('theme::layouts.product_info', ['item' => $item]) --}}
                  <div class="product-info-options my-4">
                    {{-- <div class="select-box-wrapper">
                      @foreach ($attributes as $attribute)
                        <div class="row product-attribute">
                          <div class="col-sm-3 col-4">
                            <span class="info-label" id="attr-{{ Str::slug($attribute->name) }}">{{ $attribute->name }}:</span>
                          </div>
                          <div class="col-sm-9 col-8 nopadding-left">
                            <select class="product-attribute-selector {{ $attribute->css_classes }}" id="attribute-{{ $attribute->id }}" required="required">
                              @foreach ($attribute->attributeValues as $option)
                                <option value="{{ $option->id }}" data-color="{{ $option->color ?? $option->value }}" {{ in_array($option->id, $item_attrs) ? 'selected' : '' }}>{{ $option->value }}</option>
                              @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                          </div><!-- /.col-sm-9 .col-6 -->
                        </div><!-- /.row -->
                      @endforeach
                    </div> --}}
                    <!-- /.row .select-box-wrapper -->

                    <div class="sep"></div>

                    <div id="calculation-section">
                      <div class="row">
                        <div class="col-3">
                          <span class="info-label" data-options="{{ $shipping_options }}" id="shipping-options">@lang('theme.shipping'):</span>
                          {{ Form::hidden('shipping_zone_id', isset($shipping_zone->id) ? $shipping_zone->id : null, ['id' => 'shipping-zone-id']) }}
                          {{ Form::hidden('shipping_rate_id', null, ['id' => 'shipping-rate-id']) }}
                          {{ Form::hidden('shipto_country_id', $shipping_country->id, ['id' => 'shipto-country-id']) }}
                          {{ Form::hidden('shipto_state_id', optional($shipping_state)->id, ['id' => 'shipto-state-id']) }}
                        </div>

                        <div class="col-9 nopadding-left">
                          <span id="summary-shipping-cost" data-value="0"></span>
                          <div id="product-info-shipping-detail">
                            {{-- <span>{{ strtolower(trans('theme.to')) }} --}}

                              {{-- <a id="shipTo" class="ship_to" data-country="{{ $shipping_country->id }}" data-state="{{ optional($shipping_state)->id }}" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="{{ trans('theme.change_shipping_location') }}">
                                {{ $shipping_state ? $shipping_state->name : $geoip->country }}
                              </a> --}}

                              {{-- This is important to keep --}}
                              <select id="width_tmp_select">
                                <option id="width_tmp_option"></option>
                              </select>
                            </span>

                            {{-- <span class="dynamic-shipping-rates" data-toggle="popover" title="{{ trans('theme.shipping_options') }}">
                              <span id="summary-shipping-carrier"></span>
                              <small class="ml-1 text-primary"><i class="fas fa-caret-circle-down"></i></small>
                            </span> --}}
                          </div>
                          {{-- <small class="text-muted" id="delivery-time"></small>
                          <small class="text-muted" >*Estimated delivery if ordered on <script>date = new Date().toLocaleDateString(); document.write(date);</script></small> --}}
                        </div><!-- /.col-sm-9 .col-6 -->
                      </div><!-- /.row -->

                      <div class="row">
                        <div class="col-3">
                          {{-- <span class="info-label qtt-label">@lang('theme.quantity'):</span> --}}
                        </div>
                        <div class="col-9 nopadding">
                          <div class="product-qty-wrapper">
                            <div class="product-info-qty-item">
                              <button class="product-info-qty product-info-qty-minus">-</button>
                              <input class="product-info-qty product-info-qty-input" data-name="product_quantity" data-min="{{ $item->min_order_quantity }}" data-max="{{ $item->stock_quantity }}" type="text" value="{{ $item->min_order_quantity }}">
                              <button class="product-info-qty product-info-qty-plus">+</button>
                            </div>
                            <span class="available-qty-count">@lang('theme.stock_count', ['count' => $item->stock_quantity])</span>
                          </div>
                        </div><!-- /.col-sm-9 .col-6 -->
                      </div><!-- /.row -->
                    </div>
                  </div><!-- /.product-option -->

                  <div class="sep"></div>

                  @if ($item->product->inventories_count > 1)
                    <a href="{{ route('show.offers', $item->product->slug) }}" class="d-none d-sm-inline-block btn btn-sm btn-link">
                      @lang('theme.view_more_offers', ['count' => $item->product->inventories_count])
                    </a>
                  @endif
                </div>
              </div>
              
              {{-- here key features box show with the help of jquery --}}
              <div class="col-12 d-block d-md-none" id="cloneFeaturesKeyBoxHere"></div>

              <div class="col-md-12 my-4" style="padding-right:30px" id="product_desc_section">
              
                <div role="tabpanel-">
                  {{-- <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                      <a href="#desc_tab" class="fw-bold h3" aria-controls="desc_tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('theme.product_desc')</a>
                    </li>
                    <li role="presentation">
                      <a href="#reviews_tab" class="fw-bold h3" aria-controls="reviews_tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.customer_reviews')</a>
                    </li>
                  </ul><!-- /.nav-tab --> --}}
        
                  <div class="tab-content- w-100">
                    {{-- <div role="tabpanel" class="tab-pane fade active in" id="desc_tab"> --}}
                      <div class="mt-3">{!! $item->product->description !!}</div>
                      @if($inventories->count() == 1)
                        <table class="table border my-5 w-100" id="pricingtable">
                          <thead>
                            <tr>
                              <td style="min-width:100px;"></td>
                              <td class="bg-light fw-bold p-4">Nano</td>
                              <td class="bg-light fw-bold p-4"></td>
                              <td class="bg-light fw-bold p-4"></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td>{{ @$inventories[0]->title }}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>{!! @$inventories[0]->description !!}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            {{-- @foreach($features as $feature)
                              <tr>
                                <td>{{ $feature->name }}</td>
                                <td class="p-4 text-center">
                                  @if($feature->feature_type_id == 2)
                                    <select class="form-control" name="features[0][{{ $feature->feature_type_id }}][]">
                                      <option value=""></option>
                                      @foreach($feature->feature_values as $value)
                                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                                      @endforeach
                                    </select>
                                  @elseif($feature->feature_type_id == 3)
                                    <input type="checkbox" name="features[0][{{ $feature->feature_type_id }}][]" value="1" />
                                  @endif
                                </td>
                                <td class="p-4 text-center">
                                  @if($feature->feature_type_id == 2)
                                    <select class="form-control" name="features[1][{{ $feature->feature_type_id }}][]">
                                      <option value=""></option>
                                      @foreach($feature->feature_values as $value)
                                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                                      @endforeach
                                    </select>
                                  @elseif($feature->feature_type_id == 3)
                                    <input type="checkbox" name="features[1][{{ $feature->feature_type_id }}][]" value="1" />
                                  @endif
                                </td>
                                <td class="p-4 text-center">
                                  @if($feature->feature_type_id == 2)
                                    <select class="form-control" name="features[2][{{ $feature->feature_type_id }}][]">
                                      <option value=""></option>
                                      @foreach($feature->feature_values as $value)
                                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                                      @endforeach
                                    </select>
                                  @elseif($feature->feature_type_id == 3)
                                    <input type="checkbox" name="features[2][{{ $feature->feature_type_id }}][]" value="1" />
                                  @endif
                                </td>
                              </tr>
                            @endforeach --}}
                            <tr class="price-tr">
                              <td>Price</td>
                              <td class="">
                                <div class="input-group">
                                  {{ @$inventories[0]->sale_price }} {{ get_currency_prefix() }}
                                </div>
                              </td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                      @elseif($inventories->count() == 3)
                        <table class="table border my-5 w-100" id="pricingtable">
                          <thead>
                            <tr>
                              <td style="min-width:100px;"></td>
                              <td class="bg-light fw-bold p-4">Nano</td>
                              <td class="bg-light fw-bold p-4">Micro</td>
                              <td class="bg-light fw-bold p-4">Mega</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td>{{ @$inventories[0]->title }}</td>
                              <td>{{ @$inventories[1]->title }}</td>
                              <td>{{ @$inventories[2]->title }}</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>{!! @$inventories[0]->description !!}</td>
                              <td>{!! @$inventories[1]->description !!}</td>
                              <td>{!! @$inventories[2]->description !!}</td>
                            </tr>
                            {{-- @foreach($features as $feature)
                              <tr>
                                <td>{{ $feature->name }}</td>
                                <td class="p-4 text-center">
                                  @if($feature->feature_type_id == 2)
                                    <select class="form-control" name="features[0][{{ $feature->feature_type_id }}][]">
                                      <option value=""></option>
                                      @foreach($feature->feature_values as $value)
                                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                                      @endforeach
                                    </select>
                                  @elseif($feature->feature_type_id == 3)
                                    <input type="checkbox" name="features[0][{{ $feature->feature_type_id }}][]" value="1" />
                                  @endif
                                </td>
                                <td class="p-4 text-center">
                                  @if($feature->feature_type_id == 2)
                                    <select class="form-control" name="features[1][{{ $feature->feature_type_id }}][]">
                                      <option value=""></option>
                                      @foreach($feature->feature_values as $value)
                                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                                      @endforeach
                                    </select>
                                  @elseif($feature->feature_type_id == 3)
                                    <input type="checkbox" name="features[1][{{ $feature->feature_type_id }}][]" value="1" />
                                  @endif
                                </td>
                                <td class="p-4 text-center">
                                  @if($feature->feature_type_id == 2)
                                    <select class="form-control" name="features[2][{{ $feature->feature_type_id }}][]">
                                      <option value=""></option>
                                      @foreach($feature->feature_values as $value)
                                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                                      @endforeach
                                    </select>
                                  @elseif($feature->feature_type_id == 3)
                                    <input type="checkbox" name="features[2][{{ $feature->feature_type_id }}][]" value="1" />
                                  @endif
                                </td>
                              </tr>
                            @endforeach --}}
                            <tr class="price-tr">
                              <td>Price</td>
                              <td class="">
                                <div class="input-group">
                                  {{ @$inventories[0]->sale_price }} {{ get_currency_prefix() }}
                                </div>
                              </td>
                              <td class="">
                                <div class="input-group">
                                  {{ @$inventories[1]->sale_price }} {{ get_currency_prefix() }}
                                </div>
                              </td>
                              <td class="">
                                <div class="input-group">
                                  {{ @$inventories[2]->sale_price }} {{ get_currency_prefix() }}
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      @endif
                    {{-- </div> --}}
                    {{-- <div role="tabpanel" class="tab-pane fade" id="reviews_tab"> --}}
                      {{-- reviewUiLookLikeFiver00942 + hasan00942 --}}
                      <div class="container">
                        <div class="row">
                          <style>
                            
                          </style>
                          @php

                            $total_reviews = $item->feedbacks->count();
                            $five_stars_reviews = $item->feedbacks->where('rating',5)->pluck('rating')->count();
                            $four_stars_reviews = $item->feedbacks->where('rating',4)->pluck('rating')->count();
                            $three_stars_reviews = $item->feedbacks->where('rating',3)->pluck('rating')->count();;
                            $two_stars_reviews = $item->feedbacks->where('rating',2)->pluck('rating')->count();
                            $one_star_reviews = $item->feedbacks->where('rating',1)->pluck('rating')->count();
                            if($total_reviews > 0){
                              $five_stars_bar = ($five_stars_reviews/$total_reviews)*100 . "%";
                              $four_stars_bar = ($four_stars_reviews/$total_reviews)*100 . "%";
                              $three_stars_bar = ($three_stars_reviews/$total_reviews)*100 . "%";
                              $two_stars_bar = ($two_stars_reviews/$total_reviews)*100 . "%";
                              $one_star_bar = ($one_star_reviews/$total_reviews)*100 . "%";
                              $avg_feedback = ($five_stars_reviews*5 + $four_stars_reviews*4 + $three_stars_reviews*3 + $two_stars_reviews*2 + $one_star_reviews) / $total_reviews;
                            }else{
                              $five_stars_bar = "0%";
                              $four_stars_bar = "0%";
                              $three_stars_bar = "0%";
                              $two_stars_bar = "0%";
                              $one_star_bar = "0%";
                              $avg_feedback = 0;
                            }


                          @endphp
                          <div class="col-12 mb-4 px-0" style="display:flex;align-items:center;height:25px;">
                            <h3 class="d-inline">@lang('theme.reviews_2', ['count' => number_format($total_reviews)])</h3>
                            <div class="d-inline pt-1 pl-2 clearfix">
                              <div class="pull-left">
                                @include('theme::layouts.ratings', ['ratings' => $avg_feedback])
                              </div>
                              @if($avg_feedback)
                                <span class="pull-left" style="margin-left:5px;font-weight:bold; color:#ffb33e;">{{ number_format($avg_feedback, 1) }}</span>
                              @endif
                            </div>
                          </div>
                          <div class="col-12 col-md-6 px-0">
                            <div class="d-flex cc-reviews @if(!$five_stars_reviews) grey-out @endif">
                              <span class="text-nowrap fw-bold pr-2 stars-label">5 @lang('theme.stars')</span>
                              <div class="progress">
                                <div class="progress-bar" style="--width: {{$five_stars_bar}};"></div>
                              </div>
                              <span class="pl-2 stars-count">({{ number_format($five_stars_reviews) }})</span>
                            </div>
                            <div class="d-flex cc-reviews @if(!$four_stars_reviews) grey-out @endif">
                              <span class="text-nowrap fw-bold pr-2 stars-label">4 @lang('theme.stars')</span>
                              <div class="progress">
                                <div class="progress-bar" style="--width: {{$four_stars_bar}};"></div>
                              </div>
                              <span class="pl-2 stars-count">({{ number_format($four_stars_reviews) }})</span>
                            </div>
                            <div class="d-flex cc-reviews @if(!$three_stars_reviews) grey-out @endif">
                              <span class="text-nowrap fw-bold pr-2 stars-label">3 @lang('theme.stars')</span>
                              <div class="progress">
                                <div class="progress-bar" style="--width: {{$three_stars_bar}};"></div>
                              </div>
                              <span class="pl-2 stars-count">({{ number_format($three_stars_reviews) }})</span>
                            </div>
                            <div class="d-flex cc-reviews @if(!$two_stars_reviews) grey-out @endif">
                              <span class="text-nowrap fw-bold pr-2 stars-label">2 @lang('theme.stars')</span>
                              <div class="progress">
                                <div class="progress-bar" style="--width: {{$two_stars_bar}};"></div>
                              </div>
                              <span class="pl-2 stars-count">({{ number_format($two_stars_reviews) }})</span>
                            </div>
                            <div class="d-flex cc-reviews @if(!$one_star_reviews) grey-out @endif">
                              <span class="text-nowrap fw-bold pr-2 stars-label">1 @lang('theme.star')</span>
                              <div class="progress">
                                <div class="progress-bar" style="--width: {{$one_star_bar}};"></div>
                              </div>
                              <span class="pl-2 stars-count">({{ number_format($one_star_reviews) }})</span>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 px-0">
                            <div class="fs-16px fw-bold">@lang('theme.rating_breakdown')</div>
                            <div class="fs-14px clearfix my-2">
                              <span class="pull-left text-go fs-16px">
                                @lang('theme.seller_communication_level')
                              </span>
                              <span class="rated pull-right" style="color:#ffb33e;">
                                @php
                                  $count = $item->feedback_breakdowns->pluck('seller_communication_level')->count();
                                  if($count > 0){
                                    $_review = $item->feedback_breakdowns->sum('seller_communication_level')/$count;
                                  }else{
                                    $_review = 0;
                                  }
                                @endphp
                                <i class="fas fa-star"></i> {{ number_format($_review, 1) }}
                              </span>
                            </div>
                            <div class="fs-14px clearfix my-2">
                              <span class="pull-left text-go fs-16px">
                                @lang('theme.recommend_to_a_friend')
                              </span>
                              <span class="rated pull-right" style="color:#ffb33e;">
                                @php
                                  $count = $item->feedback_breakdowns->pluck('recommend_to_a_friend')->count();
                                  if($count > 0){
                                    $_review = $item->feedback_breakdowns->sum('recommend_to_a_friend')/$count;
                                  }else{
                                    $_review = 0;
                                  }
                                @endphp
                                <i class="fas fa-star"></i> {{ number_format($_review, 1) }}
                              </span>
                            </div>
                            <div class="fs-14px clearfix my-2">
                              <span class="pull-left text-go fs-16px">
                                @lang('theme.service_as_descrived')
                              </span>
                              <span class="rated pull-right" style="color:#ffb33e;">
                                @php
                                  $count = $item->feedback_breakdowns->pluck('service_as_described')->count();
                                  if($count > 0){
                                    $_review = $item->feedback_breakdowns->sum('service_as_described')/$count;
                                  }else{
                                    $_review = 0;
                                  }
                                @endphp
                                <i class="fas fa-star"></i> {{ number_format($_review, 1) }}
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-4" id="feedbacksappend">
                          @forelse($item->latestFeedbacks as $feedback)
                            <hr />
                            <div class="col-12 col-md-12 px-0">
                              <div class="clearfix">
                                <div class="pull-left">
                                  @if($feedback->customer->image)
                                    <img src="{{ get_storage_file_url(optional($feedback->customer->image)->path, 'small') }}" style="border-radius:50%" width="50px" height="50px" /> 
                                  @else
                                    <div style="padding-top:12px; padding-left:16px; font-weight:bold; font-size:20px; border-radius:50%; background:#E1E1E1; height:50px; width:50px;">{{ substr($feedback->customer->name, 0, 1) }}</div>
                                  @endif
                                  {{-- <img src="https://media-exp1.licdn.com/dms/image/D4D03AQG_gPv_6ql6BQ/profile-displayphoto-shrink_100_100/0/1667669377803?e=1672876800&v=beta&t=NWTOSnq1xyqK9M_oH5EwgKN9CgYXg5zp6h3gLji_0s0" style="border-radius:50%" width="50px" height="50px" />  --}}
                                </div>
                                <div class="pull-left" style="padding-left:10px;">
                                  <div class="">
                                    <strong style="font-size:16px;">{{ optional($feedback->customer)->getName() }}</strong>
                                  </div>
                                  @if($feedback->customer->country2)
                                  <div class="">
                                    <img src="{{ url('images/flags/'.$feedback->customer->country2->flag) }}" width="28px" height="18px" />
                                    <span style="font-size:14px;" class="ml-2 pt-1">{{ $feedback->customer->country2->name }}</span>
                                  </div>
                                  @endif
                                </div>
                              </div>
                              <div class="product-review-detail">
                                <div class="mt-3 clearfix">
                                  <div class="pull-left">
                                    {{-- @include('theme::layouts.ratings-new', ['ratings' => $feedback->rating]) --}}
                                    <div class="product-info-rating">
                                      @for ($i = 0; $i < 5; $i++)
                                        @if ($feedback->rating - $i >= 1)
                                          <span class="rated"><i class="fas fa-star"></i></span>
                                        @elseif($feedback->rating - $i < 1 && $feedback->rating - $i > 0)
                                          <span class="rated"><i class="fas fa-star-half-alt"></i></span>
                                        @else
                                          <span><i class="fas fa-star"></i></span>
                                        @endif
                                      @endfor
                                      @if($feedback->rating > 0)
                                        <span class="rating-count product-rating-count">({{ $feedback->rating }})
                                      @endif
                                    </div>
                                  </div>
                                  <span class="pull-left" style="border-left:1px solid #E1E1E1; padding-left:5px; margin-left:3px;">{{ $feedback->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="">
                                  {!! $feedback->comment !!}
                                </div>
                                <div class="mt-2 helpful-review">
                                  <span class="" style="font-weight: bold;">@lang('theme.helpful_question') </span>
                                  <span data-href="{{ route('feedback_helpful_store', $feedback) }}" class="text-black yes pointer feedback-helpful" data-value="yes"><i class="fal fa-thumbs-up ml-2 mr-1"></i>@lang('theme.yes')</span>
                                  <span data-href="{{ route('feedback_helpful_store', $feedback) }}" class="text-black no pointer feedback-helpful" data-value="no"><i class="fal fa-thumbs-down ml-2 mr-1"></i>@lang('theme.no')</span>
                                </div>
                              </div>
                            </div>
                          @empty
                            <p class="lead text-center text-muted my-4">@lang('theme.no_reviews')</p>
                          @endforelse
                        </div>
                        @if(!empty($item->latestFeedbacks) && $total_reviews > 10)
                          <span class="text-gc fw-bold fs-14px pointer" id="loadMoreReviews" data-type="product" data-id="{{ $item->id }}" data-page="1">+ See More</span>
                        @endif
                      </div>
                      {{-- review old ui/ux @forelse($item->latestFeedbacks as $feedback)
                          <p>
                            <b>{{ optional($feedback->customer)->getName() }}</b>

                            <span class="pull-right small">
                              <b class="text-success">@lang('theme.verified_purchase')</b>
                              <span class="text-muted"> | {{ $feedback->created_at->diffForHumans() }}</span>
                            </span>
                          </p>

                          <p>{!! $feedback->comment !!}</p>

                          @include('theme::layouts.ratings', ['ratings' => $feedback->rating])

                          @unless($loop->last)
                            <div class="sep"></div>
                          @endunless
                        @empty
                          <p class="lead text-center text-muted my-4">@lang('theme.no_reviews')</p>
                        @endforelse --}}
                    {{-- </div> --}}
                  </div>
                </div>

                {{--<h5 class="text-black product-info-title">@lang('theme.product_desc')</h5>
                <div class="mt-3">{!! $item->product->description !!}</div> --}}
              </div>
              @if($item->product->video_link)
                <div class="col-12 col-md-10 col-lg-8 product-video-col my-4 pr-3" style="padding-right:30px" id="product_desc_section">
                  <h5 class="text-black product-info-title">@lang('theme.why_work_with_a_pro_question')</h5>
                  <div class="mt-3">
                    <iframe class="video-box" src="{{ $item->product->video_link }}">
                    </iframe>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
        {{-- <div class="col-md-1"></div> --}}
        <div class="col-xs-12 col-sm-12 d-none d-md-block col-md-4 col-lg-3-" id="featuresKeyBoxHere">
          <div class="sticky-top key-features-box">
            <div class="clearfix">
              <div class="seller-info space20 pull-left">
                <div class="text-muted small space10">
                  @lang('theme.sold_by')
                </div>

                <img src="{{ get_storage_file_url(optional($item->shop->logoImage)->path, 'thumbnail') }}" class="seller-info-logo img-sm" alt="{{ trans('theme.logo') }}">

                <span class="seller-info-name">
                  {!! $item->shop->getQualifiedName() !!}
                </span>

                <div class="space10"></div>

                {{-- disable the rating link --}}
                @include('theme::layouts.ratings',
                  [
                    'ratings' => ($item->shop->ratings + ($item->shop->fake_review_rating / 1)) / 2,
                    'count' => $item->shop->ratings_count + $item->shop->fake_review_count,
                    'shop' => true
                  ])

              </div><!-- /.seller-info -->
              
              <div class="pull-right" id="order-total-row">
                <span id="summary-total" class="text-muted fs-20px">{{ trans('theme.notify.will_calculated_on_select') }}</span>
              </div>
            </div>

            {{-- <div class="clearfix space10"></div> --}}
            
            <div class="row">
              
              <div class="col-12 p-1 mb-2">
                <div class="row">
                  <div class="col-12 text-center">
                      <div class="navbar-nav- pkg-box clearfix nav-tabs-">
                        <div class="nav-link active pointer" data-toggle="#plan1">
                          Nano
                        </div>
                        @if(isset($inventories[1]))
                          <div class="nav-link pointer" data-toggle="#plan2">
                            Micro
                          </div>
                        @endif
                        @if(isset($inventories[2]))
                          <div class="nav-link pointer" data-toggle="#plan3">
                            Mega
                          </div>
                        @endif
                      </div>
                  </div>
                </div>
            
                <div class="pkg-content p-3">
                  @if(isset($inventories[0]))
                  <div id="plan1" class="tab-pane- fade- in- active-">
                    <span class="fw-bold fs-16px">{{ $inventories[0]->title }}</span>
                    <p>{!! $inventories[0]->description !!}</p>
                    <ul class="key_feature_list" id="item_key_features">
                        @if($inventories[0]->feature_inventory)
                          <li>
                            <i class="fa fa-check mr-1"></i>
                            <span>{{ $inventories[0]->feature_inventory->feature_value->value}} {{ $inventories[0]->feature_inventory->feature->name}}</span>
                          </li>
                        @endif
                    </ul>
                  </div>
                  @endif
                  @if(isset($inventories[1]))
                  <div id="plan2" class="tab-pane- fade- d-none">
                    <span class="fw-bold fs-16px">{{ $inventories[1]->title }}</span>
                    <p>{!! $inventories[1]->description !!}</p>
                    <ul class="key_feature_list" id="item_key_features">
                      @if($inventories[1]->feature_inventory)
                        <li>
                          <i class="fa fa-check mr-1"></i>
                          <span>{{ $inventories[1]->feature_inventory->feature_value->value}} {{ $inventories[0]->feature_inventory->feature->name}}</span>
                        </li>
                      @endif
                    </ul>
                  </div>
                  @endif
                  @if(isset($inventories[2]))
                  <div id="plan3" class="tab-pane- fade- d-none">
                    <span class="fw-bold fs-16px">{{ $inventories[2]->title }}</span>
                    <p>{!! $inventories[2]->description !!}</p>
                    <ul class="key_feature_list" id="item_key_features">
                      @if($inventories[2]->feature_inventory)
                        <li>
                          <i class="fa fa-check mr-1"></i>
                          <span>{{ $inventories[2]->feature_inventory->feature_value->value}} {{ $inventories[0]->feature_inventory->feature->name}}</span>
                        </li>
                      @endif
                    </ul>
                  </div>
                  @endif
                </div>
              </div>
              @if($item->key_features)
                <div class="col-12">
                  <div class="mb-2 key-feature-heading">
                    <h4>{!! trans('theme.section_headings.key_features') !!}</h4>
                  </div>
                  <ul class="key_feature_list" id="item_key_features">
                    @foreach (unserialize($item->key_features) as $key_feature)
                      <li>
                        <i class="fa fa-check mr-1"></i>
                        <span>{!! $key_feature !!}</span>
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="col-12 mb-2">
                <a href="{{ route('direct.checkout', $item->slug) }}" class="btn btn-warning w-100" style="height: 43px;" id="buy-now-btn">
                  <i class="fal fa-rocket-launch"></i> @lang('theme.button.buy_now')
                </a>
              </div>
              {{--    <div class="col-12 col-md-12 col-lg-6 pl-lg-1 product-buy-add-cart-btn-col">
                    <a data-link="{{ route('cart.addItem', $item->slug) }}" class="btn add-to-card-now-btn sc-add-to-cart w-100">
                      <i class="fal fa-shopping-cart"></i> @lang('theme.button.add_to_cart')
                    </a>
                  </div> --}}
            </div>

            <div class="pro-cs-btn" href="javascript:void(0)" data-toggle="modal" data-target="#contactSupportModal" style="height: 43px;">
              {!! trans('theme.contact_support') !!}
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.container -->    
  </div>
</section>