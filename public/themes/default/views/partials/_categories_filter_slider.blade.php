<?php
  function left_right_cat_llider()
  {
    ?>
      <span class="left d-none">
        <span class="svg-qv icon-chevron" aria-hidden="true">
            <svg width="8" height="15" viewBox="0 0 8 15" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.2279 0.690653L7.84662 1.30934C7.99306 1.45578 7.99306 1.69322 7.84662 1.83968L2.19978 7.5L7.84662 13.1603C7.99306 13.3067 7.99306 13.5442 7.84662 13.6907L7.2279 14.3094C7.08147 14.4558 6.84403 14.4558 6.69756 14.3094L0.153374 7.76518C0.00693607 7.61875 0.00693607 7.38131 0.153374 7.23484L6.69756 0.690653C6.84403 0.544184 7.08147 0.544184 7.2279 0.690653Z"></path>
            </svg>
        </span>
      </span>
      <span class="right d-none d-md-block">
        <span class="svg-qv icon-chevron" aria-hidden="true">
          <svg width="8" height="16" viewBox="0 0 8 16" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.772126 1.19065L0.153407 1.80934C0.00696973 1.95578 0.00696973 2.19322 0.153407 2.33969L5.80025 8L0.153407 13.6603C0.00696973 13.8067 0.00696973 14.0442 0.153407 14.1907L0.772126 14.8094C0.918563 14.9558 1.156 14.9558 1.30247 14.8094L7.84666 8.26519C7.99309 8.11875 7.99309 7.88131 7.84666 7.73484L1.30247 1.19065C1.156 1.04419 0.918563 1.04419 0.772126 1.19065Z"></path>
          </svg>
        </span>
      </span>    
    <?php
  }
?>
<div class="row mb-2 sub-cat-scroll position-relative">
    <div class="col-12 px-3 sub-cat-slider d-flex">
        @if (Request::is('search'))
          @if (Request::has('ingrp'))
            @php
              $t_categories = $products
                  ->pluck('product.categories')
                  ->flatten()
                  ->unique();
              $t_categories = $t_categories
                  ->pluck('subGroup.slug')
                  ->flatten()
                  ->unique()
                  ->toArray();
            @endphp
            @if(count($category->subGroups) > 0)
              @php left_right_cat_llider() @endphp
            @endif
            @foreach ($category->subGroups as $slug => $category)
              @if (in_array($category->slug, $t_categories))
                <a href="#" data-name="insubgrp" data-value="{{ $category->slug }}" class="card mr-1 subcat-on-cat link-filter-opt">
                  <div class="card-body">
                    @if ($category->image && Storage::exists($category->image->path))
                      <img src="{{ get_storage_file_url($category->image->path, '') }}" alt="{{ $category->name }}" height="70px" width="70px">
                    @else
                      <i class="fal fa-5x {{ $category->icon ?? 'fa-cube' }}"></i>
                    @endif
                    <span class="d-block mt-2 text-color sub-cat-name">{{ $category->name }}</span>
                  </div>
                </a>
              @endif
              
            @endforeach
          @elseif(Request::has('insubgrp') && Request::get('insubgrp') != 'all')
            @php
              $t_categories = $products
                  ->pluck('product.categories')
                  ->flatten()
                  ->unique();
              $t_categories = $t_categories
                  ->pluck('slug')
                  ->flatten()
                  ->unique()
                  ->toArray();
            @endphp
            @if(count($category->categories) > 0)
              @php left_right_cat_llider() @endphp
            @endif
            @foreach ($category->categories as $category)
              @if (in_array($category->slug, $t_categories))
                <a href="#" data-name="in" data-value="{{ $category->slug }}" class="card mr-1 subcat-on-cat link-filter-opt">
                  <div class="card-body">
                    @if ($category->image && Storage::exists($category->image->path))
                      <img src="{{ get_storage_file_url($category->image->path, '') }}" alt="{{ $category->name }}" height="70px" width="70px">
                    @else
                      <i class="fal fa-5x {{ $category->icon ?? 'fa-cube' }}"></i>
                    @endif
                    <span class="d-block mt-2 text-color sub-cat-name">{{ $category->name }}</span>
                  </div>
                </a>
              @endif
            @endforeach
          @else
            @php
              $t_categories = $products
                  ->pluck('product.categories')
                  ->flatten()
                  ->unique();
              $t_categories = $t_categories
                  ->pluck('subGroup.group')
                  ->flatten()
                  ->unique();
            @endphp
            @if(count($t_categories) > 0)
              @php left_right_cat_llider() @endphp
            @endif
            @foreach ($t_categories as $category)
              <a href="#" data-name="ingrp" data-value="{{ $category->slug }}" class="card mr-1 subcat-on-cat link-filter-opt">
                <div class="card-body">
                  @if ($category->image && Storage::exists($category->image->path))
                    <img src="{{ get_storage_file_url($category->image->path, '') }}" alt="{{ $category->name }}" height="70px" width="70px">
                  @else
                    <i class="fal fa-5x {{ $category->icon ?? 'fa-cube' }}"></i>
                  @endif
                  <span class="d-block mt-2 text-color sub-cat-name">{{ $category->name }}</span>
                </div>
              </a>
            @endforeach
          @endif
        @elseif(Request::is('categorygrp/*'))
          @if(count($categoryGroup->subGroups) > 0)
            @php left_right_cat_llider() @endphp
          @endif
          @foreach ($categoryGroup->subGroups as $slug => $category)
            @if ($category->categories->count())
              <a href="{{ route('categories.browse', $category->slug) }}" class="card mr-1 subcat-on-cat">
                <div class="card-body">
                  @if ($category->image && Storage::exists($category->image->path))
                    <img src="{{ get_storage_file_url($category->image->path, '') }}" alt="{{ $category->name }}" height="70px" width="70px">
                  @else
                    <i class="fal fa-5x {{ $category->icon ?? 'fa-cube' }}"></i>
                  @endif
                  <span class="d-block mt-2 text-color sub-cat-name">{{ $category->name }}</span>
                </div>
              </a>
            @endif
          @endforeach
        @elseif(Request::is('categories/*'))
          @if(count($categorySubGroup->categories) > 0)
            @php left_right_cat_llider() @endphp
          @endif
          @foreach ($categorySubGroup->categories as $slug => $category)
            <a href="{{ route('category.browse', $category->slug) }}" class="card mr-1 subcat-on-cat">
              <div class="card-body">
                @if ($category->image && Storage::exists($category->image->path))
                  <img src="{{ get_storage_file_url($category->image->path, '') }}" alt="{{ $category->name }}" height="70px" width="70px">
                @else
                  <i class="fal fa-5x {{ $category->icon ?? 'fa-cube' }}"></i>
                @endif
                <span class="d-block mt-2 text-color sub-cat-name">{{ $category->name }}</span>
              </div>
            </a>
          @endforeach
        @elseif(Request::is('category/*'))
          {{-- <li>
              <i class="fas fa-angle-left"></i>
              <a href="{{ route('categories.browse', $category->subGroup->slug) }}">
                {{ $category->subGroup->name }}
              </a>
            </h4>
            <h4>{{ $category->name }}</h4>
          </li> --}}
        @else
        @if(count($categories) > 0)
          @php left_right_cat_llider() @endphp
        @endif
          @foreach ($categories as $slug => $category)
            <a href="{{ route('categories.browse', $category->slug) }}" class="card mr-1 subcat-on-cat">
              <div class="card-body">
                <img src="{{ get_storage_file_url($category->image->path, '') }}" height="70px" width="70px" />
                  <span class="d-block mt-2 text-color sub-cat-name">{{ $category->name }}</span>
              </div>
            </a>
          @endforeach
        @endif
    </div>
  </div>