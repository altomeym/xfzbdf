<section class="mb-4">
  <div class="container">
    <div class="row p-md-3 mx-0" style="background-color:#000">
      <div class="col-lg-6 col-12 px-2">
          <div class="image-banner- ">
              <div class="shell-banner__box- ">
                  <div class="shell-banner__img-">
                      <div class="my-4 fw-bold" style="font-size:31px; color:white">
                        {{ config('company.business_branding.title') }}
                      </div>
                      <div class="my-4 fs-16px" style="color:white">
                          {{ config('company.business_branding.detail') }}
                      </div>
                      @php
                          $point1 = config('company.business_branding.bullets.1');
                          $point2 = config('company.business_branding.bullets.2');
                          $point3 = config('company.business_branding.bullets.3');
                      @endphp
                      <div class="my-2 clearfix" style="font-size:12px; color:white">
                          <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                          <span class="pl-2 fs-14px">{{ $point1 }}</span>
                      </div>
                      <div class="my-2 clearfix" style="font-size:12px; color:white">
                          <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                          <span class="pl-2 fs-14px">{{ $point2 }}</span>
                      </div>
                      <div class="my-2 clearfix" style="font-size:12px; color:white">
                          <i class="pull-left fa fa-2x fa-check-circle" style="color:#E1E1E1"></i>
                          <span class="pl-2 fs-14px">{{ $point3 }}</span>
                      </div>
                  </div>
              </div>                  
          </div>
      </div>
      <div class="col-lg-6 col-12px-2">
          <div class="image-banner pt-md-1">
	<div class="shell-banner__box ">
	  <div class="shell-banner__img">
		  @php
			  $match;
			  $banners = config('company.business_branding.media.url');
		  @endphp
		  @if(preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $banners, $match))
			  <iframe width="200" src="https://www.youtube.com/embed/{{$match[4]}}" class="shop-yt-video">
			  </iframe>
		  @else
			  <img src="{{ $banners }}" alt="{{ config('company.business_branding.media.alt') }}" title="{{ config('company.business_branding.media.title') }}" />
		  @endif
	  </div>

	  <div class="shell-banner__overlay ">
		<div class="single-banner__texts  ">
		  <div class="shell-banner__overlay-title">
			<h3></h3>
		  </div>

		  <div class="shell-banner__overlay-text">
			<p></p>
		  </div>
		</div>
	  </div>
	</div>
</div>
      </div>
    </div>
  </div>
</section>