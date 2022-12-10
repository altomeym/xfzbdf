<div id="primary-navigation">
  {{-- condition added by hassan0942g + taskShopPageUi00942 --}}
  @if(request()->route()->getName() != 'show.store')
  <div class="header__top">
    <div class="container">
      <div class="header__top-inner py-0">
        <div class="header__top-welcome">
          {{-- @if (is_incevio_package_loaded('zipcode') && Session::has('zipcode')) --}}
          @if (is_incevio_package_loaded('zipcode') && Session::has('zipcode_default'))
            <a class="modalAction" href="{{ route(config('zipcode.routes.shipTo')) }}">
              <i class="fal fa-location-arrow"></i> {{ trans('theme.ship_to') . ' ' . Session::get('zipcode_default') }}
            </a>
          @else
            <h3>{{ trans('theme.welcome') . ' ' . config('app.name') }}</h3>
          @endif

          {{-- @unless(empty($promotional_tagline['text']))
            <a style="text-decoration: none" href="{{ $promotional_tagline['action_url'] ?? 'javascript:void(0)' }}">
              {!! $promotional_tagline['text'] !!}
            </a>
          @endunless --}}
        </div>
        
        <div class="header__top-utility">
          <ul>
            {{-- countries dropdown + php tag + li tag + added by hassan --}}
            @php
              $countries = \App\Helpers\ListHelper::cache_country_wise_websites();
              $current_web = url('/');
              $active_website = $countries->filter(function($item) use($current_web) {
                return $item->website == $current_web;
              })->first();
            @endphp
            <li>
              <div class="custom-dropdown">
                @if($active_website && $active_website->country)
                  <div class="dropbtn">
                    <a href="#">
                      <img class="rounded-2px" src="https://tiejet.net/images/flags/{{ $active_website->country->iso_code }}.png" />
                      <span>{{ $active_website->country->name }}</span>
                      <i class="pl-5px fa fa-caret-down"></i>
                    </a>
                  </div>
                @endif
                <div class="custom-dropdown-content col-12 col-md-10 col-lg-8 py-2 px-3">
                  <div class="row px-1">
                    @foreach($countries as $index => $country)
                      <div class="col-md-3 col-lg-2 mb-0">
                        <div class="web-box @if($current_web == $country->website) active @else inactive @endif">
                          <a href="{{ $country->website }}">
                            <img class="rounded-2px" src="https://tiejet.net/images/flags/{{ $country->country->iso_code }}.png" /><span class="pl-5px">{{ $country->country->name }}</span>
                          </a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  {{-- <div class="custom-dropdown-row">
                    <div class="custom-dropdown-column">
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                    </div>
                    <div class="custom-dropdown-column">
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                    </div>
                    <div class="custom-dropdown-column">
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                    </div>
                    <div class="custom-dropdown-column">
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                    </div>
                    <div class="custom-dropdown-column">
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                    </div>
                    <div class="custom-dropdown-column">
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                      <a href="#"class=""><img class="rounded-2px" src="https://tiejet.net/images/flags/AF.png" /><span class="pl-5px">Argentina</span></a>
                    </div>
                  </div> --}}
                </div>
              </div> 
            </li>
            @auth('customer')
              <li class="image-icon">
                <a href="{{ route('account', 'dashboard') }}">
                  <i class="fal fa-user"></i>
                  <span>{{ trans('theme.hello') .
                      ', ' .
                      Auth::guard('customer')->user()->getName() }}</span>
                </a>
              </li>

              <li class="image-icon">
                <a href="{{ route('customer.logout') }}">
                  <i class="fal fa-power-off"></i>
                  <span>{{ trans('theme.logout') }}</span>
                </a>
              </li>
            @else
              <li class="image-icon">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                  <i class="fal fa-user"></i>
                  <span>{{ trans('theme.sing_in') }}</span>
                </a>
              </li>
            @endauth

            @if (is_wallet_configured_for('customer'))
              <li class="image-icon">
                <a href="{{ route('customer.account.wallet') }}">
                  <i class="fas fa-wallet"></i>
                  @if (Auth::guard('customer')->check())
                    <strong>{{ get_formated_currency(Auth::guard('customer')->user()->balance) }}</strong>
                  @else
                    {{ trans('wallet::lang.wallet') }}
                  @endif
                </a>
              </li>
            @endif
 
            {{-- <li class="image-icon">
              <a href="{{ route('brands') }}">
                <i class="fal fa-crown"></i> {{ trans('theme.all_brands') }}
              </a>
            </li>

            <li class="image-icon">
              <a href="{{ route('shops') }}">
                <i class="fal fa-store"></i> {{ trans('theme.all_shops') }}
              </a>
            </li> --}}

            <li class="image-icon">
              <a href="{{ route('account', 'orders') }}">
                <!-- <img src="images/truck.svg" alt=""> -->
                <i class="fal fa-map-marker-alt"></i> {{ trans('theme.track_your_order') }}
              </a>
				
				 <li class="image-icon">
              <a href="https://tiejet.com/office/public/login">
                <!-- <img src="images/truck.svg" alt=""> -->
                <i class="fal fa-user-secret"></i> Digital Office
              </a>
				
            </li>
            <li class="image-icon">
              <a href="https://support.tiejet.com">
                <i class="fal fa-life-ring"></i> {{ trans('theme.support') }}
              </a>
            </li>

            {{-- <li class="currency">
              <select name="currency" id="currencyChange">
                <option value="usd" data-imagesrc="{{ theme_asset_url('icon/lang3.png') }}">USD</option>
                <option value="jpy" data-imagesrc="{{ theme_asset_url('icon/lang4.png') }}">JPY</option>
                <option value="eur" data-imagesrc="{{ theme_asset_url('icon/lang5.png') }}">EUR</option>
                <option value="aud" data-imagesrc="{{ theme_asset_url('icon/lang6.png') }}">AUD</option>
              </select>
            </li> --}}

            <li class="language">
              <select name="lang" id="languageChange">
                @foreach (config('active_locales') as $lang)
                  <option dd-link="{{ route('locale.change', $lang->code) }}" value="{{ $lang->code }}" data-imagesrc="{{ get_flag_img_by_code(array_slice(explode('_', $lang->php_locale_code), -1)[0], true) }}" {{ $lang->code == \App::getLocale() ? 'selected' : '' }}>
                    {{ $lang->language }}
                  </option>
                @endforeach
              </select>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="header__top-inner"></div>
  @endif

  <div class="header__main @if(request()->route()->getName() == 'show.store') border-bottom @endif">
    <div class="container">
      <div class="header__main-inner">
        <div class="header__menu-icon">
          <div class="menu-icon">
            <a class="main-menu-toggle" href="javascript:void(0)"><i class="fal fa-bars"></i></a>
          </div>
        </div>
        <div class="header__logo mr-3">
          <a href="{{ url('/') }}">
            @if(request()->route()->getName() == 'show.store' && isset($shop))
              <img src="{{ get_storage_file_url(optional($shop->logoImage)->path, 'logo') }}" class="brand-logo" alt="{{ $shop->name }}" title="{{ $shop->name }}">
            @else
              <img src="{{ get_logo_url('system', 'logo') }}" class="brand-logo" alt="{{ trans('theme.logo') }}" title="{{ trans('theme.logo') }}">
            @endif
          </a>
        </div>

        <!-- Customer Care -->
        <div class="d-none d-xl-block col-md-auto">
          <div class="d-flex">
            <i class="fal fa-user-headset fa-3x"></i>
            <div class="ml-2">
              <div class="phone">
                <strong>{{ trans('theme.support') }}:</strong> <a href="tel:{{ config('system_settings.support_phone') }}" class="text-info">{{ config('system_settings.support_phone') }}</a>
              </div>
              <div class="email">
                {{ trans('theme.email') }}: <a href="mailto:{{ config('system_settings.support_email') }}" class="text-info">
                  {{ config('system_settings.support_email') }}
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- End Customer Care -->

        <div class="header__search ml-md-2 my-1">
          {!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-categories-form', 'class' => 'navbar-left navbar-search mb-1', 'role' => 'search']) !!}
          <div class="search-box">
            <div class="search-box__input">
              {!! Form::text('q', Request::get('q'), ['id' => 'autoSearchInput', 'placeholder' => trans('theme.main_searchbox_placeholder'), 'autocomplete' => 'off', 'data-search']) !!}
            </div>

            <div class="search-box__select d-none d-sm-block">
              <i class="fas fa-caret-down"></i>
              {{-- <i class="fad fa-chevron-down"></i> --}}
              <select class="category search-category-select" name="insubgrp">
                <option value="all">{{ trans('theme.all_categories') }}</option>

                @foreach ($search_category_list as $search_category_grp)
                  <optgroup label="{{ $search_category_grp->name }}">
                    @foreach ($search_category_grp->subGroups as $search_category)
                      <option value="{{ $search_category->slug }}" {{ Request::get('insubgrp') == $search_category->slug ? 'selected' : '' }}>
                        {{ $search_category->name }}
                      </option>
                    @endforeach
                  </optgroup>
                @endforeach
              </select>
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
			<!-- Tanding Keywords under the search box starts -->
       {{-- Trending Keywords --}}
          @if (is_incevio_package_loaded('trendingKeywords'))
            @include('trendingKeywords::_keyword_lists')
          @endif
			<div class="hot-words d-none d-sm-block">
          <a href="https://tiejet.com/search?q=Backlink">
        SEO Backlink
      </a>
	 <a href="https://tiejet.com/search?q=logo  Design">
        Logo  Design
      </a>
          <a href="https://tiejet.com/search?q=Search Engine Optimization">
        Search Engine Optimization
      </a>
          <a href="https://tiejet.com/search?q=Website Design">
        Website Design
      </a>
      </div>
<style>
  .hot-words {
    /* height: 16px; */
    /* overflow: hidden; */
    margin-top: 10px;
  }

  .hot-words a {
    position: relative;
    /* float: left; */
    padding-left: 5px;
    /* line-height: 16px; */
    /* font-size: 12px; */
    color: #666;
  }

  .hot-words a:hover {
    color: #000;
  }

  .hot-words a:not(:first-child):before {
    position: absolute;
    left: 0;
    top: 2px;
    content: "";
    display: inline-block;
    width: 1px;
    height: 10px;
    font-size: 0;
    overflow: hidden;
    background-color: #e9e9e9;
  }

  .hot-words a:first-child {
    padding-left: 0;
  }

</style>
		  <!--test Ends-->
        </div>
<!--Tranding Keyworkds under the Search box Ends -->
        <div class="header__utility ml-md-4">
          <ul>
            <li>
              <a href="{{ route('account', 'account') }}">
                <i class="fal fa-user"></i>
                <!-- <img src="images/big-user.svg" alt=""> -->
              </a>
            </li>

            @if (is_incevio_package_loaded('wishlist'))
              <li>
                <a href="{{ route('account', 'wishlist') }}">
                  <i class="fal fa-heart"></i>
                  <!-- <img src="images/big-heart.svg" alt=""> -->
                  {{-- <span class="badge">2</span> --}}
                </a>
              </li>
            @endif

            <li>
              <a href="{{ route('cart.index') }}">
                <i class="fal fa-shopping-cart"></i>
                <!-- <img src="images/shopping-bag.svg" alt=""> -->
                <span id="globalCartItemCount" class="badge {{ $cart_item_count == 0 ? 'hidden' : '' }}">{{ $cart_item_count }}</span>
              </a>
            </li>
            {{-- <li>
                          <a href="#">
                            <i class="fas fa-wallet"></i>
                            <!-- <img src="images/wal.svg" alt=""> -->
                            <span>$159.00</span>
                          </a>
                        </li> --}}
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- condition added by hassan0942g + taskShopPageUi00942 --}}
@if(request()->route()->getName() != 'show.store')
<div class="header__navigation">
  <div class="container">
    <div class="header__navigation-inner">
      <ul class="menu-dropdown-list header__navigation-category">
        <li>
          <a href="{{ route('categories') }}" class="menu-link" data-menu-link>
            <i class="fas fa-stream" style="margin-right: 10px;"></i>
            {{ trans('theme.categories') }}
            {{-- <i class="far fa-chevron-down"></i> --}}
          </a>

          <ul class="menu-cat" data-menu-toggle>
            @foreach ($all_categories as $catGroup)
              @if ($catGroup->subGroups->count())
                @php
                  $categories_count = $catGroup->subGroups->sum('categories_count');
                  $cat_counter = 0;
                @endphp
                <li>
                  <a href="{{ route('categoryGrp.browse', $catGroup->slug) }}">
                    @if ($catGroup->logoImage && Storage::exists($catGroup->logoImage->path))
                      <img src="{{ get_storage_file_url($catGroup->logoImage->path, 'tiny_thumb') }}" alt="{{ $catGroup->name }}">
                    @else
                      <i class="fal {{ $catGroup->icon ?? 'fa-cube' }}"></i>
                    @endif

                    <span>{{ $catGroup->name }}</span>
                    <i class="fal fa-chevron-right"></i>
                  </a>

                  <div class="mega-dropdown" style="background-image:url({{ $catGroup->backgroundImage ? get_storage_file_url(optional($catGroup->backgroundImage)->path, 'full') : '' }}); background-position: right bottom; background-repeat: no-repeat;margin-right: 0; background-size: contain;">

                    <div class="row">
                      @foreach ($catGroup->subGroups as $subGroup)
                        <div class="col-lg-{{ $categories_count > 15 ? '4' : '6' }}">
                          @php
                            $cat_counter = 0; //Reset the counter
                          @endphp

                          <div class="mega-dropdown__item">
                            <h3>
                              <a href="{{ route('categories.browse', $subGroup->slug) }}">{{ $subGroup->name }}</a>
                            </h3>
                            <ul>
                              @foreach ($subGroup->categories as $cat)
                                <li>
                                  <a href="{{ route('category.browse', $cat->slug) }}">{{ $cat->name }}</a>
								  {{--commented by hassan00942 + taskChangeCatLayout00942  @if ($cat->description)
                                    <p class="text-muted">{!! $cat->description !!}</p>
                                  @endif --}}
                                </li>
                                @php
                                  $cat_counter++; //Increase the counter value by 1
                                @endphp
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </li>
              @endif
            @endforeach
          </ul>
        </li>
      </ul>

      <ul class="header__menu">
    <!--    <li>
          <a class="menu-link" href="{{ route('brands') }}">
            <i class="fal fa-crown menu-icon"></i> {{ trans('theme.brands') }}
          </a>
        </li> -->
		      <li>
          <a class="menu-link" href="https://service.tiejet.com">
            <i class="fal fa-crown menu-icon"></i> Customer Services
          </a>
        </li>
 <!-- Hide Vendors from home nav Start -->
      <!--  <li>
          <a class="menu-link" href="{{ route('shops') }}">
            <i class="fal fa-store menu-icon"></i> {{ trans('theme.vendors') }}
          </a>
        </li>
        -->

        @if (is_incevio_package_loaded('eventy'))
          <li>
            <a class="menu-link" href="{{ route('events') }}">
              <i class="fal fa-calendar-alt menu-icon"></i> {{ trans('theme.events') }}
            </a>
          </li>
        @endif

        @foreach ($pages->where('position', 'main_nav') as $page)
          <li>
            <a href="{{ get_page_url($page->slug) }}" class="menu-link">
              <i class="fal fa-link menu-icon"></i> {{ $page->title }}
            </a>
          </li>
        @endforeach
{{--
       <li>
          <a class="menu-link" href="https://service.tiejet.com">
            <i class="fal fa-seedling menu-icon"></i>
            Franchise
          </a>
        </li> --}}
		   <li>
          <a class="menu-link" href="{{ url('/selling') }}">
            <i class="fal fa-seedling menu-icon"></i>
            {{ trans('theme.nav.sell_on', ['platform' => get_platform_title()]) }}
          </a>
        </li>
       
        {{-- <li class="menu-dropdown-list">
                      <a class="menu-link" href="#">
                        Shop
                        <i class="far fa-chevron-down"></i>
                      </a>
                      <div class="menu-cat shop-menu">
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="menu-cat__item mega-dropdown__item">
                              <h3>
                                <a href="#">Home & Garden</a>
                              </h3>
                              <ul>
                                <li><a href="#">Schoen and Sons <p>Air Jordan 1 Top 3 Sneaker (DS)</p> </a></li>
                                <li><a href="#">Funk, Paucek and Krajcik <p>iPad Pro 2017 Model</p> </a></li>
                                <li><a href="#">Home Entertainment <p>Heimer Miller Sofa (Mint Condition)</p> </a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="menu-cat__item mega-dropdown__item">
                              <h3>
                                <a href="#">Electronics</a>
                              </h3>
                              <ul>
                                <li><a href="#">Corkery Group <p>Brand New Bike, Local buyer only</p> </a></li>
                                <li><a href="#">Corkery Group <p>Coach Tabby 26 for sale</p> </a></li>
                                <li><a href="#">Home Entertainment <p>Playstation 4 Limited Edition (with games)</p> </a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="menu-cat__item mega-dropdown__item">
                              <h3>
                                <a href="#">hobbies & DIY</a>
                              </h3>
                              <ul>
                                <li><a href="#">Schoen and Sons <p>DJI Mavic Pro 2</p> </a></li>
                                <li><a href="#">Funk, Paucek and Krajcik <p>Dell Computer Monitor</p> </a></li>
                                <li><a href="#">Dell Computer Monitor <p>Gopro hero 7 (with receipt)</p> </a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="menu-cat__item mega-dropdown__item">
                              <h3>
                                <a href="#">Pats</a>
                              </h3>
                              <ul>
                                <li><a href="#">Schoen and Sons <p>Macbook Pro 16 inch (2020 ) For Sale</p> </a></li>
                                <li><a href="#">Funk, Paucek and Krajcik <p>Heimer Miller Sofa (Mint Condition)</p> </a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="menu-cat__item mega-dropdown__item">
                              <h3>
                                <a href="#">kids & Toy</a>
                              </h3>
                              <ul>
                                <li><a href="#">Schoen and Sons <p>Gaming Chair, local pickup only</p> </a></li>
                                <li><a href="#">Funk, Paucek and Krajcik <p>Lego Star'War edition</p> </a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="menu-cat__item mega-dropdown__item">
                              <h3>
                                <a href="#">Clothing & Shoes</a>
                              </h3>
                              <ul>
                                <li><a href="#">Schoen and Sons <p>Brand New Bike, Local buyer only</p> </a></li>
                                <li><a href="#">Funk, Paucek and Krajcik <p>Gaming Chair, local pickup only</p> </a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="menu-banner">
                              <a href="#">
                                <img src="{{ theme_asset_url('img/shop-1.png') }}" alt="">
                              </a>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="menu-banner">
                              <a href="#">
                                <img src="{{ theme_asset_url('img/shop-2.png') }}" alt="">
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> --}}

        {{-- <li class="menu-dropdown-list">
                    <a class="menu-link" href="#">
                      Pages
                      <i class="far fa-chevron-down"></i>
                    </a>
                    <ul class="menu-cat">
                      <li>
                        <a href="#">Shopping Cart</a>
                      </li>
                      <li>
                        <a href="#">Checkout</a>
                      </li>
                      <li>
                        <a href="#">Account</a>
                      </li>
                      <li>
                        <a href="#">About Us</a>
                      </li>
                      <li>
                        <a href="#">Blog</a>
                      </li>
                      <li>
                        <a href="#">Wishlist</a>
                      </li>
                    </ul>
                  </li> --}}
      </ul>

	  <div class="shale-text position-relative">
        <div class="zoom-in-out-animate"></div>
        <div class="zoom-in-out-bubble"></div>
        <a style="text-decoration: none" href="{{ $promotional_tagline['action_url'] ?? 'javascript:void(0)' }}">
          <p>{{ !empty($promotional_tagline['text']) ? $promotional_tagline['text'] : '' }}</p>
        </a>
      </div>
    </div>
  </div>
</div>
@else
<div class="header__navigation"></div>
@endif