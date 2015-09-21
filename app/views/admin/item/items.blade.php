@extends('admin.layout')

@section('content')
<div>

    @if(isset($items) )
        <ul class="nav menu">
            @foreach ($items as $key => $post)
                <li class="dropdown  {{ (Request::is('admin/content/'.$post->type_id.'/'.$post->id)) ? 'active' : '' }}" >
                    {{ HTML::link('admin/item/'.$post->id, $post->name) }}
                    
                </li>
            @endforeach
        </ul>
    @endif
    <p><br>
        <?php echo HTML::decode(HTML::link('/admin/item/', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить товар', array('class'=>'addNews'))); ?>
    
    </p>

</div>

 @include('admin.catalog.post-gallery')

@stop
