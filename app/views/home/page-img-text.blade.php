@extends('home.layout')

@section('title')
    Тиера
@stop

@section('content')

<div id="content" class="container page-img-text">

    <div class="col-xs-12 col-sm-2"></div>
    <div class="col-xs-12 col-sm-8">
        <p class="page-title">{{ $type->title }}</p>

        @if(isset($posts)&&count($posts)>0)
            @foreach($posts as $post)
                <?php $parts = preg_split('/<div style="page-break-after: always"><span style="display:none">&nbsp;<\/span><\/div>/', $post->text); ?>

                <div class="block-post row ">

                    <div class="col-sm-3  col-xs-12 text-right">
                        @if(isset($post->image)&&$post->image)
                            {{HTML::image($post->image, $post->name)}}
                        @endif
                    </div>

                    <div class="col-sm-7 col-xs-12">
                        <h2>{{$post->name}}</h2>
                        @if(count($parts)<=1)
                            {{$post->text}}
                        @else
                            {{ $parts[0] }}
                            <div id="parts-{{$post->id}}" class="hidden-parts">{{ $parts[1] }}</div>
                        @endif

                    </div>
                    <div class="col-sm-2 col-xs-12">
                        @if(count($parts)>1)
                            <p class="open-icon"><a href="#" class="img-circle circle" onclick="diplay_hide('#parts-{{$post->id}}', this);return false;"><i class="glyphicon glyphicon-menu-down"></i></a></p>
                        @endif
                    </div>


                </div>
            @endforeach
        @endif

    </div>


</div>

@stop


@section('scripts')

<script type="text/javascript">
    function diplay_hide (blockId, that){
        if ($(blockId).css('display') == 'none'){
            $(blockId).animate({height: 'show'}, 500);
            $(that).children().removeClass('glyphicon-menu-down').addClass('glyphicon-menu-up')
        }
        else {
            $(blockId).animate({height: 'hide'}, 500);
            $(that).children().removeClass('glyphicon-menu-up').addClass('glyphicon-menu-down')
        }
    }
</script>

@stop
