<div class="m-2">
    @if($item->ratings_count > 0)
        <i class="fa fa-star star-rated"></i>
        <span class="star-rated">{{$item->ratings_count}}</span>
        {{-- <span class="text-grey">({{$item->ratings_count}})</span> --}}
    @else
        <i class="fa fa-star text-grey"></i>
        <span class="text-grey">@lang('theme.no_reviews')</span>
    @endif
</div>