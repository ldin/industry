@extends('admin.layout')

@section('sidebar')

    <h3><i class="glyphicon glyphicon-menu-hamburger"></i> Аттрибуты </h3>
    @if(isset($attributes) )
        <ul class="nav menu">
            @foreach ($attributes as $key => $post)
                <li class="dropdown  {{ (Request::is('admin/attribute/'.$post->id)) ? 'active' : '' }}" >
                    {{ HTML::link('admin/attribute/'.$post->id, $post->value) }}                   
                </li>
            @endforeach
        </ul>
    @endif
    <p><br>
        <?php echo HTML::decode(HTML::link('/admin/attribute/add', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить атрибут', array('class'=>'addNews'))); ?>
    </p>

@stop

@section('content')
<div>

<h3><i class="glyphicon glyphicon-list-alt"></i> Редактирование</h3>
<br>

{{ Form::open(array('url' => 'admin/attribute/'.(isset($row['id'])?$row['id']:'') , 'class' => 'form-group', 'files' => true)) }}

    <div class="tab-content">

        <div class="form-group {{ ($errors->first('value')) ? 'has-error' : '' }}">
            {{ Form::label('inputValue', 'Название*', array('class'=>'control-label')) }}
            {{ Form::text('value', (isset($row->value)?$row->value:''), array('class' => 'form-control', 'id'=>'inputValue')); }}
            {{ ($errors->first('value')) ? Form::label('error', 'Некорректное название', array('class'=>'control-label')) : '' }}
        </div>

        <div class="form-group {{ ($errors->first('name')) ? 'has-error' : '' }}">
            {{ Form::label('inputName', 'Название (англ) *') }}
            {{ Form::text('name', (isset($row->name)?$row->name:''), array('class'=>'form-control', 'id'=>'inputName')); }}
            <small><p class="info-txt">Только латинские символы, цифры, дефис.</p></small>
            {{ ($errors->first('name')) ? Form::label('error', 'Некорректное название', array('class'=>'control-label')) : '' }}
        </div>

        <div class="form-group {{ ($errors->first('group')) ? 'has-error' : '' }}">
            {{ Form::label('inputSlug', 'Группа', array('class'=>'control-label')) }}
            {{ Form::text('group', (isset($row->group)?$row->group:''), array('class' => 'form-control', 'id'=>'inputSlug')); }}
            <small><p class="info-txt">Только латинские символы, цифры, дефис.</p></small>
        </div>


        <div class="form-group">
            {{ Form::label('inputText', 'Описание') }}
            {{Form::textarea('description', (isset($row->description)?$row->description:''), array('class' => 'form-control ', 'rows'=>'2')); }}
        </div>

        <br />
        {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-success')) }}
        @if(isset($row['id']))
              {{ HTML::link('/admin/delete/attribute/0/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить атрибут?')")) }}
        @endif

    </div>
    {{ Form::close() }}
</div>

@stop
