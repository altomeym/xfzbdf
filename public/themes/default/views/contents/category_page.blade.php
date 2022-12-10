<section>
  <div class="container full-width mb-4">
    <div class="row">
      <div class="col-12 h2 fw-bold mb-1">{{ $category->name }}</div>
      <div class="col-12 mt-0 mb-1 cat-desc">
        <p class="@if($category->description != null) px-2 @endif mb-0">{{ strip_tags($category->description) }} <a href="#" data-toggle="modal" data-target="#videoModal"><i class="fa fa-play ml-2 mr-1"></i>@lang('theme.how_work', ['site_name' => config('company.name')])<a></p>
      </div>
    </div>
    <div style="transform: translateX(0); ;">
      @include('theme::partials._categories_filter_slider')
    </div>
    <div class="row mb-1">
      <div class="col-12">
        <ul class="">
          <li class="dropdown dropdown-large drop-down-cat">
            <a href="#" class="dropdown-toggle cat-filter-dropdown @if(Request::has('min_price') || Request::has('max_price')) active @endif" data-toggle="dropdown">
              @lang('theme.budgets') <span class="mr-2"></span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dm-size-2-5 border">
              <form class="">
                @foreach(request()->except(['min_price','max_price']) as $index => $req)
                  <input type="hidden" name="{{ $index }}" value="{{ $req }}" />
                @endforeach
                <div class="row px-3 py-1">
                  <div class="col-6 nopadding-right">
                    <div class="form-group">
                      <label>@lang('theme.min')</label>
                      <input type="text" class="form-control" name="min_price" value="{{ request()->min_price }}" placeholder="@lang('theme.any')" autocomplete="off">
                   </div>
                  </div>
                  <div class="col-6 nopadding-left">
                    <div class="form-group">
                      <label>@lang('theme.max')</label>
                      <input type="text" class="form-control" name="max_price" value="{{ request()->max_price }}" placeholder="@lang('theme.any')" autocomplete="off">
                    </div>
                  </div>
                  {{-- <hr /> --}}
                  <div class="col-12 mt-3">
                    <div class="clearfix">
                      <button type="submit" class="btn btn-primary pull-right">Apply</button>
                    </div>
                  </div>
                </div>
              </form>
            </ul>
          </li>
          <li class="dropdown dropdown-large drop-down-cat">
            <a href="#" class="dropdown-toggle cat-filter-dropdown @if(Request::has('free_shipping') || Request::has('has_offers') || Request::has('new_arrivals')) active @endif" data-toggle="dropdown">
              @lang('theme.delivery_options') <span class="mr-2"></span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dm-size-3- border">
              <div class="">
                <div class="row px-3 py-1">
                  <div class="col-12">
                    <div class="checkbox d-block">
                      <label>
                        <input name="free_shipping" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('free_shipping') ? 'checked' : '' }}> @lang('theme.free_shipping') <span class="small">({{ $products->where('free_shipping', 1)->count() }})</span>
                      </label>
                    </div>
                    <div class="checkbox d-block">
                      <label>
                        <input name="has_offers" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('has_offers') ? 'checked' : '' }} />
                        @lang('theme.has_offers')
                        <span class="small">({{ $products->where('offer_price', '>', 0)->where('offer_start', '<', \Carbon\Carbon::now())->where('offer_end', '>', \Carbon\Carbon::now())->count() }})</span>
                      </label>
                    </div>
                    <div class="checkbox d-block">
                      <label>
                        <input name="new_arrivals" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('new_arrivals') ? 'checked' : '' }} />
                        @lang('theme.new_arrivals')
                        <span class="small">
                          ({{ $products->where('created_at', '>', \Carbon\Carbon::now()->subDays(config('system.filter.new_arraival', 7)))->count() }})
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </ul>
          </li>
        </ul>
      </div>
      @if(count(request()->all()) > 0)
        <div class="col-12 px-3">
          <a href="{{ strtok($_SERVER["REQUEST_URI"], '?') }}">Clear filter</a>
        </div>
      @endif
    </div>

    <div class="row" style="overflow: visible !important;">
      <div class="col-12 clearfix fs-14px">
        <div class="pull-left fw-bold">{{ number_format($products->count()) }} services available</div>
        <div class="pull-right">
          <span>
            <ul class="">
              <li class="dropdown dropdown-large drop-down-cat">
                <a href="#" class="dropdown-toggle cat-filter-dropdown @if(Request::has('sort_by')) active @endif" data-toggle="dropdown">
                  @lang('theme.sort_by') <span class="mr-2"></span> <b class="caret"></b>
                </a>
                <div class="dropdown-menu dm-size-2-5 pull-right mr-3 border">
                    <div class="row px-3 py-1">
                      <div class="col-12">
                        @php
                          $url = str_replace('?&', '?','?'.http_build_query(Request::except('sort_by')).'&');
                        @endphp
                        <div><a href="{{ $url }}sort_by=newest" class="{{ Request::get('sort_by') == 'newest' ? 'fw-bold text-gc' : 'text-black' }}">@lang('theme.newest')</a></div>
                        <div><a href="{{ $url }}sort_by=oldest" class="{{ Request::get('sort_by') == 'oldest' ? 'fw-bold text-gc' : 'text-black' }}">@lang('theme.oldest')</a></div>
                        <div><a href="{{ $url }}sort_by=price_acs" class="{{ Request::get('sort_by') == 'price_acs' ? 'fw-bold text-gc' : 'text-black' }}">@lang('theme.price'): @lang('theme.low_to_high')</a></div>
                        <div><a href="{{ $url }}sort_by=price_desc" class="{{ Request::get('sort_by') == 'price_desc' ? 'fw-bold text-gc' : 'text-black' }}">@lang('theme.price'): @lang('theme.high_to_low')</a></div>
                      </div>
                    </div>
                </div>
              </li>
            </ul>
            {{-- @lang('theme.sort_by'):
             <select name="sort_by" class="selectBoxIt" id="filter_opt_sort">
              <option value="best_match">@lang('theme.best_match')</option>
              <option value="newest" {{ Request::get('sort_by') == 'newest' ? 'selected' : '' }}>@lang('theme.newest')</option>
              <option value="oldest" {{ Request::get('sort_by') == 'oldest' ? 'selected' : '' }}>@lang('theme.oldest')</option>
              <option value="price_acs" {{ Request::get('sort_by') == 'price_acs' ? 'selected' : '' }}>@lang('theme.price'): @lang('theme.low_to_high')</option>
              <option value="price_desc" {{ Request::get('sort_by') == 'price_desc' ? 'selected' : '' }}>@lang('theme.price'): @lang('theme.high_to_low')</option>
            </select> --}}
          </span>
        </div>
      </div>
    </div>

    <div class="row px-2">
      @include('theme::contents.product_list', ['colum' => 5])
    </div>

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-center modal-no-slide modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{config('company.how_company_work')}}" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php /*
    <div class="row">
      <div class="col-md-3 bg-light">
        @include('theme::contents.product_list_sidebar_filters')
      </div><!-- /.col-sm-2 -->

      <div class="col-md-9" style="padding-left: 15px;">
        @if ($products->count())

          @include('theme::contents.product_list', ['colum' => 4])

          @if (config('system_settings.show_seo_info_to_frontend'))
            <div class="clearfix space20"></div>
            <span class="lead">{!! $category->meta_title !!}</span>
            <p>{!! $category->meta_description !!}</p>
            <div class="clearfix space20"></div>
          @endif
        @else
          <p class="lead text-center mt-5">
            {{ trans('theme.no_product_found') }}
          </p>
          <div class="my-3 text-center">
            <a href="{{ url('categories') }}" class="btn btn-primary flat">{{ trans('theme.button.shop_from_other_categories') }}</a>
          </div>
        @endif
      </div><!-- /.col-sm-10 -->
    </div><!-- /.row -->
    */ ?>
  </div><!-- /.container -->
</section>