@foreach ($products as $index => $item)
<div class="row mx-1 card new-product-card justify-content-center align-items-center bg-white">
  <div class="col-12 col-sm-12 p-0">
    <a class="product-link" href="{{ route('show.product', $item->slug) }}">
      <div class="row">
        <div class="col-12">
          <a href="{{ route('show.product', $item->slug) }}">
            <div class="recent__items-img box-img">
              <img src="{{ get_inventory_img_src($item, 'medium') }}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}">
            </div>
          </a>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-12 p-0 card-detail">
    <a class="product-link" href="{{ route('show.product', $item->slug) }}">
      <div class="m-2 title">
        {{ $item->title }}
      </div>
    </a>
    @if($ratings == 1)
      @include('theme::layouts.product_list_rating_button', ['ratings' => $item->ratings, 'count' => $item->ratings_count])
    @endif
    @if($pricing == 1)
      <hr class="m-0"/>
      @include('theme::layouts.product_list_price_section', ['item' => $item])          
    @endif
  </div>
</div>
@endforeach