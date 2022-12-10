{{-- this file has been added by hassan00942 --}}
@php
$item_images = $item->images->count() ? $item->images : $item->product->images;

if (isset($variants)) {
    // Remove images of current items from the variants imgs
    $other_images = $variants
        ->pluck('images')
        ->flatten(1)
        ->filter(function ($value, $key) use ($item) {
            return $value->imageable_id != $item->id;
        });
    $item_images = $item_images->concat($other_images);
}
@endphp
<div class="carousel slide" id="productImagesSlider" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach ($item_images as $index => $img)
            @continue(!$img->path)
            <li data-target="#productImagesSlider" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif"></li>
        @endforeach
        {{-- <li data-target="#productImagesSlider" data-slide-to="1"></li>
        <li data-target="#productImagesSlider" data-slide-to="2"></li> --}}
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach ($item_images as $index => $img)
            @continue(!$img->path)

            @php
                $fImg = get_storage_file_url($img->path, 'full');
            @endphp
            <div class="item @if($index == 0) active @endif">
                <img src="{{ get_storage_file_url($img->path, 'large') }}" alt="{{ $item->title }}" title="{{ $item->title }}">
            </div>
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#productImagesSlider" data-slide="prev">
      <span class="fa fa-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#productImagesSlider" data-slide="next">
      <span class="fa fa-chevron-right shadow"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>