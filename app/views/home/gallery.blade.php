@extends('home.layout')

@section('title')
    {{ !empty($row->title)? $row->title:(!empty($type->title)? $type->title:('Электромонтаж + свет, звук и все-все-все. Любая электротехника. Проектирование и монтаж.')) }}
@stop

@section('header')
    {{ HTML::style('/css/gallery.css') }}

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <style type="text/css">
    .fancybox-title-outside-wrap{background-color: rgba(0,0,0,0.5); padding: 10px;}
    </style>
@stop

@section('content')

    <div id="content" class="container">

      @if(!empty($row->text))
          {{ $row->text }}
      @endif
    
      <!-- Контейнер с адаптиными блоками -->
      <div class="masonry">
          <!-- Адаптивные блоки с содержанием -->

          @foreach($galleries as $image)
            <div class="item">
              <a class="fancybox" rel="gallery" href="{{ $image->image }}" title="{{ $image->text }}">
                {{ HTML::image($image->small_image, $image->alt) }}
              </a>
              <br>
              {{ $image->text }}
            </div>
          @endforeach

          <!-- Конец адаптивных блоков с содержанием -->
       
      </div>
      <!-- Конец контейнера с адаптивными блоками -->
    </div>

@stop


@section('scripts')

  <!-- Add mousewheel plugin (this is optional) -->
  <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

  <!-- Add fancyBox -->
  <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

  <!-- Optionally add helpers - button, thumbnail and/or media -->
  <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
  <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

  <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
  <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>


  <script type="text/javascript">

    $(document).ready(function() {
      $(".fancybox").fancybox({
          prevEffect  : 'none',
          nextEffect  : 'none',
          helpers : {
            title : {
              type: 'outside'
            },
            thumbs  : {
              width : 50,
              height  : 50
            }
          }
      });
    });

  </script>



@stop
