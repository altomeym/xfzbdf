<!DOCTYPE html>
<html>

<head>
  <title>{{ trans('messages.permission.denied') }}</title>

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
      font-size: 72px;
      margin-bottom: 40px;
    }

    a {
      /* text-decoration: none; commented by hassan */
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
      <div class="title">{{ trans('messages.permission.denied') }}</div>
      <a href="{{ route('admin.admin.dashboard') }}" class="btn btn-default">::Back to dashboard::</a>
    </div>
  </div>
</body>

</html>
