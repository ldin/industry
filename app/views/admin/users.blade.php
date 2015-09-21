@extends('admin.layout')



@section('sidebar')
<br>
    <h3><i class="glyphicon glyphicon-user"></i><span class="menu-title"> Администраторы</span></h3>
    @if(!empty($users) && count($users)>0 )
        <ul class="nav menu">

            @foreach($users as $post)

                <li {{ (Request::is('admin/user/'.$post->id)) ? 'class="active"' : '' }}>
                    <a href="/admin/user/{{$post->id}}">
                        <i class="glyphicon {{($post->isActive == 1)?'glyphicon-ok-sign':'glyphicon-remove-sign'}}"></i>
                        {{  $post->name }}
                    </a>
                </li>
            @endforeach


        </ul>
    @endif

    <p><br>
        <?php echo HTML::decode(HTML::link('/auth/register/', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить', array('class'=>'addNews'))); ?>
    </p>

@stop

@section('content')

<div class="col-xs-12 col-md-8">



    @if($row)

    <h3> Редактировать профиль</h3>


        {{ Form::open(array('url' => 'admin/user/'.$row['id'], 'name'=>'userform', 'class' => 'form-group')) }}

            <div class="tab-content">

                <br />
                <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
                {{ Form::label('Имя') }}
                {{ Form::text('name', (isset($row->name)?$row->name:''), array('class' => 'form-control')); }}
                {{ ($errors->first('name')) ? Form::label('error', $errors->first('name'), array('class'=>'control-label')) : '' }}

                </div>

                <br />
                <div class="{{ ($errors->first('title')) ? 'has-error' : '' }}">
                {{ Form::label('Email', 'Email', array('class'=>'control-label')) }}
                {{ Form::text('email', (isset($row->email)?$row->email:''), array('class' => 'form-control')); }}
                {{ ($errors->first('email')) ? Form::label('error', $errors->first('email'), array('class'=>'control-label')) : '' }}

                </div>

                <br />
                {{ Form::label('isActive', 'Дотуп к админке', array('class'=>'control-label')) }}
                {{ Form::select('isActive', array( '0' => 'Отключен', '1' => 'Включен'), (isset($row->isActive)?$row->isActive:''), array('class' => 'form-control')); }}


                <br />
                {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-inverse')) }}

                {{ HTML::link('admin/delete/user/0/'.$row['id'], 'Удалить пользователя', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить пользователя?')")) }}

            </div>

        {{ Form::close() }}

    @else
            <p>Выберите пользователя</p>
    @endif
</div>


@stop

@section('scripts')

@stop


