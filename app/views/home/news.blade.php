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

    <div class="row">

    <?// var_dump($posts); ?>



        @if(isset($posts)&&count($posts)>0)
            <div class="col-xs-12 col-sm-3">

                <ul class="menu-page nav nav-pills nav-stacked ">
                    @foreach($posts as $post)
                        <li {{ (Request::is( $type->type.'/'.$post->slug)) || (!empty($row)&&$row->parent==$post->id)? 'class="active"' : '' }} >
                        {{ HTML::link('/'.$type->type.'/'.$post->slug, $post->name) }}
                            
                            @if(isset($posts_child)&&count($posts_child)>0)
                                <ul>
                                    @foreach($posts_child as $post_ch)
                                        @if(($post_ch->parent == $post->id) )
                                            <li {{ (Request::is( $type->type.'/'.$post_ch->slug)) ? 'class="active"' : '' }}>
                                                {{ HTML::link('/'.$type->type.'/'.$post_ch->slug, $post_ch->name) }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>



            </div>
        @endif

        <div class="col-xs-12 col-sm-9">

            @if(!empty($row->text))
                {{ $row->text }}
            @endif

            @if(empty($row))
                {{ $type->text }}
            @endif
            
            @if(isset($subcategory)&&count($subcategory)>0)
                @foreach($subcategory as $post)


                    <?php $parts = preg_split('/<div style="page-break-after: always"><span style="display:none">&nbsp;<\/span><\/div>/', $post->text); ?>

                    <div class="block-post row block-news">

                        <div class="col-xs-9 ">
                            <p>{{$post->name}}</p>
                            @if(!empty($post->preview_img))
                                {{ HTML::image($post->preview_img, '') }}
                            @endif

                            {{$post->preview}}
                            <?php //var_dump('<pre>',$post) ?>
                            <br>
                            <p>{{ HTML::link($type->type.'/'.$post->slug, 'подробнее >>') }}</p>

                        </div>
                        <div class="col-xs-3 ">
                            <p class="data-post">{{ date( 'd.m.Y', strtotime($post->created_at)); }}</p>
                            @if(count($parts)>1)
                                <p><a href="#" class="img-circle circle" onclick="diplay_hide('#parts-{{$post->id}}', this);return false;"><i class="glyphicon glyphicon-menu-down"></i></a></p>
                            @endif
                        </div>

                    </div>
                    <hr>
                @endforeach

                {{ $subcategory->links() }}

            @endif
        </div>



    </div>

    </div>

@stop


@section('scripts')

@stop
