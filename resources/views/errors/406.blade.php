<!DOCTYPE html>
<html>

<head>
  <title>@lang('app.marketplace_down')</title>

  <!-- commented by hassan -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
  
  <!-- 2 linesyadded by hassan -->
  <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
  <link href="{{ theme_asset_url('css/cookie_consent.css') }}" media="screen" rel="stylesheet">

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      /* color: #B0BEC5; commented by hassan */
      display: table;
      font-weight: 100;
      /* font-family: 'Lato', sans-serif; commented by hassan */
      font-family: 'Roboto', sans-serif; /* added by hassan */
    }

    .container {
      text-align: center;
      display: table-cell;
      vertical-align: middle;
    }

    .content {
      text-align: center;
      display: inline-block;
    }

    .title {
      padding: 0 20px;
      font-size: 42px;
      margin-top: 20px;
      margin-bottom: 40px;
    }

    .brand-logo {
      /* max-width: 140px; commented by hassan */
      /* max-height: 50px; commented by hassan */
      max-width: calc(100% - 20px;); /* added by hassan */
    }
    .pull-right{
      float:right !important;
    }
    :after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
    .clearfix:after,.clearfix:before{display:table;content:" ";}
    .clearfix:after{clear:both;}
    .cookie-consent-banner p{
      line-height: 1.4;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="content">
      <a href="{{ url('/') }}">
        <!-- commented by hassan -->
        <!-- <img src="{{ get_logo_url('system', 'full') }}" class="brand-logo" alt="LOGO" title="LOGO" /> -->
        <!-- added by hassan -->
        <img src="{{ get_logo_url('system', 'error_pages_logo') }}" class="brand-logo" alt="LOGO" title="LOGO" />
      </a>
      <div class="title">{{ $exception->getMessage() ?? trans('theme.shop_down') }}</div>
      <a href="{{ url()->previous() }}">@lang('theme.button.go_back')</a>
    </div>
  </div>
</body>

</html>
