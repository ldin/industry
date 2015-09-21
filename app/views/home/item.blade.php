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

    <h1>{{$row->name}}</h1>

    <div class="row item-list">

        <div class="col-xs-12 col-sm-3">
            <div class="box">
                <div class="row main-image">                
                    @if(!empty($row->productImage[0]))
                        {{ HTML::image($row->productImage[0]->small_image, $row->productImage[0]->alt) }}
                    @else
                        {{ HTML::image('/img/wtf_item.jpg','') }}
                    @endif    
                </div>
                @if(!empty($row->productImage[0]) && count($row->productImage)>1)
                    <div class="row galery">    
                        <ul>
                            @foreach($row->productImage as $image)
                                <li>{{ HTML::image($image->small_image, $image->alt) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row description">
                    <div class="text-center">Связаться с нами</div>
                    <p><strong>Tel: </strong>
                        <a href="callto:+00 00000 000000" style="color: #00325d; text-decoration: none;">+00 00000 000000</a>
                    </p>
                    <p><strong>Fax:</strong> +00(0)0000 000000</p>
                    <p><strong>Email:</strong>
                        <a href="mailto:sales@mail.ru">Click here</a>
                    </p>
                    <p><strong>Chat with us:</strong>
                        <a href="/">Click here</a>
                    </p>
                    <p><strong>Skype:</strong>
                        <a href="callto:sales@m">Click here</a>
                    </p>
                </div>

            </div>
        </div>

        <div class="col-xs-12 col-sm-9">
            <div class="box">
                <div class="panel-heading">
                    <h2 class="panel-title">Подробное описание</h2>
                </div>
                <div class="panel-body">
                    <h3>Описание</h3>

                    {{ $row->description }}

                    <h3>Характеристики</h3>
                        @if(!empty($row->productAttribute[0]) )

                            <ul>
                                @foreach($row->productAttribute as $attr)                                
                                    <li>
                                        @if(!empty($attributes[$attr->attribute_id]))
                                            
                                                {{$attributes[$attr->attribute_id]}}:
                                                {{$attr->value}}
                                            
                                        @endif    
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    <!-- <h3>Размеры</h3> -->
                    <h3>Страна</h3>
                </div>
            </div>                
        </div>



</div>

@stop


@section('scripts')

@stop
