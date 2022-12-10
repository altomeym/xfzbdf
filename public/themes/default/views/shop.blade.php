@extends('theme::layouts.main')

@section('content')
  <!-- SHOP COVER IMAGE -->
  {{-- @include('theme::banners.shop_cover', ['shop' => $shop]) --}}

  <!-- CONTENT SECTION -->
  @if (\Route::currentRouteName() == 'shop.products')
    @include('theme::headers.shop_page')

    @include('theme::contents.shop_products')
  @else
    @include('theme::contents.shop_page')
  @endif

  <!-- BROWSING ITEMS -->
  {{-- @include('theme::sections.recent_views') --}}

  <!-- MODALS -->
  {{-- @include('theme::modals.shopReviews') --}}

@endsection

@section('scripts')
  @if(is_incevio_package_loaded('liveChat'))
    @if (is_chat_enabled($shop))
      @include('liveChat::livechat', ['shop' => $shop, 'agent' => $shop->owner, 'agent_status' => trans('theme.online')])
    @endif
  @endif
  <script src="{{ theme_asset_url('js/eislideshow.js') }}"></script>
  <script>
    var $subCatSlider = $('.sub-cat-slider');
    scrollWidth = $subCatSlider.scrollLeft();
    if(scrollWidth > 0){
      $('.sub-cat-scroll .left').removeClass('d-none');
    }

    $('.sub-cat-scroll .left').click(function() {
      event.preventDefault();
      var $subCatSlider=$('.sub-cat-slider');
      $($subCatSlider).animate({
        scrollLeft: "-=140px"
      }, "slow");
  
      var newScrollLeft = $subCatSlider.scrollLeft(),
      width = $subCatSlider.outerWidth(),
      scrollWidth = $subCatSlider.scrollWidth;
      if (newScrollLeft <= 50) {
        $(this).addClass('d-none')
      }else{
        if($('.sub-cat-scroll .right').hasClass('d-none')){
          $('.sub-cat-scroll .right').removeClass('d-none');
        }
      }
    });

    $('.sub-cat-scroll .right').click(function() {
      // alert(1);
      event.preventDefault();
      var $subCatSlider=$('.sub-cat-slider');
      $($subCatSlider).animate({
        scrollLeft: "+=140px"
      }, "slow");
  
      var newScrollLeft = $subCatSlider.scrollLeft();
      // console.log(newScrollLeft);
      // console.log("newScrollLeft");
      var width = $subCatSlider.outerWidth();
      // console.log(width);
      // console.log("newScrollLeft");
      var scrollWidth = $subCatSlider.get(0).scrollWidth;
      // console.log(scrollWidth);
      // console.log("newScrollLeft");
      if(scrollWidth - newScrollLeft - parseInt(width) < 50) {
        $(this).addClass('d-none')
      }else{
        if($('.sub-cat-scroll .left').hasClass('d-none')){
          $('.sub-cat-scroll .left').removeClass('d-none');
        }
      }
    });

    // Main slider
    $('#ei-slider').eislideshow({
      animation: 'center',
      autoplay: true,
      slideshow_interval: 5000,
    });
  </script>

  <script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        nav: true,
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        responsive: {
          0: {
            items: 1
          },
          576: {
            items: 2
          },
          992: {
            items: 3
          },
          1000: {
            items: 5
          }
        }
      });
    });
</script>
@endsection
