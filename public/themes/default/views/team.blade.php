@extends('theme::layouts.main')

@section('content')
  <!-- CONTENT SECTION -->
  <div class="clearfix space20"></div>
  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="team-heading col-12 col-md-8 col-lg-5 text-center">
            <h2 class="text-black">{{ $team->title }}</h2>
            <p class="text-muted my-3 fs-14px">{{ $team->description }}</p>
        </div><!-- /.col-12 -->
      </div><!-- /.row -->
      <div class="row justify-content-center mt-4">
        @foreach($team_members as $team_member)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card shadow-sm mb-4 team-member">
                    <div class="social-icons">
                        @if($team_member->social_links)
                            @foreach($team_member->social_links as $index => $social)
                                @if($social)
                                    <a href="{{ $social }}" class="d-block" target="_blank">
                                        <i class="fab fa-{{$index}}"></i>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="img">
                        <img class="card-img-top profile-img" src="{{ get_storage_file_url(optional($team_member->image)->path, 'image') }}" height="180px" width="100%">
                    </div>
                    <div class="card-body d-flex flex-column py-3 text-center">
                        <h5 class="card-title fs-18px mb-1">{{ $team_member->name }}</h5>
                        <p class="text-muted fs-16px">{{ $team_member->designation }}</p>
						<p class="text-muted fs-14px">{{ $team_member->working_date }}</p>
                    </div>
                </div>
            </div>
        @endforeach
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>
@endsection
