<div class="top-block">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 left text-center tiera-logo">
                <a class="navbar-brand" href="/"><img src="/img/tiera_logo.png" alt="tiera"></a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 phone right text-center">
                <p><small>(812)</small>677-77-76</p>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 text-center left">
                <p class="title">Интернет в вашем доме</p>
            </div>
        </div>
    </div>

</div>

<nav class="navbar navbar-default text-center navbar-page">
    <div class="container">
        <div class="navbar-header">
            <!-- <div class="phone text-right"><span>(812)</span>677-77-76</div> -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-page">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#"></a> -->
        </div>
        {{-- <div class="hidden-xs col-sm-2"></div> --}}
        {{-- <div class="col-xs-12 col-sm-8"> --}}
            <div class="collapse navbar-collapse text-center" id="navbar-collapse-page">
                <div class="inline-navbar">
                    <ul class="nav navbar-nav navbar-menu">
                        @if(isset($type_page))
                            @foreach($type_page as$type=>$page)
                                <li {{ (Request::is($type.'*')) ? 'class="active"' : '' }}>{{HTML::link($type, $page)}}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>

            </div> <!-- /.collapse -->
        {{-- </div> --}}
    </div>
</nav>
