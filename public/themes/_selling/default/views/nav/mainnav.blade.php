<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> {{ trans('theme.nav.menu') }} <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="{{ url('/') }}">
                @if( Storage::exists('logo.png') )
                  <img src="{{ img('tiejet_logo.png') }}" class="brand-logo" alt="{{ trans('app.logo') }}" title="Tiejet" />
                @else
                  <img src="https://tiejet.com/tiejet/public/themes/_selling/default/assets/img/tiejet_logo.png" class="brand-logo" alt="Tiejet" title="Tiejet" />
                @endif
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    {{-- <a class="page-scroll" href="#services">{{ trans('theme.nav.benefits') }}</a> --}}
                </li>
                <li>
                    <a class="page-scroll" href="#contact">{{ trans('theme.nav.contact_us') }}</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
