@extends('home.layout')

@section('title')
    {{ !empty($row->title)? $row->title:(!empty($type->title)? $type->title:('Тиера')) }}
@stop

@section('content')

    <div id="content" class="container page-text-data">

        <div class="col-xs-12 col-sm-2"></div>
        <div class="col-xs-12 col-sm-8">
            <p class="page-title">{{ $type->title }}</p>

            @if(isset($posts)&&count($posts)>0)
                @foreach($posts as $post)
                    <?php $parts = preg_split('/<div style="page-break-after: always"><span style="display:none">&nbsp;<\/span><\/div>/', $post->text); ?>

                    <div class="block-post row ">

                        <div class="col-xs-9 ">
                            <h2>{{$post->name}}</h2>
                            <div class="short-txt">
                                @if(count($parts)<=1)
                                    {{$post->text}}
                                @else
                                    {{ $parts[0] }}
                                    <div id="parts-{{$post->id}}" class="hidden-parts">{{ $parts[1] }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-3 ">
                            <p class="data-post">{{ date( 'd.m.Y', strtotime($post->created_at)); }}</p>
                            @if(count($parts)>1)
                                <p><a href="#" class="img-circle circle" onclick="diplay_hide('#parts-{{$post->id}}', this);return false;"><i class="glyphicon glyphicon-menu-down"></i></a></p>
                            @endif
                        </div>

                    </div>
                @endforeach
            @endif

        </div>


    </div>

@stop


@section('scripts')

@stop
