<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{!! trans('theme.almost_done_page_title') !!} | {{ config('company.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
    <link href="{{ theme_asset_url('css/style.css') }}" media="screen" rel="stylesheet">
    <link href="{{ theme_asset_url('css/new.css') }}" media="screen" rel="stylesheet">
    <link href="{{ theme_asset_url('css/cookie_consent.css?v1.0.2005') }}" media="screen" rel="stylesheet">
    <style>
        div#g-recaptcha{
            margin: 0 auto;
            width: fit-content;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit" async defer></script>

</head>
        
<body>
    <div class="container-fluid download-guide">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center">
                <div class="h2 fw-bold mt-5 pt-5">{!! trans('theme.almost_done') !!}</div>
                <p class="fs-20px my-4">
                    {!! trans('theme.almost_done_robot_message') !!}
                </p>
                <div id="g-recaptcha" class="text-center"
                    data-sitekey="{{ config('services.recaptcha.key') }}">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ theme_asset_url('js/app.js?v=1.0.004') }}"></script>
    <script type="text/javascript">
        function reCaptchaVerify(response) {
            if (response === document.querySelector('.g-recaptcha-response').value) {
                window.location.replace("{{ route('guide-lead.book-my-consultation') }}");
            }else{
                alert("Please efresh the page.");
            }
        }

        function reCaptchaExpired () {
            alert("Please efresh the page captcha has expired.");
        }

        function reCaptchaCallback () {
            grecaptcha.render('g-recaptcha', {
                'sitekey': "{{ config('services.recaptcha.key') }}",
                'callback': reCaptchaVerify,
                'expired-callback': reCaptchaExpired
            });
        }
    </script>
</body>
</html>