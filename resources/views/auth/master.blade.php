<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? get_site_title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ mix("css/app.css") }}" rel="stylesheet">
    
   
    <!-- added by hassan -->
    <link href="{{ theme_asset_url('css/style.css') }}" media="screen" rel="stylesheet">
	<link href="{{ theme_asset_url('css/cookie_consent.css') }}" media="screen" rel="stylesheet">
    <!-- added by hassan -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .select2-selection__arrow{
        display: none;
      }
      .form-control-feedback{
        width: 46px;
        height: 46px;
        line-height: 46px;
      }
      .select2-container--default .select2-selection--single {
          height: 46px !important;
          padding: 10px 16px;
          font-size: 18px;
          line-height: 1.33;
      }
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          line-height: 31px !important;
      }

    </style>
  </head>
  <body class="hold-transition login-page">
    <!-- header added by hassan -->
    <header>
      <nav class="login-header navbar bg-white">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ get_logo_url('system', 'logo') }}" height="30px" class="mb-2" alt="{{ get_platform_title() }}" title="{{ get_platform_title() }}"> </a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <form action="{{ route('inCategoriesSearch') }}" class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
                    <input type="hidden" name="insubgrp" value="all" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary search-button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form>
            
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ url('categories') }}" class="">Categories</a></li>
              <li><a href="{{ url('brands') }}" class="">Brands</a></li>
              <li><a href="{{ url('selling') }}" class="">Become a Seller</a></li>
              <li><a href="{{ route('login') }}" class="">Sign in</a></li>
              <li><a href="{{ route('register') }}" class="join">Join</a></li>
            </ul>
        </div>
      </nav>
    </header>

    <div class="login-box">
      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>{{ trans('app.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
              <ul class="list-group">
                  @foreach ($errors->all() as $error)
                      <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if (Session::has('message'))
          <div class="alert alert-success">
            {{ Session::get('message') }}
          </div>
      @endif

      <div class="login-logo">
        <!-- commented by hassan -->
        <!-- <a href="{{ url('/') }}">{{ get_site_title() }}</a> -->
        <!-- added by hassan -->
        <img src="{{ get_logo_url('system', 'logo') }}" width="200px" class="brand-logo mb-2" alt="{{ get_platform_title() }}" title="{{ get_platform_title() }}">
      </div>

      @yield('content')

    </div>
    <!-- /.login-box -->

    <!-- added by hassan -->
    @php $pages = \App\Helpers\ListHelper::pages(); @endphp
    <!-- added by hassan -->
    @include('theme::nav.footer')


    <script src="{{ mix("js/app.js") }}"></script>

    <!-- Scripts -->
    @yield('scripts', '')

    <script type="text/javascript">
      // ;(function($, window, document) {
        $("#plans").select2({
          minimumResultsForSearch: -1,
        });
        $("#exp-year").select2({
          placeholder: "{{ trans('app.placeholder.exp_year') }}",
          minimumResultsForSearch: -1,
        });
        $("#exp-month").select2({
          placeholder: "{{ trans('app.placeholder.exp_month') }}",
          minimumResultsForSearch: -1,
        });

        $('.icheck').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
      // });
    </script>

    <div class="loader">
      <center>
        <img class="loading-image" src="{{ asset('images/gears.gif') }}" alt="busy...">
      </center>
    </div>

  </body>
</html>