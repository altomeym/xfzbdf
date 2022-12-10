<style>
.bg-secondary{background-color: #e1e1e1}
.nav-link{padding:10px 20px; text-align:center;}
.navbar-nav .nav-link {
  color:#000;
  font-size:18px;
  border-bottom: unset;
}
.navbar-nav .nav-link.active{
  width:100%;
  /* height:51px; */
  border-bottom: .4rem solid transparent;
  border-bottom-color: #47C61C;
  font-weight: bold;
}

.my-60px{margin-top:60px;margin-bottom: 60px;}

/* specifi to gig page */
.add-gig-nav{width:100%;padding:10px 0;background-color:#ffff;border-top:1px solid #E1E1E1;border-bottom:1px solid #E1E1E1;}
.btn-gig{padding:12px 25px !important; font-size: 14px !important;}
.gig-pkg table tbody td:not(:first-child){background-color: #fff;}
.price-tr td:first-child{background-color: #E1E1E1}
.gig-pkg table tr, .gig-pkg table td{border: 1px solid #E1E1E1;}
.bg-light{background: #F6F6F6}
.add-gig-faq .panel-heading, .add-gig-requirement .panel-heading{background: #fff !important; padding:20px;}
.add-gig-requirement .type-text{color: #a7a1a1; text-transform: uppercase; font-weight: bold;}
/* from bootstrap 4 */
.btn-secondary{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-secondary:hover{color:#fff;background-color:#5a6268;border-color:#545b62}.btn-secondary.focus,.btn-secondary:focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}.btn-secondary.disabled,.btn-secondary:disabled{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-secondary:not(:disabled):not(.disabled).active,.btn-secondary:not(:disabled):not(.disabled):active,.show>.btn-secondary.dropdown-toggle{color:#fff;background-color:#545b62;border-color:#4e555b}.btn-secondary:not(:disabled):not(.disabled).active:focus,.btn-secondary:not(:disabled):not(.disabled):active:focus,.show>.btn-secondary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}
.btn-outline-secondary{color:#6c757d;background-color:transparent;background-image:none;border-color:#6c757d}.btn-outline-secondary:hover{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-outline-secondary.focus,.btn-outline-secondary:focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}.btn-outline-secondary.disabled,.btn-outline-secondary:disabled{color:#6c757d;background-color:transparent}.btn-outline-secondary:not(:disabled):not(.disabled).active,.btn-outline-secondary:not(:disabled):not(.disabled):active,.show>.btn-outline-secondary.dropdown-toggle{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-outline-secondary:not(:disabled):not(.disabled).active:focus,.btn-outline-secondary:not(:disabled):not(.disabled):active:focus,.show>.btn-outline-secondary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}
.btn-outline-primary{color:#007bff;background-color:transparent;background-image:none;border-color:#007bff}.btn-outline-primary:hover{color:#fff;background-color:#007bff;border-color:#007bff}.btn-outline-primary.focus,.btn-outline-primary:focus{box-shadow:0 0 0 .2rem rgba(0,123,255,.5)}.btn-outline-primary.disabled,.btn-outline-primary:disabled{color:#007bff;background-color:transparent}.btn-outline-primary:not(:disabled):not(.disabled).active,.btn-outline-primary:not(:disabled):not(.disabled):active,.show>.btn-outline-primary.dropdown-toggle{color:#fff;background-color:#007bff;border-color:#007bff}.btn-outline-primary:not(:disabled):not(.disabled).active:focus,.btn-outline-primary:not(:disabled):not(.disabled):active:focus,.show>.btn-outline-primary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(0,123,255,.5)}

</style>
@if (config('system_settings.can_use_own_catalog_only'))
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
        {!! trans('messages.vendor_can_use_own_catalog_only_notice') !!}
      </div>
    </div>
  </div>
@else

@push('script')
<script>
  $('.add-gig-nav .nav-link').on('click',function(){
    $('.add-gig-nav .nav-link').removeClass('active');
    $(this).addClass('active');
  });

  $('#catGrps').on('change',function(){
    catId = $(this).val();
    url = `{{ route('admin.ajax.categorySubGroup') }}?id=${catId}`;
    $.ajax({
      url: url,
      type: "GET",
    })
    .done(function(result) {
      html = '<option value="">Select Subcatgory</option>';
      $.each(result, function(key, input) {
        html += `<option value="${input.id}">${input.name}</option>`;
      });
      $("#catSubGrps").html(html);
    })
    .fail(function(xhr) {
      console.log(xhr);
    });
  });

  $('#catSubGrps').on('change',function(){
    catId = $(this).val();
    url = `{{ route('admin.ajax.categories') }}?id=${catId}`;
    $.ajax({
      url: url,
      type: "GET",
    })
    .done(function(result) {
      html = '<option value="">Select Subcatgory</option>';
      $.each(result, function(key, input) {
        html += `<option value="${input.id}">${input.name}</option>`;
      });
      $("#categories").html(html);
    })
    .fail(function(xhr) {
      console.log(xhr);
    });
  });
  
  $('#overview-form, #pricing-form, #description-faqs, #requirements-form, #gallery-form').on('submit',function(e){
    e.preventDefault();
    // var formData = new FormData();

    // $(this).find(":submit").prop("disabled", true);

    // var action = $(this).attr('action');
    // var data = $("#form-ajax-upload").serializeArray();

    // // Reset the key_features fields to avoid duplicate entry
    // formData.delete('key_features[]');

    // $.each(data, function(key, input) {
    //   formData.append(input.name, input.value);
    // });

    // if ($("#uploadBtn").val()) {
    //   var file = $("#uploadBtn")[0].files[0];
    //   formData.append("images[feature]", file);
    // }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      dataType: 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
    })
    .done(function(result) {
      alert('save');
    })
    .fail(function(xhr) {
      console.log(xhr);
    });
    return false;
  });
  
  
  // add a new faq
  $('#add-faqs, #cancel-add-new-faq').on('click',function(){
    // alert('1');
    $('#add-new-faq-field').toggleClass('d-none');
  });

  $('#addNewFaqButon').on('click',function(){
    question = $('#newFaqQuestion').val();
    answer = $('#newFaqAnswer').val();
    time = $.now();
    $('#add-new-faq-field').addClass('d-none');
    html = `<div class="panel-group" id="faqAccordion${time}">
              <div class="panel panel-default">
                <div class="panel-heading accordion-toggle question-toggle collapsed pointer" data-toggle="collapse" data-parent="#faqAccordion${time}" data-target="#faq${time}">
                  <h4 class="panel-title">
                    Q: ${question}
                  </h4>
                </div>
                <div id="faq${time}" class="panel-collapse collapse" style="height: 0px;">
                  <div class="panel-body">
                    <input type="text" class="form-control mb-4" name="faq[${time}][question]" value="${question}" />
                    <textarea class="form-control" name="faq[${time}][answer]" rows="5">${answer}</textarea>
                  </div>
                  <div class="mt-2 mb-3 clearfix mx-4">
                    <div class="pull-left pt-2 deleteFaq pointer">
                      <i class="fa fa-times-circle mr-2"></i> Delete
                    </div>
                    <div class="pull-right">
                      <!--span href="" class="btn btn-lg btn-outline-secondary">Cancel</span-->
                      <!--button type="button" class="btn btn-lg btn-success">Save</button-->
                    </div>
                  </div>
                </div>
              </div>
            </div>`;
    $('#allFaqsShow').append(html);
  });
  
  $('#allFaqsShow').on('click', '.deleteFaq', function(){
    $(this).closest('.panel-group').remove();
  });
  

  // add a new faq
  $('#add-question, #cancel-add-question').on('click',function(){
    // alert('1');
    $('#add-new-question-field').toggleClass('d-none');
  });
  
  $('#addNewQuestionButon').on('click', function(){
    isChecked = $('#addNewQueReq').is(':checked');
    if(isChecked){is_required = 'checked'; }else{is_required = '';}
    question = $('#addNewQueQue').val();
    type = $('#addNewQueType').val();
    typeText = $("#addNewQueType option:selected" ).text();

    time = $.now();
    $('#add-new-question-field').addClass('d-none');
    html = `<div class="panel-group" id="qaAccordion${time}">
            <div class="panel panel-default">
              <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#qaAccordion${time}" data-target="#qa${time}">
                <div class="type-text" id="typeText">${typeText}</div>
                <h4 class="panel-title fw-bold">${question}</h4>
              </div>
              <div id="qa${time}" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="checkbox" name="question[${time}][required]" class="icheckbox_line" ${is_required} />
                      <label>Required</label>
                    </div>
                  </div>
                  <input type="text" class="form-control mb-4" name="question[${time}][question]" value="Q: What is Lorem Ipsum?" />
                  <div class="form-group">
                    <label>{{ trans('app.form.type') }}</label>
                    <select name="question[${time}][type]" class="form-control" id="type">
                      <option value=""></option>
                      <option value="textarea">Free Text</option>
                      <option value="file">Attachement</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="mt-2 mb-3 clearfix mx-4">
                  <div class="pull-left pt-2 deleteQuestion pointer">
                    <i class="fa fa-times-circle mr-2"></i> Delete
                  </div>
                  <div class="pull-right">
                    <span id="cancelQuestion" class="btn btn-lg btn-outline-secondary">Cancel</span>
                    <button type="button" id="saveQuestion" class="btn btn-lg btn-success">Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>`;
    $('#allQuestionsShow').append(html);

    $(`#qaAccordion${time}`).find("#type").val(type);
    // unset form
    $('#addNewQueReq').prop('checked',false);
    $('#addNewQueQue').val('');
    $('#addNewQueType').val('');
  });
  
  $('#allQuestionsShow').on('click', '#saveQuestion', function(){
    typeText = $(this).closest('.panel-group').find("#type option:selected" ).text();
    $(this).closest('.panel-group').find("#typeText").text(typeText);
    $(this).closest('.panel-collapse').removeClass('in');
  });

  $('#allQuestionsShow').on('click', '#cancelQuestion', function(){
    $(this).closest('.panel-collapse').removeClass('in');
  });
  

  $('#allQuestionsShow').on('click', '.deleteQuestion', function(){
    $(this).closest('.panel-group').remove();
  });
  

</script>
@endpush
  <div class="row justify-content-center">
    <div class="col-12 text-center">
        <div class="navbar-nav add-gig-nav clearfix nav-tabs">
          <span class="nav-link active">
            <a class="text-black" data-toggle="tab" href="#overview">Overview</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#pricing">Pricing</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#description">Description &amp; FAQ</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#requirements">Requirements</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#gallery">Gallery</a>
          </span>
          {{-- <a class="pull-right mr-5 fw-bold">Save</a> --}}
        </div>
    </div>
  </div>

  <div class="tab-content row justify-content-center">
    {{-- Overview --}}
    @include('admin.product.partials.overview')
    
    {{-- Pricing --}}
    @include('admin.product.partials.pricing')

    {{-- Description & FAQs --}}
    @include('admin.product.partials.description-faqs')

    {{-- Requirements --}}
    @include('admin.product.partials.requirements')

    {{-- Gallery --}}
    @include('admin.product.partials.gallery')

  </div>

  <?php /*
  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ isset($product) ? trans('app.update_product') : trans('app.add_product') }}</h3>
          <div class="box-tools pull-right">
            @if (!isset($product))
              <a href="javascript:void(0)" data-link="{{ route('admin.catalog.product.upload') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
            @endif
          </div>
        </div> <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-9 nopadding-right">
              <div class="form-group">
                {!! Form::label('name', trans('app.form.name') . '*', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_name') }}"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>

            <div class="col-md-3 nopadding-left">
              <div class="form-group">
                {!! Form::label('active', trans('app.form.status') . '*', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_active') }}"></i>
                {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], !isset($product) ? 1 : null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-4 nopadding-right">
              <div class="form-group">
                {!! Form::label('mpn', trans('app.form.mpn'), ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.mpn') }}"></i>
                {!! Form::text('mpn', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.mpn')]) !!}
              </div>
            </div>
            <div class="col-md-4 nopadding">
              <div class="form-group">
                {!! Form::label('gtin', trans('app.form.gtin'), ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gtin') }}"></i>
                {!! Form::text('gtin', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.gtin')]) !!}
              </div>
            </div>
            <div class="col-md-4 nopadding-left">
              <div class="form-group">
                {!! Form::label('gtin_type', trans('app.form.gtin_type'), ['class' => 'with-help']) !!}
                {!! Form::select('gtin_type', $gtin_types, null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.gtin_type')]) !!}
              </div>
            </div>
          </div>

          {{-- outsourcing link by hassan00942 start --}}
          <div class="form-group">
            {!! Form::label('out_source_link', trans('app.form.out_source'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.out_source') }}"></i>
            {!! Form::text('out_source_link', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.out_source')]) !!}
            <div class="help-block with-errors"></div>
          </div>
          {{-- outsourcing link by hassan00942 end --}}

          {{-- video link by hassan00942 start --}}
          <div class="form-group">
            {!! Form::label('video_link', trans('app.form.video'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.video') }}"></i>
            {!! Form::text('video_link', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.video')]) !!}
            <div class="help-block with-errors"></div>
          </div>
          {{-- video link by hassan00942 end --}}

          <div class="form-group">
            {!! Form::label('description', trans('app.form.description') . '*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_description') }}"></i>
            {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => trans('app.placeholder.description'), 'required']) !!}
            <div class="help-block with-errors">{!! $errors->first('description', ':message') !!}</div>
          </div>

          <div class="form-group">
            {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
            {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
          </div>

          <fieldset>
            <legend>
              {{ trans('app.form.images') }}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_images') }}"></i>
            </legend>
            <div class="form-group">
              <div class="file-loading">
                <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
              </div>
              <span class="small"><i class="fa fa-info-circle"></i> {{ trans('help.multi_img_upload_instruction', ['size' => getAllowedMaxImgSize(),'number' => getMaxNumberOfImgsForInventory()]) }}</span>
            </div>
          </fieldset>

          <p class="help-block">* {{ trans('app.form.required_fields') }}</p>

          <div class="box-tools pull-right">
            {!! Form::submit(isset($product) ? trans('app.form.update') : trans('app.form.save'), ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 nopadding-left">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('app.organization') }}</h3>
        </div> <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            {!! Form::label('category_list[]', trans('app.form.categories') . '*') !!}
            {!! Form::select('category_list[]', $categories, null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple', 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <fieldset>
            <legend>{{ trans('app.catalog_rules') }}</legend>

            <div class="form-group">
              <div class="input-group">
                {{ Form::hidden('requires_shipping', 0) }}
                {!! Form::checkbox('requires_shipping', null, !isset($product) ? 1 : null, ['id' => 'requires_shipping', 'class' => 'icheckbox_line']) !!}
                {!! Form::label('requires_shipping', trans('app.form.requires_shipping')) !!}
                <span class="input-group-addon" id="basic-addon1">
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.requires_shipping') }}"></i>
                </span>
              </div>
            </div>

            {{-- <div class="form-group">
        <div class="input-group">
          {{ Form::hidden('downloadable', 0) }}
          {!! Form::checkbox('downloadable', null, null, ['class' => 'icheckbox_line']) !!}
          {!! Form::label('downloadable', trans('app.form.downloadable')) !!}
          <span class="input-group-addon" id="basic-addon1">
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.downloadable') }}"></i>
          </span>
        </div>
      </div> --}}

            @if (auth()->user()->isFromplatform())
              <div class="row">
                <div class="col-md-6 nopadding-right">
                  <div class="form-group">
                    {!! Form::label('min_price', trans('app.form.catalog_min_price'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.catalog_min_price') }}"></i>
                    <div class="input-group">
                      <span class="input-group-addon">{{ get_currency_symbol() }}</span>
                      {!! Form::number('min_price', null, ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'placeholder' => trans('app.placeholder.catalog_min_price')]) !!}
                    </div>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6 nopadding-left">
                  <div class="form-group">
                    {!! Form::label('max_price', trans('app.form.catalog_max_price'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.catalog_max_price') }}"></i>
                    <div class="input-group">
                      <span class="input-group-addon">{{ get_currency_symbol() }}</span>
                      {!! Form::number('max_price', null, ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'placeholder' => trans('app.placeholder.catalog_max_price')]) !!}
                    </div>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            @endif
          </fieldset>

          <fieldset>
            <legend>
              {{ trans('app.featured_image') }}
              <i class="fa fa-question-circle small" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_featured_image') }}"></i>
            </legend>
            @if (isset($product) && $product->featureImage)
              <img src="{{ get_storage_file_url($product->featureImage->path, 'small') }}" alt="{{ trans('app.featured_image') }}">
              <label>
                <span style="margin-left: 10px;">
                  {!! Form::checkbox('delete_image[feature]', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
                </span>
              </label>
            @endif

            <div class="row">
              <div class="col-md-9 nopadding-right">
                <input id="uploadFile" placeholder="{{ trans('app.featured_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
              </div>
              <div class="col-md-3 nopadding-left">
                <div class="fileUpload btn btn-primary btn-block btn-flat">
                  <span>{{ trans('app.form.upload') }} </span>
                  <input type="file" name="images[feature]" id="uploadBtn" class="upload" />
                </div>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>{{ trans('app.branding') }}</legend>
            <div class="form-group">
              {!! Form::label('origin_country', trans('app.form.origin'), ['class' => 'with-help']) !!}
              {!! Form::select('origin_country', $countries, null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.origin')]) !!}
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              {!! Form::label('brand', trans('app.form.brand'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.brand') }}"></i>
              {!! Form::text('brand', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.brand')]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('model_number', trans('app.form.model_number'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.model_number') }}"></i>
              {!! Form::text('model_number', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.model_number')]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('manufacturer_id', trans('app.form.manufacturer'), ['class' => 'with-help']) !!}
              {!! Form::select('manufacturer_id', $manufacturers, null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.manufacturer')]) !!}
              <div class="help-block with-errors"></div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
  */ ?>
@endif
