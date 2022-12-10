<div class="modal fade" id="contactSupportModal" tabindex="-1" role="dialog" aria-labelledby="contactSupportModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
            {!! Form::open(['route' => 'contact_us', 'id' => 'contact_us_form', 'role' => 'form', 'class' => 'ajaxContactSubmit']) !!}
            <div class="row">
              <div class="col-12 col-md-6 nopadding-right">
                <div class="row">
                  <div class="form-group col-md-6 nopadding-right">
                    {!! Form::text('name', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.name'), 'maxlength' => '100', 'required']) !!}
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group col-md-6">
                    {!! Form::email('email', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.email'), 'maxlength' => '100', 'required']) !!}
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                
                <div class="form-group">
                  {!! Form::hidden('subject', $item->title, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'maxlength' => 200, 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
                
                <div class="form-group">
                  {!! Form::textarea('message', null, ['class' => 'form-control input-lg flat message-area', 'placeholder' => trans('theme.placeholder.message'), 'rows' => 5, 'maxlength' => 500, 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-12 col-md-6 d-none d-md-block">
                <ul class="pre-defined-message text-left">
                  <li class="append-message">
                    Hey I have query about the seller timeline. 
                  </li>
                  <li class="append-message">
                    I am facing issue with the seller ({{ $item->shop->name }})
                  </li>
                  <li class="append-message">
                    This seller is not responding.
                  </li>
                </ul>
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