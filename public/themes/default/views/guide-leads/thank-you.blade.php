@extends('theme::layouts.main')
@section('content')
<div class="bg-grey">
    <div class="container">
        <div class="row py-60px">
            <div class="col-12 col-md-4 text-center">
                <div class="position-relative">
                    <img src="{{ get_storage_file_url(optional($lead->image)->path, '') }}" class="download-guide-detail-image" />
                    {{-- <div class="badge-container">
                        <i class="far fa-5x fa-check-circle text-success"></i>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-md-8 text-center text-md-left mb-md-4">

                <div>
                    <i class="far fa-3x fa-check-circle text-success"></i>
                    <span class="fw-bold h2 title"> {!! trans('theme.thank_you_for_the_interest_for_ebook_title', ['title' => $lead->title]) !!}
                </div>
                
                <div class="mt-60px fs-20px">
                    {!! trans('theme.we_have_sent_the_dwonload_link_to_email') !!}
                </div>
                
                <div class="mt-5">
                    @if($lead->type == 'pdf')
                        <a href="{{ $lead->link }}" class="btn btn-sm-block btn-lg btn-orange text-uppercase">{{ $lead->btn_text }}</a>
                    @else
                        <a href="{{ $lead->link }}" class="btn btn-sm-block btn-lg btn-orange text-uppercase" target="_blank">{{ $lead->btn_text }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center fw-bold mt-60px">
            <h2>{!! trans('theme.ready_to_start_your_own_bussiness') !!}</h2>
            <h2 class="mt-4 mt-md-2">{!! trans('theme.choose_from_our_leads_for_subscribe_only') !!}</h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="row my-5">
        <div class="col-12 col-md-6">
            <div class="card border shadow-sm mb-4 py-5 text-center">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-uppercase mb-2 fw-bold fs-18px">{!! trans('theme.get_a_copy_blooming_services') !!}</h5>
                <p class="text-muted my-3 px-md-5 fs-16px">{!! trans('theme.get_a_copy_blooming_service_desc') !!}</p>
                <div class="text-center">
                  <span class="d-block fs-16px my-2">{!! trans('theme.use_coupon') !!}</span>
                  <div class="my-3">
                    <span class="fs-20px px-3 py-2 fw-bold text-uppercase bg-grey">123ddddd456</span>
                  </div>
                  <span class="d-block fs-16px my-2">{!! trans('theme.for_a_discount', ['value' => '15%']) !!}</span>
                  <button class="btn btn-lg btn-orange mt-4">{!! trans('theme.save_up_to', ['amount' => '15' . config('system_settings.currency.symbol')]) !!}</button>
                </div>
              </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border shadow-sm mb-4 py-5 text-center">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-uppercase mb-2 fw-bold fs-18px">{!! trans('theme.get_a_copy_blooming_services') !!}</h5>
                <p class="text-muted my-3 px-md-5 fs-16px">{!! trans('theme.get_a_copy_blooming_service_desc') !!}</p>
                <div class="text-center">
                  <span class="d-block fs-16px my-2">{!! trans('theme.use_coupon') !!}</span>
                  <div class="my-3">
                    <span class="fs-20px px-3 py-2 fw-bold text-uppercase bg-grey">123ddddd456</span>
                  </div>
                  <span class="d-block fs-16px my-2">{!! trans('theme.for_a_discount', ['value' => '15%']) !!}</span>
                  <button class="btn btn-lg btn-orange mt-4">{!! trans('theme.save_up_to', ['amount' => '15'.config('system_settings.currency.symbol')]) !!}</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center fw-bold mt-30px p-5 border">
            <div class="h2 w-sm-100 w-md-500px mx-auto">{!! trans('theme.join_us_on_social_media_to_see_success_stories') !!}</div>
            @if ($social_media_links = get_social_media_links())
                <div class="footer__content-box-social">
                    <ul class="justify-content-center my-5">
                    @foreach ($social_media_links as $social_media => $link)
                        @if($social_media != 'google-plus')
                            <li class="m-2">
                                <a href="{{ $link }}" target="_blank">
                                    <i class="fab color fa-4x fa-{{ $social_media }}"></i>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    </ul>

                    @if ($trust_badge = get_trust_badge_url())
                    <div class="mt-4 mb-2">
                        <img src="{{ $trust_badge }}" />
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection