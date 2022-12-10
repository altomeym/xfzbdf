<style>




.nav-link{padding:10px 20px; text-align:center;}
.navbar-nav .nav-link {
}
.add-gig-nav li a{
  color:#000;
  font-size:18px;
}
.add-gig-nav li{
  list-style: none;
}
.add-gig-nav li.active{
  /* width:100%; */
  /* height:51px; */
  border-color: transparent !important;
  border-bottom: .4rem solid #47C61C !important;
  font-weight: bold;
}
.add-gig-nav li:hover{
  /* border: 0px solid black !important; */
}
.add-gig-nav li.active a,
.add-gig-nav li.active a:hover,
.add-gig-nav li.active a:focus,
.add-gig-nav li a:hover,
.add-gig-nav li a:focus{
  color: #000 !important;
  border: 0px solid black;
  background:unset;
  padding-left: 1px;
}
.add-gig-nav .save-adj a,
.add-gig-nav .save-adj a:hover{
  color:#47C61C !important;
}
.add-gig-nav .save-adj a{
  padding-left:1px
}


.my-60px{margin-top:60px;margin-bottom: 60px;}

/* specifi to gig page */
.add-gig-nav{width:100%;/*padding:10px 0;*/background-color:#ffff;border-top:1px solid #E1E1E1;border-bottom:1px solid #E1E1E1;}
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
  <div class="row justify-content-center">
    <div class="col-12">
        <ul class="navbar-nav add-gig-nav clearfix nav-tabs">
          <li class="nav-link active"><a data-toggle="tab" href="#overview">Overview</a></li>
          <li class="nav-link"><a data-toggle="tab" href="#pricing">Pricing</a></li>
          <li class="nav-link"><a data-toggle="tab" href="#description">Description &amp; FAQ</a></li>
          <li class="nav-link"><a data-toggle="tab" href="#requirements">Requirements</a></li>
          <li class="nav-link"><a data-toggle="tab" href="#gallery">Gallery</a></li>
          <li class="pull-right save-adj"><span href="#" class="pull-right mr-5 fw-bold">Save</span></li>
        </ul>
        {{-- <div class="navbar-nav add-gig-nav clearfix nav-tabs">
          <span class="nav-link active">
            <a class="text-black" data-toggle="tab" href="#overview">
              Overview</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#pricing">
            Pricing</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#description">
            Description &amp; FAQ</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#requirements">
            Requirements</a>
          </span>
          <span class="nav-link">
            <a class="text-black" data-toggle="tab" href="#gallery">
            Gallery</a>
          </span>
          <a class="pull-right mr-5 fw-bold">Save</a>
        </div> --}}
    </div>
  </div>

  <div class="tab-content row justify-content-center">
    {{-- Overview --}}
    <div class="col-md-8 tab-pane fade in active" id="overview">
      <div class="bg-white border mt-60px p-5">
        <div class="" id="overview">
          <form action="#" method="post" class="proposal-form-">
            <div class="form-group row mb-5"><!--- form-group row Starts --->
              <div class="col-md-4">
                <span class="fw-bold d-block mb-2">Service Title</span>
                <span>Your title is the most important place to include keywords that buyers would likely use to search.</span>
              </div>
              <div class="col-md-8"><textarea name="proposal_title" rows="3" required="" placeholder="I Will" class="form-control"></textarea></div>
              <small class="form-text text-danger"></small>
            </div><!--- form-group row Ends --->

            <div class="form-group row mb-5"><!--- form-group row Starts --->
              <div class="col-md-4">
                <span class="fw-bold d-block mb-2">Category</span>
                <span>Choose the most suitable category for your service.</span>
              </div>
              <div class="col-md-8">
                <select name="proposal_cat_id" id="category" class="form-control mb-3" required="">
                  <option value="" class="hidden"> Select A Category </option>
                  <option value="1"> Graphics &amp; Design </option>
                  <option value="2"> Digital Marketing </option>
                  <option value="3"> Writing &amp; Translation </option>
                  <option value="4"> Video &amp; Animation
                  </option>
                  <option value="6"> Programming &amp; Tech
                  </option>
                  <option value="7"> Business
                  </option>
                  <option value="8"> Fun &amp; Lifestyle
                  </option>
                  <option value="9"> Music &amp; Audio </option>
                </select>
                <small class="form-text text-danger"></small>
                <select name="proposal_child_id" id="sub-category" class="form-control" required="" style="">Database Connection Error Is: SQLSTATE[42000]: Syntax error or access violation: 1115 Unknown character set: 'UTF'<option value=""> Select A Sub Category </option><option value="10"> Social Media Marketing </option><option value="17"> SEO </option><option value="18"> Web Traffic </option><option value="19"> Content Marketing </option><option value="20"> Video Marketing </option><option value="21"> Email Marketing </option><option value="22"> Search &amp; Display Marketing </option><option value="23"> Marketing Strategy </option><option value="24"> Web Analytics </option><option value="25"> Influencer Marketing </option><option value="26"> Local Listings </option><option value="27"> Domain Research </option><option value="28"> E-Commerce Marketing </option><option value="29"> Mobile Advertising </option></select>
              </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row mb-5"><!--- form-group row Starts --->
              <div class="col-md-4">
                <span class="fw-bold d-block mb-2">Service Type</span>
                <span>You can choose the multiple services.</span>
              </div>
              <div class="col-md-8">
                <select name="proposal_cat_id" id="category" class="form-control mb-3" required="">
                  <option value="" class="hidden"> Select A Category </option>
                  <option value="1"> Graphics &amp; Design </option>
                  <option value="2"> Digital Marketing </option>
                  <option value="3"> Writing &amp; Translation </option>
                  <option value="4"> Video &amp; Animation
                  </option>
                  <option value="6"> Programming &amp; Tech
                  </option>
                  <option value="7"> Business
                  </option>
                  <option value="8"> Fun &amp; Lifestyle
                  </option>
                  <option value="9"> Music &amp; Audio </option>
                </select>
                <small class="form-text text-danger"></small>
              </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row mb-5"><!--- form-group row Starts --->
              <div class="col-md-4">
                <span class="fw-bold d-block mb-2">Search Tags</span>
                <span>Enter the tags that are relevant to your service.</span>
              </div>
              <div class="col-md-8">
                <select name="proposal_cat_id" id="category" class="form-control mb-3" required="">
                  <option value="" class="hidden"> Select A Category </option>
                  <option value="1"> Graphics &amp; Design </option>
                  <option value="2"> Digital Marketing </option>
                  <option value="3"> Writing &amp; Translation </option>
                  <option value="4"> Video &amp; Animation
                  </option>
                  <option value="6"> Programming &amp; Tech
                  </option>
                  <option value="7"> Business
                  </option>
                  <option value="8"> Fun &amp; Lifestyle
                  </option>
                  <option value="9"> Music &amp; Audio </option>
                </select>
                <small class="form-text text-danger"></small>
              </div>
            </div><!--- form-group row Ends --->
          </form><!--- form Ends -->
        </div>
      </div>
      <div class="my-5 clearfix">
        <span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
        <button class="btn btn-gig btn-success pull-right">Save</button>
      </div>
    </div>
    
    {{-- Pricing --}}
    <div class="col-md-8 tab-pane fade" id="pricing">
      <div class="clearfix mt-60px">
        <span class="pull-left fw-bold h2 m-0">Pricing</span>
        <span class="pull-right">Offer pacakges</span>
      </div>
      <div class="my-5 p-5 bg-primary">
        The scope of this feature is to drain more orders. Package prices should include predefined options.
      </div>
      <hr />
      <div class="fw-bold">Packages</div>
      <div class="border">
        <div class="gig-pkg" id="overview">
          <form action="#" method="post" class="proposal-form-">
            <table class="table">
              <thead>
                <tr>
                  <td></td>
                  <td class="bg-light fw-bold p-4">Basic</td>
                  <td class="bg-light fw-bold p-4">Standard</td>
                  <td class="bg-light fw-bold p-4">Premium</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td><textarea style="color:#000" rows="4">Business/ Ecommerce</textarea></td>
                  <td><textarea style="color:#000" rows="4">Standard Website</textarea></td>
                  <td><textarea style="color:#000" rows="4">Highly Professional  Website</textarea></td>
                </tr>
                <tr>
                  <td></td>
                  <td><textarea style="color:#000" rows="8">We will provide a ecommerce website for your online businessWe will provide a ecommerce websitsfrss </textarea></td>
                  <td><textarea style="color:#000" rows="8">We will provide a ecommerce website for your online businessWe will provide a ecommerce websitsfrss </textarea></td>
                  <td><textarea style="color:#000" rows="8">We will provide a ecommerce website for your online businessWe will provide a ecommerce websitsfrss </textarea></td>
                </tr>
                <tr>
                  <td>Functional Website</td>
                  <td class="p-4 text-center">
                    <input type="checkbox" />
                  </td>
                  <td class="p-4 text-center">
                    <input type="checkbox" />
                  </td>
                  <td class="p-4 text-center">
                    <input type="checkbox" />
                  </td>
                </tr>
                <tr>
                  <td>No of Products</td>
                  <td class="">
                    <select class="form-control">
                      <option>1</option>
                    </select>
                  </td>
                  <td class="">
                    <select class="form-control">
                      <option>1</option>
                    </select>
                  </td>
                  <td class="">
                    <select class="form-control">
                      <option>1</option>
                    </select>
                  </td>
                </tr>
                <tr class="price-tr">
                  <td>Price</td>
                  <td class="">
                    <div class="input-group">
                      <input type="number" class="form-control" />
                      <div class="input-group-addon">
                        <span class="input-group-text">$</span>
                      </div>
                    </div>
                  </td>
                  <td class="">
                    <div class="input-group">
                      <input type="number" class="form-control" />
                      <div class="input-group-addon">
                        <span class="input-group-text">$</span>
                      </div>
                    </div>
                  </td>
                  <td class="">
                    <div class="input-group">
                      <input type="number" class="form-control" />
                      <div class="input-group-addon">
                        <span class="input-group-text">$</span>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form><!--- form Ends -->
        </div>
      </div>
      <div class="my-5 clearfix">
        <span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
        <button class="btn btn-gig btn-success pull-right">Save</button>
      </div>
    </div>

    {{-- Description & FAQs --}}
    <div class="col-md-8 tab-pane fade" id="description">
      {{-- Description --}}
      <div class="mt-60px">
        <span class="fw-bold h2 m-0">Description</span>
      </div>
      <div class="">
        Briefly Describe Your Service
      </div>
      <hr />
      <div class="border">
        <div class="gig-pkg" id="overview">
          <form action="#" method="post" class="proposal-form-">
            <textarea class="form-control summernote" rows="10">Business/ Ecommerce</textarea>
          </form>
        </div>
      </div>

      {{-- FAQs --}}
      <div class="add-gig-faq">
        <div class="mt-60px clearfix">
          <span class="pull-left fw-bold h2 m-0">FAQs</span>
          <span class="pull-right"><i class="fa fa-plus mr-2"></i>Add FAQ</span>
        </div>
        <div class="">
          Add Questions & Answers for Your Buyers.
        </div>
        <hr />
        <div class="panel-group" id="faqAccordion">
          <div class="panel panel-default">
            <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
              <h4 class="panel-title">
                Q: What is Lorem Ipsum?
              </h4>
            </div>
            <div id="question0" class="panel-collapse collapse" style="height: 0px;">
              <div class="panel-body">
                <input type="text" class="form-control mb-4" value="Q: What is Lorem Ipsum?" />
                <textarea class="form-control" rows="5">Lorem Ipsum iscenturies, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</textarea>
              </div>
              <div class="mt-2 mb-3 clearfix mx-4">
                <div class="pull-left pt-2">
                  <i class="fa fa-times-circle mr-2"></i> Delete
                </div>
                <div class="pull-right">
                  <span href="" class="btn btn-lg btn-outline-secondary">Cancel</span>
                  <button class="btn btn-lg btn-success">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="my-5 clearfix">
        <span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
        <button class="btn btn-gig btn-success pull-right">Save</button>
      </div>
    </div>

    {{-- Requirements --}}
    <div class="col-md-8 tab-pane fade" id="requirements">
      <div class="bg-white border mt-60px p-5 add-gig-requirement">
        <div class="h4 fw-bold">Get all the information you need from buyers to get started</div>
        <p>Add questions to help buyers provide you with exactly what you need to start working on their order.</p>

        <div class="text-center my-5 fw-bold h3">Your Questions</div>
        <div>
          <div class="panel-group" id="qaAccordion">
            <div class="panel panel-default">
              <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#qaAccordion" data-target="#qa0">
                <div class="type-text">Multiple Choice</div>
                <h4 class="panel-title fw-bold">What is Lorem Ipsum?</h4>
              </div>
              <div id="qa0" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                  <input type="text" class="form-control mb-4" value="Q: What is Lorem Ipsum?" />
                  <textarea class="form-control" rows="5">Lorem Ipsum iscenturies, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</textarea>
                </div>
                <div class="mt-2 mb-3 clearfix mx-4">
                  <div class="pull-left pt-2">
                    <i class="fa fa-times-circle mr-2"></i> Delete
                  </div>
                  <div class="pull-right">
                    <span href="" class="btn btn-lg btn-outline-secondary">Cancel</span>
                    <button class="btn btn-lg btn-success">Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-outline-primary"><i class="fa fa-plus mr-2"></i>Add New Question</button>
        </div>
      </div>
      <div class="my-5 clearfix">
        <span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
        <button class="btn btn-gig btn-success pull-right">Save</button>
      </div>
    </div>

    {{-- Gallery --}}
    <div class="col-md-8 tab-pane fade" id="gallery">
      {{-- Description --}}
      <div class="mt-60px">
        <span class="fw-bold h2 m-0">Showcase Your Services In A Gallery</span>
      </div>
      <div class="my-5 p-5 border bg-light">
        To comply with Fiverr’s terms of service, make sure to upload only content you either own or you have the permission or license to use.
      </div>
      <hr />

      <div class="my-4 mb-2">
        <span class="fw-bold h4">Images (up to 3)</span>
      </div>
      <p class="">
        Get noticed by the right buyers with visual examples of your services.
      </p>
      <hr />

      <div class="my-4 mb-2">
        <span class="fw-bold h4">Outsource Link</span>
      </div>
      <p class="">
        Get noticed by the right buyers with visual examples of your services.
      </p>
      <input type="text" class="form-control" />
      <hr />

      <div class="my-4 mb-2">
        <span class="fw-bold h4">Youtube Video Link</span>
      </div>
      <p class="">
        Get noticed by the right buyers with visual examples of your services.
      </p>
      <input type="text" class="form-control" />
      <hr />

      <div class="my-5 clearfix">
        <span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
        <button class="btn btn-gig btn-success pull-right">Save</button>
      </div>
    </div>
  </div>

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
@endif
