@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <h2>Категории в меню</h2>
            <ol>
                @foreach ($posts as $key => $page)
                    @if($page->status==1)
                        <li> <h3>{{ HTML::link('admin/content/'.$page->id, $page->name)}}</h3></li>
                    @endif
                @endforeach
            </ol>
        </div>

        <div class="col-xs-12 col-sm-6">
            <h2>Другие категории</h2>
            <ul>
                @foreach ($posts as $key => $page)
                    @if($page->status==0)
                        <li> <h3>{{ HTML::link('admin/content/'.$page->id, $page->name)}}</h3></li>
                    @endif
                @endforeach
            </ul>
            <?php echo HTML::decode(HTML::link('/admin/content/type/add', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить категорию', array('class'=>'addNews'))); ?>

        </div>
    </div>
@stop
