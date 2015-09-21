@extends('admin.layout')

@section('sidebar')
    <h2>Слайды</h2>
    @if(isset($slides_menu) )
        @foreach ($slides_menu as $key => $post)
            <li class="dropdown active" >
                {{ HTML::link('admin/slider/'.$post->id, $post->name) }}
            </li>
        @endforeach
    @endif
    <p>
        <?php echo HTML::decode(HTML::link('/admin/slider/add', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить', array('class'=>'addNews'))); ?>
    </p>

@stop

@section('content')

<div>

<h3>Слайд</h3>
<br>

{{ Form::open(array('url' => 'admin/slider/'.(isset($row['id'])?$row['id']:'') , 'class' => 'form-group', 'files' => true)) }}

    <div class="tab-content">


        <div class="form-group {{ ($errors->first('name')) ? 'has-error' : '' }}">
            {{ Form::label('inputName', 'Название*') }}
            {{ Form::text('name', (isset($row->name)?$row->name:''), array('class'=>'form-control', 'id'=>'inputName')); }}
        </div>

        <div class="form-group ">
            {{ Form::label('inputTitle', 'Фоновое изображение', array('class'=>'control-label')) }}
            {{ Form::file('image') }}
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 info-txt">
                <p>Предварительный просмотр слайда станет возможным после того, как вы сохраните текущие изменения</p>
                <p>Если изображение не добавлено будет отображаться темный фон</p>
            </div>
            <div class="col-xs-12 col-sm-6 slide-preview-img">
                @if((isset($row->image)?$row->image:''))
                    {{ HTML::image($row->image, '') }}
                @endif
            </div>
            {{-- <img src={{(isset($row->image)&&$row->image)?'/'.$row->image:'/img/noimage.png'}}> --}}
        </div>

        <div class="form-group">
            {{ Form::label('inputText', 'Текст на слайде') }}
            {{Form::textarea('text', (isset($row->text)?$row->text:''), array('class' => 'form-control ', 'id'=>'inputText')); }}
        </div>

        <div class="form-group">
            <div class="checkbox">
              <label>
                {{ Form::checkbox('status', '1', (isset($row->status)&&($row->status==true)?array('checked'):'') )  }}
                Показывать на главной <span class="info-txt"> ( иначе доступ только из админки) </span>
              </label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('inputButton', 'Текст на кнопке') }}
            {{ Form::text('button', (isset($row->button)?$row->button:''), array('class'=>'form-control', 'id'=>'inputButton')); }}
        </div>

        <div class="form-group">
            {{ Form::label('inputLink', 'Ссылка') }}
            {{ Form::text('link', (isset($row->link)?$row->link:''), array('class'=>'form-control', 'id'=>'inputButton')); }}
        </div>



        <br />
        {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}
        @if(isset($row['id']))
              {{ HTML::link('/admin/delete/slide/0/'.$row['id'], 'Удалить слайд', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить слайд?')")) }}
        @endif

    </div>
{{ Form::close() }}

<h3 id="preview-slide">Предварительный просмотр слайда:</h3>

    <div id="slider">
        <div class="row block">
            @include('home.slider')
        </div>
    </div>

</div>

<script type="text/javascript" >
    $(document).ready(function() {
        var ckeditorText = CKEDITOR.replace( 'inputText' );
        AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditorText});
    });

</script>

@stop
