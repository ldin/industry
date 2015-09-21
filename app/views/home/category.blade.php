@extends('home.layout')

@section('title')
    {{ !empty($row->title)? $row->title:(!empty($type->title)? $type->title:'') }}
@stop

@section('content')

    <div id="content" class="container">

    <div class="row breadcrumbs">
        
        <span class="loc page" data-link="/">Главная </span>
        @if(!empty($type->name))
            <span class="loc page" data-link="/{{$type->type}}"> > {{ $type->name }} </span>
        @endif
        @if(!empty($row->parent_title))
            <span class="loc page" data-link="/{{$row->parent_slug}}"> > {{ $row->parent_title }} </span>
        @endif
        @if(!empty($row->name))
            <span class="loc page" data-link="/{{$row->slug}}"> > {{ $row->name }} </span>
        @endif

    </div>

    <div class="row category-block">

        @if(!empty($row))
            <h1 class="text-center">{{ $row->name }}</h1>
        @endif    

        @if(isset($posts)&&count($posts)>0)
            <div class="row">

                <ul class="categorys">
                    @foreach($posts as $post)
                        <li class="category" >
                            {{ HTML::link('/'.$type->type.'/'.$post->slug, $post->name) }}

                        </li>
                    @endforeach
                </ul>



            </div>
        @endif


        @if(isset($items)&&count($items)>0)
            <div class="row">

                <ul class="items">
                    @foreach($items as $item)

                     <?php // var_dump('<pre>', $item->productImage[0]->small_image); die(); ?>

                        <li class="col-xs-6 col-sm-4 col-md-3" >
                            <a href="/{{$type->type.'/'.$row->slug.'/'.$item->slug}}">
                            <div class="item">
                                @if(!empty($item->productImage[0])) 
                                    {{ HTML::image($item->productImage[0]->small_image, $item->productImage[0]->alt) }}
                                @else
                                    {{ HTML::image('/img/wtf_item.jpg','') }}
                                @endif
                                <div class="title">
                                {{ $item->name }}
                                </div>                            
                            </div>
                            </a>
                        </li>
                    @endforeach
                </ul>



            </div>
        @endif

    </div>

    </div>

@stop


@section('scripts')

@stop
