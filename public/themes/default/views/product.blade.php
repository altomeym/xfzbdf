@extends('theme::layouts.main')


@section('style')
<style>
  #product-detail .pkg-box{width:100%;display: table;padding:10px 0;background-color:#ffff;border-top:1px solid #E1E1E1;border-bottom:1px solid #E1E1E1;}
  #product-detail .pkg-box .nav-link{display: table-cell; width:calc(33.33% - 1px) !important; font-weight:bold; padding:10px; border:1px solid #E1E1E1; background-color:#F9F9F9}
  #product-detail .pkg-box .nav-link.active{color: #FBAC18 !important; border-bottom:2px solid #FBAC18}
  #content-wrapper{background-color: #f1f1f1 !important}
  .nogap > div[class*=col-md]{padding-left:15px; padding-right: 40px}
  .nogap > div[class*=col-md]:first-child{ padding-left: 15px; }
  .nogap > div[class*=col-md]:last-child{ padding-right: 15px; }
</style>
@endsection
@section('content')
  <!-- HEADER SECTION -->
  @include('theme::headers.product_page', ['product' => $item])

  <!-- CONTENT SECTION -->
  @include('theme::contents.product_page')

  {{-- commented by hassan00942 + productPageUI00942 --}}
  {{-- <div class="clearfix space50"></div> --}}

  {{-- commented by hassan00942 + productPageUI00942 --}}
  <!-- RELATED ITEMS -->
  {{-- <section>
    <div class="feature">
      <div class="container">
        <div class="feature__inner">
          <div class="feature__header">
            <div class="sell-header sell-header--bold">
              <div class="sell-header__title">
                <h2>{!! trans('theme.related_items') !!}</h2>
              </div>
              <div class="header-line">
                <span></span>
              </div>
              <div class="header-line">
                <span></span>
              </div>
              <div class="best-deal__arrow">
              </div>
            </div>
          </div>

          <div class="feature__items">
            <div class="feature__items-inner">

              @include('theme::partials._product_horizontal', ['products' => $related])

            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}

  {{-- <div class="clearfix space20"></div> --}}

  {{-- commented by hassan00942 + productPageUI00942 --}}
  <!-- BROWSING ITEMS -->
  {{-- @include('theme::sections.recent_views') --}}

  <!-- MODALS -->
  @include('theme::modals.shopReviews', ['shop' => $item->shop])

  @if (Auth::guard('customer')->check())
    @include('theme::modals.contact_seller')
  @endif

  @include('theme::modals.contact_support', ['item' => $item])
  @include('theme::modals.message_sent_alert_modal')

@endsection


@section('scripts')

  @if(is_incevio_package_loaded('liveChat'))
    @if (is_chat_enabled($item->shop))
      @include('liveChat::livechat', ['shop' => $item->shop, 'agent' => $item->shop->owner, 'agent_status' => trans('theme.online')])
    @endif
  @endif

  @include('theme::modals.ship_to')
  @include('theme::scripts.product_page')
  <script>
    $('.pkg-box .nav-link').on('click', function(){
      $('.pkg-box .nav-link').removeClass('active');
      $(this).addClass('active');

      $(".pkg-content").each(function(i){
        $(i).addClass("d-none");
      });
      id =  $(this).attr('data-toggle');
      $(id).removeClass("d-none").fadeIn(1000);
    })
  </script>
@endsection
