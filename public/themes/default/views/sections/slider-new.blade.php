<section class="mb-3 position-relative container">
  <div id="ei-slider" class="ei-slider p-0">
    <ul class="ei-slider-large">
      @foreach ($sliders as $slider)
        <li>
          <a href="{{ $slider['link'] }}">
            <img src="{{ get_storage_file_url($slider['feature_image']['path'] ?? null, 'full') }}" alt="{{ $slider['title'] ?? 'Slider Image ' . $loop->count }}">
          </a>

          <div class="banner__content-left px-2 px-md-4">
            {{-- <div class="header__search mx-md-2 my-1">
              <div class="mb-3 u-find-perfect">
                {!! trans('app.find_the_perfect_freelance_service_for_your_business', [
                  'freelanceService' => '<span class="d-inline"><br/><span class="freelance-text font-italic">freelancer services</span></span>'
                ]) !!}
              </div>
            </div> --}}
          </div>
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
  <div class="position-absolute freelance-sec p-2 px-md-4">
    <div class="container pl-0">
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
          <div class="search-box" style="">
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
        <div class="col-12">
            <div class="d-none d-sm-block px-2- mt-2 pl-div">
              <strong>{!! trans('app.popular') !!}</strong>
              <a class="popular-links mb-3" href="https://tiejet.com/search?q=Backlink">
                SEO Backlink
              </a>
              <a class="popular-links mb-3" href="https://tiejet.com/search?q=logo Design">
                Logo  Design
              </a>
              <a class="popular-links mb-3" href="https://tiejet.com/search?q=Search Engine Optimization">
                Search Engine Optimization
              </a>
              <a class="popular-links mb-3" href="https://tiejet.com/search?q=Website Design">
                Website Design
              </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
