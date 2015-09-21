@extends('admin.layout')

@section('content')

<h1>Настройки</h1>

@if(isset($settings))
{{ Form::open(array('url' => 'admin/settings/', 'class' => 'form-group')) }}

    <div class="tab-content">
        <div>
            @foreach ($settings as $setting)
                <div class="row">
                    <div class="form-group col-sm-8">
                        {{ Form::label($setting->name, $setting->title, ['class'=>'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                            {{  Form::textarea($setting->name, $setting->value, array('class' => 'form-control', 'rows'=>'2')) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <br>
    </div>

{{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-success')) }}
{{ Form::close(); }}
@endif

<h2>Дополнительно</h2> 

    <div class="tab-content">
        <div>
                <br>
                <div class="col-xs-6 col-md-6">
                    Обновить карту сайта sitemap.xml
                </div>
                <div class="col-xs-6  col-md-6">
                    <a href="/admin/create-sitemap" class="btn btn-default">Обновить</a>
                </div>
                <div class="clear"></div>
        </div>

        <br>
    </div> 

@stop


