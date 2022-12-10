@extends('admin.layouts.master')

@section('content')
  {{-- {!! Form::open(['route' => 'admin.catalog.product.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!} --}}
  {{-- @include('admin.product._form') --}}
  {{-- {!! Form::close() !!} --}}
  <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
  <style>
    /* pricing page */
    /* #pricingtable td{width:150px;} */
  .switch {
    position: relative;
    display: inline-block;
    width: 30px;
    height: 19px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(10px);
    -ms-transform: translateX(10px);
    transform: translateX(10px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

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
    .gig-pkg table tbody td:first-child{min-width: 150px !important;width: 150px !important;}
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

    @include('admin.product.partials.nav')

    <div class="tab-content row justify-content-center">

      @php
        if(isset($product)){
          $total_invenotries = $product->inventories()->count();
          $inventories = $product->inventories()->get();
        }else{
          $total_invenotries = [];
          $inventories = [];
        }
      @endphp

      {{-- Overview --}}
      <div class="col-md-8 tab-pane fade in active" id="overview">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.catalog.product.store'], 'id' => 'overview-form', 'data-toggle' => 'validator-']) !!}
          @include('admin.product.partials.overview')
        {!! Form::close() !!}
      </div>
      
      {{-- Pricing --}}
      <div class="col-md-8 tab-pane fade" id="pricing">
        {!! Form::open(['route' => 'admin.stock.inventory.storeWithVariant', 'files' => true, 'id' => 'pricing-form', 'data-toggle' => 'validator']) !!}
          @include('admin.product.partials.pricing')
        {!! Form::close() !!}
      </div>

      {{-- Description & FAQs --}}
      <div class="col-md-8 tab-pane fade" id="description">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.catalog.product.update_description_faqs'], 'id' => 'description-faqs', 'data-toggle' => 'validator-']) !!}
          @include('admin.product.partials.description-faqs')
        {!! Form::close() !!}
      </div>

      {{-- Requirements --}}
      <div class="col-md-8 tab-pane fade" id="requirements">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.catalog.product.update_requirements'], 'id' => 'requirements-form', 'data-toggle' => 'validator-']) !!}
          @include('admin.product.partials.requirements')
        {!! Form::close() !!}
      </div>
      
      {{-- Gallery --}}
      <div class="col-md-8 tab-pane fade" id="gallery">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.catalog.product.update_gallery'], 'files' => true, 'id' => 'gallery-form', 'data-toggle' => 'validator-']) !!}
          @include('admin.product.partials.gallery')
        {!! Form::close() !!}
      </div>
    </div>

    @include('admin.product.partials.assets.modal')

  @endif
@endsection

@section('page-script')
  @include('plugins.dropzone-upload')
  @include('admin.product.partials.assets.js')
@endsection
