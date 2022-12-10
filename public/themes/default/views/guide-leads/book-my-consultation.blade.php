<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>{!! trans('theme.book_my_consultation') !!} | {{ config('company.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
  <link href="{{ theme_asset_url('css/style.css') }}" media="screen" rel="stylesheet">
  <link href="{{ theme_asset_url('css/new.css') }}" media="screen" rel="stylesheet">
  <link href="{{ theme_asset_url('css/cookie_consent.css?v1.0.2005') }}" media="screen" rel="stylesheet">
</head>
        
<body>
<div class="container-fluid landing-page-consultation">
    <div class="row justify-content-center">
        <div class="col-12 text-center bg-light">
            <div class="h2 fs-14px py-5 fw-bold">
                <a href="{{ route('guide-lead.thank-you') }}">{!! trans('theme.skip_n_get_guide') !!}</a>
            </div>
        </div>
        <div class="col-12 row justify-content-center bg-lightpink" style="padding:80px 0px">
            <div class="col-12 col-md-6 text-center">
                <span class="fs-16px fw-bold ready-to-start">{!! trans('theme.ready_to_start_your_own_business') !!}</span>
                <hr class="landing-consultant-hr" />
                <div class="fw-bold" style="font-size:45px !important; margin:0 0 30px 0">{!! trans('theme.let_us_give_you_a_hand') !!}</div>
                <p class="fw-bold fs-16px">{!! trans('theme.we_can_wait_to_share_experience') !!}</p>
                <button class="btn btn-lg btn-primary mt-5 px-5 py-3" data-toggle="modal" data-target="#contactSupportModal">{!! trans('theme.book_my_consultation') !!}</button>
            </div>
        </div>
    </div>
    <a class="whatsapp-consultation" href="{{ config('company.whatsapp_link') }}" target="_blank">
      <i class="d-block text-center fab fa-3x fa-whatsapp bg-color chat-icon-circle"></i>
    </a>
</div>

{{--
<div class="modal fade consultationCSModal" id="contactSupportModal" tabindex="-1" role="dialog" aria-labelledby="contactSupportModal" aria-hidden="true">
    <div class="modal-dialog modal-lg- modal-dialog-centered-" role="document">
      <div class="modal-content" style="background-image: url('{{ theme_asset_url('img/contact-us-pic.jpg') }}');">
        <div class="modal-header p-3">
        </div>
        <div class="modal-body p-0">
          <div class="form-title mb-0 px-3">
            <div class="mb-2">
              <a href="https://tiejet.com">
                <img src="https://tiejet.com/image/images/7MQZNN0TXTQQRg2HyHebo37XMcWgXrEByz3yTNSx.png?p=logo" class="image-logo" alt="Logo" title="Logo">
              </a>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="text-center p-3">
            {!! Form::open(['route' => 'contact_us_consultation', 'id' => 'contact_us_form', 'role' => 'form', 'class' => 'ajaxContactSubmit']) !!}
              @csrf
              <div class="row">
                <div class="col-12 col-md-6 nopadding-right">
                  <div class="text-left">
                    <h3 class="text-black">How we can help you today?</h3>
                    <p class="pb-3 fs-18px text-black">Are you interested in getting a profitable business?</p>
                  </div>
                  <hr />
                  <div class="form-group w-100">
                    <input class="form-control input-lg flat w-100" placeholder="Your Name" maxlength="100" required name="name" type="text">
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <input class="form-control input-lg flat" placeholder="Please enter your email" maxlength="100" required name="email" type="email">
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <input class="form-control input-lg flat" placeholder="What is your purpose to contact" maxlength="200" required name="subject" type="hidden" value="Professional Logo Design Service">
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <textarea class="form-control input-lg flat message-area" placeholder="Write your message within 500 characters" rows="5" maxlength="500" required name="message" cols="50"></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            {!! Form::close() !!}
          </div>

        </div>
        <div class="modal-footer pt-0 px-3 mt-0 mb-3 -right">
          <div class="float-right">
            <div class="form-group">
              <button type="submit" form="contact_us_form" class='btn btn-primary btn-lg btn-block flat'><i class="fas fa-paper-plane"></i> Send Message</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
--}}
<div class="modal fade" id="contactSupportModal" tabindex="-1" role="dialog" aria-labelledby="contactSupportModal" aria-hidden="true">
  <div class="modal-dialog modal-sm -modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header p-3">
      </div>
      <div class="modal-body p-0">
        <div class="form-title mb-0 px-3">
          <div class="mb-2">
            <a href="{{ url('/') }}">
              <img src="{{ get_logo_url('system', 'logo') }}" class="image-logo" alt="{{ trans('theme.logo') }}" title="{{ trans('theme.logo') }}">
            </a>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div>
            <h3 class="text-black">{{ trans('messages.how_we_can_help_you_today') }}</h3>
          </div>
        </div>
        <hr />
        <div class="d-flex flex-column text-center p-3">
          {!! Form::open(['route' => 'contact_us_consultation', 'id' => 'contact_us_form', 'role' => 'form', 'class' => 'ajaxContactSubmit']) !!}
          <div class="row">
            <div class="col-12 col-md-6- -nopadding-right">
              <div class="row">
                <div class="form-group col-md-12">
                  {!! Form::text('name', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.name'), 'maxlength' => '100', 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
                
                <div class="form-group col-md-12">
                  {!! Form::email('email', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.email'), 'maxlength' => '100', 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              
              <div class="form-group">
                {!! Form::hidden('subject', trans('theme.book_my_consultation'), ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'maxlength' => 200, 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
              
              <div class="form-group">
                {!! Form::textarea('message', null, ['class' => 'form-control input-lg flat message-area', 'placeholder' => trans('theme.placeholder.message'), 'rows' => 5, 'maxlength' => 500, 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <div class="form-group">
            @if (config('services.recaptcha.key'))
              <div class="g-recaptcha" data-sitekey="{!! config('services.recaptcha.key') !!}"></div>
            @endif
            <div class="help-block with-errors"></div>
          </div>
          {!! Form::close() !!}
        </div>

      </div>

      <div class="modal-footer pt-0 px-3 mt-0 mb-3 -right">
        <div class="float-right">
          <div class="form-group">
            <button type="submit" form="contact_us_form" class='btn btn-primary btn-lg btn-block flat'><i class="fas fa-paper-plane"></i> {{ trans('theme.button.send_message') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ theme_asset_url('js/app.js?v=1.0.004') }}"></script>
<script src="{{ theme_asset_url('js/cookie_consent.js?v=1.0.004') }}"></script>

</body>
</html>