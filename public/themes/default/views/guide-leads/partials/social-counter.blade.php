<div class="row social-status">
    <a class="col-2 text-center">
        <img class="text-center" src="{{ theme_asset_url('img/mail.png') }}" alt="" height="50px" width="70px" />
        <span class="counter d-block">{{ number_format(config('company.subscriber.counts')) }}+</span>
        <span class="d-none d-md-block text-center">{!! trans('theme.subscriber') !!}</span>
    </a>
    @if ($social_media_links = get_social_media_links())
        {{-- @php $i = 1; $total_links = sizeof($social_media_links); @endphp --}}
        @foreach ($social_media_links as $social_media => $link)
            @if($social_media != 'google-plus')
                @php
                    $counts = "company.".$social_media.".counts";
                    $name = "theme.".$social_media;
                @endphp
                <a class="col-2 text-center" href="{{ $link }}" target="_blank">
                    <i class="d-block text-center fab fa-3x fa-{{ $social_media }} color"></i>
                    <span class="counter">{{ number_format(config($counts)) }}+</span>
                    <span class="d-none d-md-block text-center">{!! trans($name) !!}</span>
                </a>
            @endif
            {{-- @if($i%3 == 0 && $i != $total_links)
                <hr class="d-md-none mx-sm-2 mx-md-0" />
            @endif
            @php ++$i @endphp --}}
        @endforeach
    @endif
</div>