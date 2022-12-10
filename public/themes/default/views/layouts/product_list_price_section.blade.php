<div class="mx-2 mt-1 clearfix">
    <div class="pull-left mt-1">
        {{-- <a href="">
        <i class="fa fa-bars fa-grey"></i>
        </a> --}}
        <a href="" class="ml-1-">
        {{-- <i class="fa fa-heart fa-grey"></i> --}}
        @if(is_incevio_package_loaded('wishlist'))
            @include('wishlist::_product_list_wishlist_btn_new')
        @endif
        </a>
    </div>
    <div class="pull-right fw-bold m-1 text-gc">
        <span class="fs-10px">@lang('theme.starting_at')</span>
        <span class="fs-14px">
        {!! get_formated_price($item->current_sale_price(), config('system_settings.decimals', 2)) !!}
        </span>                
        @if ($item->hasOffer())
        <span class="old-price fs-10px">{!! get_formated_price($item->sale_price, config('system_settings.decimals', 2)) !!}</span>
        @endif
    </div>
</div>