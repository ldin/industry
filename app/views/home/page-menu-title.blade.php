@extends('home.layout')

@section('title')
    {{ !empty($row->title)? $row->title:(!empty($type->title)? $type->title:('Тиера')) }}
@stop

@section('content')

<? //var_dump($row, $type) ?>

    <div id="content" class="container page-menu-title">

        <div class="col-xs-12 col-sm-2">

            @if(isset($posts)&&count($posts)>0)
                <ul class="menu-page">
                    @foreach($posts as $post)
                        <li {{ (Request::is( $type->type.'/'.$post->slug)) ? 'class="active"' : '' }} >{{ HTML::link('/'.$type->type.'/'.$post->slug, $post->name) }}</li>
                    @endforeach
                </ul>
            @endif

        </div>
        <div class="col-xs-12 col-sm-8">
            <p class="page-title">{{ $type->title }}</p>

            @if(!empty($type->text) && empty($row))
                {{ $type->text }}
            @endif

            @if(!empty($row->text))
                {{ $row->text }}
            @endif

            @if(isset($posts_child)&&count($posts_child)>0)
                @foreach($posts_child as $post)
                    <?php $parts = preg_split('/<div style="page-break-after: always"><span style="display:none">&nbsp;<\/span><\/div>/', $post->text); ?>

                    <div class="block-post row ">

                        <div class="col-xs-10 ">
                            <h2>{{$post->name}}</h2>
                            <div id="parts-{{$post->id}}" class="hidden-parts">{{ $post->text }}</div>
                        </div>
                        <div class="col-xs-2 ">
                            <p class="open-icon"><a href="#" class="img-circle circle" onclick="diplay_hide('#parts-{{$post->id}}', this);return false;"><i class="glyphicon glyphicon-menu-down"></i></a></p>
                        </div>


                    </div>
                @endforeach
            @endif

        </div>


    </div>

@stop


@section('scripts')

@stop
