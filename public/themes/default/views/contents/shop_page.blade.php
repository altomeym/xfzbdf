<section class="my-5-">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div id="content-wrapper" style="margin-top: 0px;">
          <div class="mb-3 position-relative">
            <div id="ei-slider" class="ei-slider">
              <ul class="ei-slider-large">
                @foreach ($sliders as $slider)
                  <li>
                    <a href="{{ $slider['link'] }}">
                      <img src="{{ get_storage_file_url($slider['feature_image']['path'] ?? null, 'full') }}" alt="{{ $slider['title'] ?? 'Slider Image ' . $loop->count }}">
                    </a>
                    {{-- <div class="banner__content-left"></div> --}}
                    {{-- <div class="banner__content-left px-2 px-md-4">
                      <div class="header__search mx-md-2 my-1">
                        <div class="mb-3 u-find-perfect">
                          @php
                            if($shop_appearance && $shop_appearance->heading_text)
                              $freelance = $shop_appearance->heading_text;
                            else
                              $freelance = 'freelancer';
                          @endphp
                          {!! trans('app.find_the_perfect_freelance_service_for_your_business', [
                            'freelanceService' => '<span class="d-inline"><br/><span class="freelance-text font-italic">'.$freelance.'</span></span>'
                          ]) !!} 
                        </div>
                      </div>
                    </div> --}}
                  </li>
                @endforeach
              </ul><!-- ei-slider-large -->
          
              <ul class="ei-slider-thumbs">
                <li class="ei-slider-element">{!! trans('app.curent') !!}</li>
                @foreach ($sliders as $slider)
                  <li>
                    <a href="javascript:void(0)">{!! trans('app.slide') !!} {{ $loop->count }}</a>
                    <img src="{{ get_storage_file_url($slider['images'][0]['path'] ?? ($slider['feature_image']['path'] ?? null),'slider_thumb') }}" alt="thumbnail {{ $loop->count }}" />
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="freelance-sec w-100 p-2 p-md-4">
              <div class="row">
                <div class="col-12">
                  <div class="mb-3 u-find-perfect">
                    {!! trans('app.find_the_perfect_freelance_service_for_your_business', [
                      'freelanceService' => '<span class="d-inline"><br/><span class="freelance-text font-italic">freelancer services</span></span>'
                    ]) !!}
                  </div>
                </div>
                <div class="col-12">
                  {!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-categories-form', 'class' => 'navbar-left navbar-search', 'role' => 'search']) !!}
                  <div class="search-box"style="">
                    <div class="search-box__input">
                      {!! Form::text('q', Request::get('q'), ['id' => 'autoSearchInput2', 'placeholder' => trans('theme.main_searchbox_placeholder'), 'autocomplete' => 'off', 'data-search']) !!}
                    </div>

                    <div class="search-box__button">
                      <button type="submit" class="navbar-search-submit" onclick="document.getElementById('search-categories-form').submit()">
                        {{-- <a class="navbar-search-submit" onclick="document.getElementById('search-categories-form').submit()"> --}}
                        <i class="fal fa-search"></i>
                        {{-- </a> --}}
                      </button>
                    </div>
        
                    {{-- Search Autocomplete package load --}}
                    @if (is_incevio_package_loaded('searchAutocomplete'))
                      @include('searchAutocomplete::_autoComplete')
                    @endif
                  </div>
                  {!! Form::close() !!}
                </div>
                <div class="col-12 w-100">
                  @if($shop_appearance && $shop_appearance->popular_links)
                    <div class="d-none d-sm-block px-2 mt-2">
                      <strong>{!! trans('app.popular') !!}:</strong>
                      @foreach($shop_appearance->popular_links as $popular)
                        <a href="{{ @$popular['link'] }}" class="popular-links">
                          {{ @$popular['title'] }}
                        </a>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          
          <!-- Featured category stat -->
          @if($shop_appearance && $shop_appearance->slider_links && count($shop_appearance->slider_links) > 6)
            <section class="mt-1 mb-0 translX0 container">
              <div class="row mb-2 sub-cat-scroll position-relative">
                <div class="col-12 px-3 sub-cat-slider d-flex">
                  <span class="left d-none pointer">
                    <span class="svg-qv icon-chevron" aria-hidden="true">
                        <svg width="8" height="15" viewBox="0 0 8 15" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.2279 0.690653L7.84662 1.30934C7.99306 1.45578 7.99306 1.69322 7.84662 1.83968L2.19978 7.5L7.84662 13.1603C7.99306 13.3067 7.99306 13.5442 7.84662 13.6907L7.2279 14.3094C7.08147 14.4558 6.84403 14.4558 6.69756 14.3094L0.153374 7.76518C0.00693607 7.61875 0.00693607 7.38131 0.153374 7.23484L6.69756 0.690653C6.84403 0.544184 7.08147 0.544184 7.2279 0.690653Z"></path>
                        </svg>
                    </span>
                  </span>
                  <span class="right d-none d-md-block pointer">
                    <span class="svg-qv icon-chevron" aria-hidden="true">
                      <svg width="8" height="16" viewBox="0 0 8 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.772126 1.19065L0.153407 1.80934C0.00696973 1.95578 0.00696973 2.19322 0.153407 2.33969L5.80025 8L0.153407 13.6603C0.00696973 13.8067 0.00696973 14.0442 0.153407 14.1907L0.772126 14.8094C0.918563 14.9558 1.156 14.9558 1.30247 14.8094L7.84666 8.26519C7.99309 8.11875 7.99309 7.88131 7.84666 7.73484L1.30247 1.19065C1.156 1.04419 0.918563 1.04419 0.772126 1.19065Z"></path>
                      </svg>
                    </span>
                  </span>
            
                  @foreach($shop_appearance->slider_links as $slider)
                  <a href="{{ @$slider['link'] }}" class="card mr-1 subcat-on-cat" style="max-height:120px">
                    <div class="card-body">
                      <img src="{{ @$slider['image'] }}" height="70px" width="70px">
                      <span class="d-block mt-2 text-color sub-cat-name">{{ @$slider['title'] }}</span>
                    </div>
                  </a>
                  @endforeach
                </div>
              </div>
            </section>
          @endif

          {{-- bussiness highlights --}}
          <section class="mb-4 p-2 py-md-3 px-md-5" style="background-color:rgb(17, 17, 109)">
            <div class="shell-banner-">
              <div class="container">
                <div class="shell-banner__inner-">
                  <div class="row">
                    <div class="col-lg-6 col-12 my-2 px-2">
                      <div class="image-banner- ">
                        <div class="shell-banner__box- ">
                          <div class="shell-banner__img-">
                            <div class="my-4 fw-bold" style="font-size:25px; color:white">
                              {{ $shop_appearance && $shop_appearance->info_section_heading ? $shop_appearance->info_section_heading : 'A business solution designed for teams' }}
                            </div>
                            <div class="my-4 fs-16px" style="color:white">
                              {{ $shop_appearance && $shop_appearance->info_section_paragraph ? $shop_appearance->info_section_paragraph : 'Upgrade to a curated experience packed with tools and benefits, dedicated to businesses' }}
                            </div>
                            @php
                              $point1 = $point2 = $point3 = 'Connect to freelancers with proven business experience';
                              if($shop_appearance && $shop_appearance->info_section_bullets){
                                $bullet_points = $shop_appearance->info_section_bullets;
                                if(isset($bullet_points[0]) && $bullet_points[0] != ''){
                                  $point1 = $bullet_points[0];
                                }

                                if(isset($bullet_points[1]) && $bullet_points[1] != ''){
                                  $point2 = $bullet_points[1];
                                }
                                
                                if(isset($bullet_points[2]) && $bullet_points[2] != ''){
                                  $point3 = $bullet_points[2];
                                }
                                
                              }
                            @endphp
                            <div class="my-2 clearfix" style="font-size:12px; color:white">
                              <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                              <span class="pl-2 fs-14px">{{ $point1 }}</span>
                            </div>
                            <div class="my-2 clearfix" style="font-size:12px; color:white">
                              <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                              <span class="pl-2 fs-14px">{{ $point2 }}</span>
                            </div>
                            <div class="my-2 clearfix" style="font-size:12px; color:white">
                              <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                              <span class="pl-2 fs-14px">{{ $point3 }}</span>
                            </div>
                          </div>
                        </div>                  
                      </div>
                    </div>
                    {{-- <link href='https://fonts.googleapis.com/css?family=DomaineDisplay:400,700,600' rel='stylesheet' type='text/css'> --}}       

                    <div class="col-lg-6 col-12 my-2 px-2">
                      <div class="image-banner pt-1">
                        <div class="shell-banner__box ">
                          <div class="shell-banner__img">
                            @php $match; @endphp
                            @if($shop_appearance && preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $shop_appearance->info_section_banners, $match))
                              <iframe width="200" src="https://www.youtube.com/embed/{{$match[4]}}" class="shop-yt-video">
                              </iframe>
                            @elseif($shop_appearance && $shop_appearance->info_section_banners)
                              <img src="{{ $shop_appearance->info_section_banners }}" alt="Banner Image" title="Banner Image" height="200px"/>
                            @else
                              <img src="https://tiejet.com/image/images/R4OYuN8rydUrmwKlnbXzD6sLs2OnrVO11Mnz6frw.png?p=full" alt="Banner Image" title="Banner Image">
                            @endif
                          </div>
                        </div>                  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    
          <!-- Deal of Day start -->
          @if($shop_appearance && $shop_appearance->hot_product && $shop_appearance->featured_products)
            @php
              
              $hot_product = \App\Models\Product::with(['inventory',
                  'inventory.avgFeedback:rating,count,feedbackable_id,feedbackable_type',
                  'inventory.images:path,imageable_id,imageable_type'
                ])->where('id', $shop_appearance->hot_product)->first();

              if($hot_product){
                $deal_of_the_day = $hot_product->inventory;
              }else{
                $deal_of_the_day = '';
              }

              $featured_items = \App\Models\Product::with(['inventory',
                  'inventory.avgFeedback:rating,count,feedbackable_id,feedbackable_type',
                  'inventory.images:path,imageable_id,imageable_type'
                ])->whereIn('id', $shop_appearance->featured_products)->get();

              $featured_items = $featured_items->pluck('inventory');
              
              if($hot_product){
                $deal_of_the_day = $hot_product->inventory;
              }else{
                $deal_of_the_day = '';
              }

            @endphp
            <section>
              <div class="best-deal">
                <div class="container">
                  <div class="best-deal__inner">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="best-deal__col">
                          <div class="best-deal__header">
                            <div class="sell-header">
                              <div class="sell-header__title">
                                <h2>{{ trans('theme.deal_of_the_day') }}</h2>
                              </div>
                              <div class="header-line">
                                <span></span>
                              </div>
                            </div>
                          </div>

                          <div class="week-deal">
                            <div class="week-deal__label">{{ trans('theme.hot') }}</div>
                            <div class="week-deal__inner">
                              <div class="week-deal__slider deal-slider">
                                @foreach ($deal_of_the_day->images as $img)
                                  <div class="week-deal__slider-item">
                                    <img src="{{ get_storage_file_url($img->path, 'medium') }}" alt="{{ $deal_of_the_day->title }}">
                                  </div>
                                @endforeach
                              </div>
                              <div class="week-deal__details">
                                <div class="week-deal__details-name">
                                  <a href="{{ route('show.product', $deal_of_the_day->slug) }}">{!! strip_tags($deal_of_the_day->title) !!}</a>
                                </div>

                                <div class="week-deal__details-price">
                                  <p>
                                    <span class="regular-price">
                                      {!! get_formated_price($deal_of_the_day->current_sale_price(), config('system_settings.decimals', 2)) !!}
                                    </span>

                                    @if ($deal_of_the_day->hasOffer())
                                      <span class="old-price">
                                        {!! get_formated_price($deal_of_the_day->sale_price, config('system_settings.decimals', 2)) !!}
                                      </span>
                                    @endif
                                  </p>
                                </div>

                                <div class="best-seller__item-rating">
                                  @include('theme::partials._vertical_ratings', ['ratings' => $deal_of_the_day->ratings])
                                </div>

                                <div class="week-deal__details-description">
                                  <p>{{ substr(strip_tags($deal_of_the_day->description), 0, 100) }}</p>
                                </div>

                                <div class="week-deal__details-list">
                                  <ul>
                                    @if ($feature = unserialize($deal_of_the_day->key_features))
                                      @for ($i = 0; $i < 3; $i++)
                                        <li><i class="fal fa-check"></i> <span>{{ !empty($feature[$i]) ? $feature[$i] : null }}</span></li>
                                      @endfor
                                    @endif
                                  </ul>
                                </div>

                                <div class="week-deal-btns mt-4">
                                  <a href="javascript:void(0)" data-link="{{ route('cart.addItem', $deal_of_the_day->slug) }}" class="sc-add-to-cart" tabindex="0">
                                    <i class="fal fa-shopping-cart"></i>
                                    <span class="d-none d-sm-inline-block">{{ trans('theme.add_to_cart') }}</span>
                                  </a>

                                  @if (is_incevio_package_loaded('wishlist'))
                                  <a href="javascript:void(0)" data-link="{{ route('wishlist.add', $deal_of_the_day) }}" class="add-to-wishlist">
                                    <i class="far fa-heart"></i> {{ trans('theme.button.add_to_wishlist') }}
                                  </a>
                                  @endif

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> <!-- .col-lg-* -->

                      @if ($featured_items)
                        <div class="col-lg-4">
                          <div class="best-deal__col">
                            <div class="best-deal__header">
                              <div class="sell-header">
                                <div class="sell-header__title">
                                  <h2>{{ trans('theme.featured') }}</h2>
                                </div>
                                <div class="header-line">
                                  <span></span>
                                </div>
                              </div>
                            </div>
                            <div class="best-seller">
                              <div class="best-seller__slider best-seller-slider">
                                @include('theme::partials._product_vertical', ['products' => $featured_items])
                              </div>
                            </div>
                          </div>
                        </div> <!-- .col-lg-4 -->
                      @endif
                    </div> <!-- .row -->
                  </div>
                </div>
              </div> <!-- .best-deal -->
            </section>
          @endif
          @if($products)
            <section class="container new-buy-container">
              <div class="row">
                <div class="col-12 mb-4 text-black">
                  <h2>{!! trans('app.new_buying_on_shop', ['shop' => $shop->name]) !!}</h2>
                  <p>{!! trans('app.discover_shop_with_a_greate_track_record_at_guiding_new_buyers', ['shop' => $shop->name]) !!}</p>
                </div>
              </div>
              <div class="row- owl-carousel owl-theme" id="owl-demo">
                @foreach ($products as $index => $item)
                  @php
                    $item_images = $item->images->count() ? $item->images : $item->product->images;
                  @endphp
                  <div class="col-12- col-sm-4- col-md-3- col-lg-2-5- px-1 -col-lg-3- col-12 clearfix mb-3">
                    <div class="row mx-1 card new-product-card v-img justify-content-center align-items-center bg-white" style="max-height:unset;">
                      <div class="col-5- col-sm-12 p-0">
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
                                          title="{{ $item->title }}"
                                          />
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
                      <div class="col-7- col-sm-12 p-0 card-detail">
                        <div class="m-2">
                            <img src="{{ get_storage_file_url(optional($item->shop->logoImage)->path, 'thumbnail') }}" class="seller-info-logo img-sm" />
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
              </div>
            </section>
          @endif
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>
