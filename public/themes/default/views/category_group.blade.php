@extends('theme::layouts.main')

@section('content')
  {{--
  commented by hassan00942 + taskChangeCatLayout00942
  <!-- CATEGORY COVER IMAGE -->
  @include('theme::banners.category_cover', ['category' => $categoryGroup])
  --}}

  <!-- HEADER SECTION -->
  @include('theme::headers.category_group_page', ['category' => $categoryGroup])

  <!-- CONTENT SECTION -->
  @include('theme::contents.category_page', ['category' => $categoryGroup])

  {{--
  commented by hassan00942 + taskChangeCatLayout00942
  <!-- BROWSING ITEMS -->
  @include('theme::sections.recent_views')
  --}}

  <!-- bottom Banner -->
  @include('theme::banners.bottom')

@endsection

@section('scripts')
  @include('theme::scripts.category_page')
@endsection