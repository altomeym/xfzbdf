@extends('theme::layouts.main')
@section('content')
@php
    $hsl_1 = str_replace(')',',70%)',$lead->bg_color);
    $hsl_2 = str_replace(')',',100%)',$lead->bg_color);
@endphp
<div class="container download-guide p-0">
    <div style="background-color: {{ $hsl_1 }}; color:{{ $lead->color }};">
        <div class="px-3">
            <header class="page-header-color">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb nav-breadcrumb" style="color: {{ $lead->color }}">
                            <li class="d-none d-sm-inline-block"><a href="{{ url('/') }}" style="color: {{ $lead->color }}">{{ trans('theme.nav.home') }}</a></li>
                            <li class=""><a href="{{ route('guide-leads') }}" style="color: {{ $lead->color }}">{{ trans('theme.guide_leads') }}</a></li>
                            <li class="active" style="color: {{ $lead->color }}">{{ $lead->title }}</li>
                        </ol>
                    </div>
                </div>
            </header>
        </div>
        <div class="container">
            <div class="row">
                <div class="col text-center mt-4 d-none d-md-block">
                    <div class="position-relative">
                        <img class="download-guide-detail-image" src="{{ get_storage_file_url(optional($lead->image)->path, '') }}" width="350px" height="400px" />
                        @if($lead->offer_text_1 && $lead->offer_text_2 && $lead->offer_text_3)
                            <div class="badge-container">
                                <div class="badge-one-border">
                                    <div class="badge-one-content">
                                    <span class="d-block fs-14px">{{ $lead->offer_text_1 }}</span>
                                    <span class="d-block fw-bold fs-18px py-1 lh-20px">{{ $lead->offer_text_2 }}</span>
                                    <span class="d-block fs-14px">{{ $lead->offer_text_3 }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-8 text-center text-md-left mt-4">
                    <div class="mt-3">
                        <span class="rounded fs-16px fw-bold p-2" style="background-color: {{ $hsl_2 }} ">{{ $lead->label }}</span>
                    </div>

                    <div class="mt-4 fw-bold title">{{ $lead->title }}</div>
                    
                    <div class="mt-3">
                        <span class="fs-20px fw-bold" style="opacity:.4">
                            @if($lead->type == 'pdf')
                                <i class="far fa-file mr-2"></i> {!! trans('theme.pages', ['number' => $lead->pages]) !!}
                            @else
                                <i class="fab fa-youtube mr-2"></i> {!! trans('theme.minutes', ['number' => $lead->pages]) !!}
                            @endif
                        </span>
                    </div>
                    
                    <div class="mt-1 d-none d-md-block">{!! $lead->description !!}</div>
                    
                    <div class="mt-sm-20px mt-md-3 where-we-send-pdf">
                        @if($lead->type == 'pdf')
                            {!! trans('theme.where_should_we_send_the_ebook') !!}
                        @else
                            {!! trans('theme.where_should_we_send_the_guide') !!}
                        @endif
                    </div>
                    
                    <form class="form-inline mt-3 row" method="POST" action="{{ route('guide-lead.captcha-verify') }}">
                        @csrf
                        <input type="hidden" name="guide_id" value="{{ $lead->id }}" />
                        <div class="col-12 col-md-6 pr-md-0 mb-2">
                            <input type="email" name="email" class="form-control rounded-none py-4" style="width:100% !important" placeholder="Enter email" id="email" required>
                        </div>
                        <div class="col-12 col-md-4 w-100 mb-2">
                            <button type="submit" class="btn py-2 btn-block w-100 btn-orange rounded-none fs-22px">{!! $lead->btn_text !!}</button>
                        </div>
                    </form>
                    
                    <div class="mt-0">
                        {!! trans('theme.by_signing_up_tutorials', ['web_name' => config('company.name')]) !!}
                    </div>

                    <div class="mt-3 mb-3 font-italic">
                        @if($lead->type == 'pdf')
                            {{ trans('theme.available_in_pdf') }}
                        @else
                            {{ trans('theme.video_guide') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-60px" />
    @include('theme::guide-leads.partials.social-counter')
</div>
@endsection