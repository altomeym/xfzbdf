{{-- new code added by hassan00942 --}}

  @foreach ($products as $index => $item)
    @php
      $item_images = $item->images->count() ? $item->images : $item->product->images;
    @endphp
    <div class="col-12 col-sm-4 col-md-3 @if($colum == 5) col-lg-2-5 @endif px-1 -col-lg-3">
      <div class="row mx-1 card new-product-card justify-content-center align-items-center">
        <div class="col-5 col-sm-12 p-0">
          <a class="product-link" href="{{ route('show.product', $item->slug) }}">
            <div class="row">
              <div class="col-12 product-image-slider">
                <div class="carousel slide productCardImagesSlider" data-interval="false" id="productCardImagesSlider{{$index}}" data-ride="carousel">
                  <!-- Indicators -->
                  {{-- uncomment me for carousel + enableCarousel00942 --}}
                  {{-- <ol class="carousel-indicators">
                    @foreach ($item_images as $index_image => $img)
                      <li data-target="#productCardImagesSlider{{$index}}" data-slide-to="{{ $index_image }}" class="@if($index_image == 0) active @endif"></li>
                    @endforeach
                  </ol> --}}
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    @foreach ($item_images as $index_image => $img)
                      <div class="item @if($index_image == 0) active @endif">
                        <img
                            src="{{ get_storage_file_url($img->path, 'large') }}"
                            alt="{{ $item->title }}"
                            title="{{ $item->title }}" />
                      </div>
                      {{-- remove me for carousel + enableCarousel00942 --}}
                      @if($index_image == 0) @php break @endphp @endif
                    @endforeach
                  </div>
                  {{-- uncomment me for carousel + enableCarousel00942 --}}
                  {{-- <!-- Left and right controls -->
                  <a class="left carousel-control" href="#productCardImagesSlider{{$index}}" data-slide="prev">
                    <span><i class="fa"><svg width="8" height="15" viewBox="0 0 8 15" xmlns="http://www.w3.org/2000/svg"><path d="M7.2279 0.690653L7.84662 1.30934C7.99306 1.45578 7.99306 1.69322 7.84662 1.83968L2.19978 7.5L7.84662 13.1603C7.99306 13.3067 7.99306 13.5442 7.84662 13.6907L7.2279 14.3094C7.08147 14.4558 6.84403 14.4558 6.69756 14.3094L0.153374 7.76518C0.00693607 7.61875 0.00693607 7.38131 0.153374 7.23484L6.69756 0.690653C6.84403 0.544184 7.08147 0.544184 7.2279 0.690653Z"></path></svg></i></span>
                  </a>
                  <a class="right carousel-control" href="#productCardImagesSlider{{$index}}" data-slide="next">
                    <span><i class="fa"><svg width="8" height="16" viewBox="0 0 8 16" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.772126 1.19065L0.153407 1.80934C0.00696973 1.95578 0.00696973 2.19322 0.153407 2.33969L5.80025 8L0.153407 13.6603C0.00696973 13.8067 0.00696973 14.0442 0.153407 14.1907L0.772126 14.8094C0.918563 14.9558 1.156 14.9558 1.30247 14.8094L7.84666 8.26519C7.99309 8.11875 7.99309 7.88131 7.84666 7.73484L1.30247 1.19065C1.156 1.04419 0.918563 1.04419 0.772126 1.19065Z"></path>
                  </svg></i></span>
                  </a> --}}
                </div>
                <ul class="product-labels">
                  @foreach ($item->getLabels() as $label)
                    @if($label != "Free Delivery")
                      <li>{!! $label !!}</li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          </a>
        </div>
        <div class="col-7 col-sm-12 p-0 card-detail">
          <div class="m-2 d-none d-md-block">
              <img src="{{ get_storage_file_url(optional($item->shop->logoImage)->path, 'thumbnail') }}" class="seller-info-logo img-sm"/>
              <span class="ml-2 fs-12px">{!! $item->shop->name  !!}</span>
          </div>            
          <a class="product-link" href="{{ route('show.product', $item->slug) }}">
            <div class="m-2 title">
              {{ $item->title }}
            </div>
          </a>
          @include('theme::layouts.product_list_rating_button', ['ratings' => $item->ratings, 'count' => $item->ratings_count])
          <hr class="m-0"/>
          @include('theme::layouts.product_list_price_section', ['item' => $item])          
        </div>
      </div>
    </div>
  @endforeach

<div class="w-100 mt-2 text-center">
  {{ $products->appends(request()->input())->links('theme::layouts.pagination') }}
</div>
<?php /*
old ui
@include('theme::contents.product_list_top_filter')

<div class="row product-list">
  @foreach ($products as $item)
    <div class="col-12 col-sm-4 col-md-{{ $colum ?? '3' }} p-0">
      <div class="product product-grid-view sc-product-item">
        <ul class="product-info-labels">
          @if ($item->shop->isVerified() && Route::current()->getName() != 'show.store')
            <li>@lang('theme.from_verified_seller')</li>
          @endif

          @foreach ($item->getLabels() as $label)
            <li>{!! $label !!}</li>
          @endforeach
        </ul>

        <div class="product-img-wrap">
          <img class="product-img-primary" src="{{ get_product_img_src($item, 'medium') }}" alt="{{ $item->title }}" title="{{ $item->title }}" />

          <img class="product-img-alt" src="{{ get_product_img_src($item, 'medium', 'alt') }}" alt="{{ $item->title }}" title="{{ $item->title }}" />

          <a class="product-link" href="{{ route('show.product', $item->slug) }}"></a>
        </div>

        <div class="product-actions btn-group">
           @if(is_incevio_package_loaded('wishlist'))
            @include('wishlist::_product_list_wishlist_btn')
          @endif
          <a class="btn btn-default flat itemQuickView" href="{{ route('quickView.product', $item->slug) }}">
            <i class="far fa-external-link" data-toggle="tooltip" title="@lang('theme.button.quick_view')"></i> <span>@lang('theme.button.quick_view')</span>
          </a>

          <a class="btn btn-primary flat sc-add-to-cart" data-link="{{ route('cart.addItem', $item->slug) }}">
            <i class="far fa-shopping-cart"></i> @lang('theme.button.add_to_cart')
          </a>
        </div>

        <div class="product-info">
          @include('theme::layouts.ratings', ['ratings' => $item->ratings, 'count' => $item->ratings_count])
          {{-- @include('theme::layouts.ratings', ['ratings' => $item->feedbacks->avg('rating'), 'count' => $item->feedbacks_count]) --}}

          <a href="{{ route('show.product', $item->slug) }}" class="product-info-title" data-name="product_name">{{ $item->title }}</a>

          <div class="product-info-availability">
            @lang('theme.availability'): <span>{{ $item->stock_quantity > 0 ? trans('theme.in_stock') : trans('theme.out_of_stock') }}</span>
          </div>

          @include('theme::layouts.pricing', ['item' => $item])

          <div class="product-info-desc"> {!! $item->description !!} </div>

          <ul class="product-info-feature-list">
            @if (config('system_settings.show_item_conditions'))
              <li>{!! $item->condition !!}</li>
            @endif
            {{-- <li>{{ $item->manufacturer->name }}</li> --}}
          </ul>
        </div><!-- /.product-info -->
      </div><!-- /.product -->
    </div><!-- /.col-md-* -->

    @if ($loop->iteration % 4 == 0)
      <div class="clearfix"></div>
    @endif
  @endforeach
</div><!-- /.row .product-list -->

<div class="sep"></div>

<div class="row pagenav-wrapper text-center mb-5 mt-3">
  {{ $products->appends(request()->input())->links('theme::layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->
*/ ?>