@extends('theme::layouts.main')
@section('content')
{{-- <div class="container">
    <header class="page-header">
        <div class="row">
            <div class="col-md-12">
            <ol class="breadcrumb nav-breadcrumb">
                <li class="d-none d-sm-inline-block"><a href="{{ url('/') }}">{{ trans('theme.nav.home') }}</a></li>
                <li class="active">{{ trans('theme.guides') }}</li>
            </ol>
            </div>
        </div>
    </header>
</div> --}}
<div class="container p-0 c-bg-f5">
    <div class="container">
        <header class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb nav-breadcrumb">
                        <li class="d-none d-sm-inline-block"><a href="{{ url('/') }}">{{ trans('theme.nav.home') }}</a></li>
                        <li class="active">{{ trans('theme.guide_leads') }}</li>
                    </ol>
                </div>
            </div>
        </header>
    </div>    
    <div class="row justify-content-center pb-50px">
        <div class="col-12 col-md-8 text-center">
            <h2 class="px-3 mt-2 mt-md-0 mb-3 text-black">{{ trans('theme.helpful_guides_for_business') }}</h2>
            <p class="px-2 fs-20px">{{ trans('theme.download_our_free_guide_and_lift_your_business') }}</p>
        </div>
    </div>
</div>
<div class="container download-guide">
    <div class="row">
        <div class="col text-center my-4">
            <div class="position-relative">
                <img class="mt-60px featured-image" src="{{ get_storage_file_url(optional($feature_lead->image)->path, '') }}" width="350px" height="300px" />
                @if($feature_lead->offer_text_1 && $feature_lead->offer_text_2 && $feature_lead->offer_text_3)
                    <div class="badge-container">
                        <div class="badge-one-border">
                            <div class="badge-one-content">
                            <span class="d-block fs-14px">{{ $feature_lead->offer_text_1 }}</span>
                            <span class="d-block fw-bold fs-18px py-1 lh-20px">{{ $feature_lead->offer_text_2 }}</span>
                            <span class="d-block fs-14px">{{ $feature_lead->offer_text_3 }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-12 col-md-8 text-center text-md-left my-md-4 pt-md-60px">
            <h3 class="mt-3 d-none d-md-block">{{ $feature_lead->label }}</h3>
            <h2 class="mt-4 fw-bold title">{{ $feature_lead->title }}</h2>
            <div class="mt-4 d-none d-md-block">{!! $feature_lead->description !!}</div>
            <div class="mt-5">
                <a href="{{ route('guide-lead.slug', $feature_lead->slug) }}" class="btn btn-sm-block btn-lg btn-orange text-uppercase">{{ $feature_lead->btn_text }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($leads as $lead)
        <div class="col-12 col-md-3 my-4">
            <div class="col-12 text-center">
                <div class="position-relative" class="position-relative">
                    <a href="{{ route('guide-lead.slug', $lead->slug) }}">
                      <img class="mt-30px" src="{{ get_storage_file_url(optional($lead->image)->path, '') }}" height="300px"/>
                    </a>
                    @if($lead->offer_text_1)
                        <div class="badge-container">
                            <div class="badge-two-border">
                                <div class="badge-two-content">
                                <span class="d-block fw-bold fs-14px py-1 lh-20px">{{ $lead->offer_text_1 }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 text-center">
                <a href="{{ route('guide-lead.slug', $lead->slug) }}">
                  <h2 class="mt-2 fw-bold fs-16px text-black all-guides-title">{{ $lead->title }}</h2>
                </a>
                <div class="mt-3">
                    <a href="{{ route('guide-lead.slug', $lead->slug) }}" class="btn btn-sm-block btn-lg btn-outline-orange text-uppercase">{{ $lead->btn_text }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <hr class="d-none d-md-block" />
    @include('theme::guide-leads.partials.social-counter')
</div>
@endsection
