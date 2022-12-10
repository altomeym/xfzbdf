{{-- modal added by hassan00942 --}}
<div class="modal fade" id="contactSellerModal" tabindex="-1" role="dialog" aria-labelledby="contactSellerModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content p-2-">
      <div class="modal-header p-3">
      </div>
      <div class="modal-body p-0">
        <div class="form-title mb-0 px-3">
          <div>
            <a href="#">
              <img src="{{ get_storage_file_url(optional($item->shop->logoImage)->path, 'thumbnail') }}" class="seller-info-logo- brand-logo" alt="{{ trans('theme.logo') }}" title="{{ trans('theme.logo') }}">
            </a>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="pt-3">
            <h3 class="text-black">{!! trans('messages.message_to') !!} {{ $item->shop->owner->name }}</h3>
          </div>
        </div>
        <hr class="mb-0" />
        <div class="d-flex flex-column pt-3-">
          {!! Form::open(['route' => ['seller.contact', $item->shop->slug], 'class' => 'ajaxContactSubmit']) !!}
          <div class="row">
            <div class="col-12 col-md-6 nopadding-right pt-3">
              {!! Form::hidden('product_id', $item->id) !!}

              {!! Form::hidden('subject', "Inquiry", ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'required']) !!}

              <div class="form-group px-3 pr-md-0">
                {{-- {!! Form::label('message', trans('theme.write_your_message') . '*') !!} --}}
                {!! Form::textarea('message', null, ['class' => 'form-control px-3 message-area', 'rows' => '8', 'placeholder' => trans('theme.placeholder.message_to_seller_2'), 'required']) !!}
                <div class="help-block with-errors px-3"></div>
              </div>

              <div class="form-group px-3">
                @if (config('services.recaptcha.key'))
                  <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                @endif
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-12 col-md-6 d-none d-md-block pt-3">
              <ul class="pr-3 pre-defined-message">
                <li class="append-message">
                  Hey {{ $item->shop->owner->name }}, can you help me with 
                </li>
                <li class="append-message">
                  Can you send me some work samples? 
                </li>
                <li class="append-message">
                  Do you think you can deliver an order by 
                </li>
                <li class="append-message">
                  I’m working with a budget of 
                </li>
              </ul>
            </div>
          </div>

          <div class="px-3">
            <button type="submit" class="btn btn-primary btn-block btn-lg btn-round- mt-3">
              <i class="fas fa-paper-plane"></i>
              {{ trans('theme.button.send_message') }}
            </button>
          </div>
          {!! Form::close() !!}

        </div>
        {{-- commented by hassan00942 --}}
        {{-- <small class="help-block text-muted text-left mt-4">* {{ trans('theme.help.required_fields') }}</small> --}}
      </div>
      <div class="modal-footer p-0 d-flex justify-content-center">
        <div class="signup-section">
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#contactSellerModal -->

<script src='https://www.google.com/recaptcha/api.js'></script>

{{--
  original modal
  <div class="modal fade" id="contactSellerModal" tabindex="-1" role="dialog" aria-labelledby="contactSellerModal" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content p-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>
            <!--i class="fa fa-"></i-->
            {{ trans('theme.button.contact_seller') }}
          </h4>
        </div>

        <div class="d-flex flex-column">
          {!! Form::open(['route' => ['seller.contact', $item->shop->slug], 'data-toggle' => 'validator']) !!}
          {!! Form::hidden('product_id', $item->id) !!}
          <div class="form-group">
            {!! Form::label('subject', trans('theme.subject') . '*') !!}
            {!! Form::text('subject', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('message', trans('theme.write_your_message') . '*') !!}
            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => trans('theme.placeholder.message'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            @if (config('services.recaptcha.key'))
              <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
            @endif
            <div class="help-block with-errors"></div>
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-lg btn-round mt-3">
            <i class="fas fa-paper-plane"></i>
            {{ trans('theme.button.send_message') }}
          </button>
          {!! Form::close() !!}

        </div>
        <small class="help-block text-muted text-left mt-4">* {{ trans('theme.help.required_fields') }}</small>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#contactSellerModal -->

<script src='https://www.google.com/recaptcha/api.js'></script>
--}}