<!DOCTYPE html>
<html lang="ru">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/css/styles.css?0009" rel="stylesheet"> -->

<link rel="stylesheet/less" type="text/css" href="/less/style.less">
{{ HTML::script('/js/less.min.js') }}


    @yield('header')

 </head>

<body>

    <header>
        <div class="container top-block js-header-block">

        </div>
        <nav class="navbar navbar-inverse" id="menu">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main-menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse text-center" id="navbar-main-menu">
                <div class="inline-navbar">
                    <ul class="nav navbar-nav">
                        <!-- <li {{ (Request::is('/')) ? 'class="active"' : '' }}><a href="/">Главная <span class="sr-only">(current)</span></a></li> -->

                        @if(!empty($type_page))
                            @foreach($type_page as $page)
                                <li class="dropdown {{ (Request::is($page->type.'*')) ? 'active' : '' }}">                                    
                                    @if($page->template == 'category')
                                        {{HTML::link($page->type, $page->name, array('class'=>'dropdown-toggle js-activated') )}}
                                        <ul class="dropdown-menu">
                                            @foreach($type_child as $child)
                                                @if($child->type_id == $page->id)
                                                    <li>
                                                    {{ HTML::link('/'.$page->type.'/'.$child->slug, $child->name) }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        {{HTML::link($page->type, $page->name, array('class'=>'') )}}
                                    @endif
                                </li>
                            @endforeach
                        @endif

                  </ul>
                </div>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>

    <main>

        @yield('content')

    </main>

    <footer id="footer">
        <div class="container">

        </div>
    </footer>

{{ HTML::script('/js/jquery-1.11.3.min.js') }}
{{ HTML::script('/js/bootstrap.min.js') }}
{{ HTML::script('/js/bootstrap-hover-dropdown.min.js') }}
  <script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
  </script>
{{ HTML::script('/js/main.js') }}
@yield('scripts')


</body>

</html>
