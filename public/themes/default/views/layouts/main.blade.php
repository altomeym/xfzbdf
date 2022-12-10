<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('meta')

  @if (url('/') !== request()->url())
    <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
  @endif

  <!-- Main custom css -->
  {{-- <link href="{{ theme_asset_url('css/style.css') }}" media="screen" rel="stylesheet"> --}}
  <link href="{{ theme_asset_url('css/style.min.css') }}" media="screen" rel="stylesheet">
  <link href="{{ theme_asset_url('css/new.css') }}" media="screen" rel="stylesheet">
  <link href="{{ theme_asset_url('css/cookie_consent.css?v1.0.2019') }}" media="screen" rel="stylesheet">
  {{-- <link href="https://dl.dropbox.com/s/zyu2rzm3r1limec/resposive.css" media="screen" rel="stylesheet"> --}}

  @if (config('active_locales') && config('active_locales')->firstWhere('code', App::getLocale())->rtl)
    <link href="{{ theme_asset_url('css/rtl.css') }}" media="screen" rel="stylesheet">
  @endif
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  {{-- <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> --}}

  @if (get_from_option_table('theme_custom_styling'))
    <style>
      {{ get_from_option_table('theme_custom_styling') }}

    </style>
  @endif
	
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TKJBN3J');</script>
<!-- End Google Tag Manager -->
<!-- Start Schema Markup -->
	<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "Tiejet",
  "url": "https://tiejet.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://tiejet.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<!-- End Schema Markup -->
@yield('style')
</head>

<body class="{{ config('active_locales')->firstWhere('code', App::getLocale())->rtl ? 'rtl' : 'ltr' }}">
  <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKJBN3J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
// this is for test envet
//use Label84\TagManager\Facades\TagManager;
//TagManager::event('Pageview', ['status' => 'failed', 'count' => 0]);
?>
  <!-- Wrapper start -->
  <div class="wrapper">
    <!-- VALIDATION ERRORS -->
    @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ trans('theme.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
        <ul class="list-group">
          @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Global Announcement -->
    @if(is_incevio_package_loaded('announcement'))
      @include('announcement::announcement')
    @endif

      {{-- <div id="global-announcement">
        {!! $global_announcement->parsed_body !!}

        @if ($global_announcement->action_url)
          <span class="indent10">
            <a href="{{ $global_announcement->action_url }}" class="btn btn-sm">
              {{ $global_announcement->action_text }}
            </a>
          </span>
        @endif
      </div> --}}

    <!-- Header start -->
    <header class="header">
      <!-- Primary Menu -->
      @include('theme::nav.main')
      
      <!-- Mobile Menu -->
      @include('theme::nav.mobile')
    </header>

    <div class="close-sidebar">
      <strong><i class="fal fa-times"></i></strong>
    </div>

    <div id="content-wrapper">
      @yield('content')
    </div>
    {{-- @unless(Auth::guard('customer')->check())
            @include('theme::auth.modals')
        @endunless --}}
    <div id="loading">
      <img id="loading-image" src="{{ theme_asset_url('img/loading.gif') }}" alt="busy...">
    </div>
    <!-- Quick View Modal-->
    <div id="quickViewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>

    <!-- my Dynamic Modal-->
    <div id="myDynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>

    {{-- @if (is_incevio_package_loaded('zipcode')) --}}
    {{-- @include('theme::modals.zipcode') --}}
    {{-- @include('zipcode::_modal') --}}
    {{-- @endif --}}

    <!-- footer start -->
    @include('theme::nav.footer')
  </div>
  <!-- Wrapper end -->

  <!-- MODALS -->
  @unless(Auth::guard('customer')->check())
    @include('theme::auth.modals')
  @endunless

  <script src="{{ theme_asset_url('js/app.js?v=1.0.004-beta') }}"></script>
  {{-- <script src="https://dl.dropbox.com/s/nqdfqqp5fper8no/script.js"></script> --}}

  @include('theme::notifications')

  <!-- AppJS -->
  @include('theme::scripts.appjs')
  {{-- added by hassan00942 --}}
  <script src="{{ theme_asset_url('js/cookie_consent.js?v=1.0.004') }}"></script>

  {{-- Search Autocomplete script --}}
  @if (is_incevio_package_loaded('searchAutocomplete'))
    @include('searchAutocomplete::scripts')
  @endif

  {{-- Wishlist script --}}
  @if(is_incevio_package_loaded('wishlist'))
    @include('wishlist::script')
  @endif

  {{-- Coupons script --}}
{{--    @include('coupons::script')--}}

  <!-- Page Scripts -->
  @yield('scripts')
	{{--
	@if(session('login-success'))
	  @php
		$customer = \App\Models\Customer::where('id', Auth::guard('customer')->user()->id)->first();
	  @endphp
	  <script>
		dataLayer = [{
		  'event' => 'Login',
		  'customer_id': "",
		  'name': "{{ $customer->name }}",
		  'dob': "{{ $customer->dob }}",
		  'sex': "{{ $customer->sex }}",
		  'description': "{{ $customer->description }}",
		  'last_visited_at': "{{ $customer->last_visited_at }}",
		  'active': "{{ $customer->active }}",
		  'accepts_marketing': "{{ $customer->accepts_marketing }}",
		  'created_at': "{{ $customer->created_at }}"
		}];
	  </script>
	@elseif(session('register-success'))
	  @php
		session()->forget('register-success');
		$customer = \App\Models\Customer::where('id', Auth::guard('customer')->user()->id)->first();
	  @endphp
	  <script>
	  dataLayer = [{
		'event' => 'Register',
		'customer_id': "{{ $customer->id }}",
		'name': "{{ $customer->name }}",
		'dob': "{{ $customer->dob }}",
		'sex': "{{ $customer->sex }}",
		'description': "{{ $customer->description }}",
		'last_visited_at': "{{ $customer->last_visited_at }}",
		'active': "{{ $customer->active }}",
		'accepts_marketing': "{{ $customer->accepts_marketing }}",
		'created_at': "{{ $customer->created_at }}"
	  }];
	  </script>
	@endif
	--}}
  <script type="text/javascript" src="http://localhost/gigtodo/js/categoriesProposal.js"></script>
</body>

</html>
