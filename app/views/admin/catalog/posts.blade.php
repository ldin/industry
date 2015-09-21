@extends('admin.layout')

@section('sidebar')
    @include('admin.catalog.post-menu')
@stop

@section('content')
<div>

<h3><i class="glyphicon glyphicon-list-alt"></i> Страница</h3>
<br>

{{ Form::open(array('url' => 'admin/content/'.$type_id.'/'.(isset($row['id'])?$row['id']:'') , 'class' => 'form-group', 'files' => true)) }}

    <div class="tab-content">
        <div class="form-group {{ ($errors->first('name')) ? 'has-error' : '' }}">
            {{ Form::label('inputName', 'Название*') }}
            {{ Form::text('name', (isset($row->name)?$row->name:''), array('class'=>'form-control', 'id'=>'inputName')); }}
        </div>
        <div class="form-group {{ ($errors->first('title')) ? 'has-error' : '' }}">
            {{ Form::label('inputTitle', 'Title*', array('class'=>'control-label')) }}
            {{ Form::text('title', (isset($row->title)?$row->title:''), array('class' => 'form-control', 'id'=>'inputTitle')); }}
            {{ ($errors->first('title')) ? Form::label('error', 'Некорректный Title', array('class'=>'control-label')) : '' }}
        </div>

        <div class="form-group {{ ($errors->first('slug')) ? 'has-error' : '' }}">
            {{ Form::label('inputSlug', 'URL', array('class'=>'control-label')) }}
            <small><p class="info-txt">Только латинские символы, цифры, дефис. <i>При незаполненом поле URL генерируется из названия</i></p></small>

            {{ Form::text('slug', (isset($row->slug)?$row->slug:''), array('class' => 'form-control', 'id'=>'inputSlug')); }}
            {{ ($errors->first('slug')) ? Form::label('error', 'Некорректный URL', array('class'=>'control-label')) : '' }}
        </div>


        <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                {{ Form::label('selectType', 'Тип страницы') }}
                {{ Form::select('type_id', $type_page, $type_id, array('class' => 'form-control ', 'id'=>'selectType'))}}
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                {{ Form::label('selectParent', 'Родительская категория') }}
                {{ Form::select('parent', $parent, (isset($row->parent)?$row->parent:''), array('class' => 'form-control', 'id'=>'selectParent'))}}
                <p class="info-txt">Заполняется только для шаблонов с меню</p>
            </div>
        </div>

        <div class="row">
        <!--
            <div class="form-group col-sm-6 col-xs-12">
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox('noindex', '1', (isset($row->noindex)&&($row->noindex==true)?array('checked'):'') )  }}
                    Закрыть от индексации роботами
                  </label>
                </div>
            </div> -->
            <div class="form-group col-sm-6 col-xs-12">
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox('status', '1', (isset($row->status)&&($row->status==true)?array('checked'):'') )  }}
                    Показывать на сайте <span class="info-txt">( иначе доступ только из админки)</span>
                  </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('inputText', 'Текст') }}
            {{Form::textarea('text', (isset($row->text)?$row->text:''), array('class' => 'form-control ', 'id'=>'inputText')); }}
        </div>

        <div class="row">
<!--             <div class="form-group col-sm-8 col-xs-12">
                {{ Form::label('inputPreview', 'Превью') }}
                {{Form::textarea('preview', (isset($row->preview)?$row->preview:''), array('class' => 'form-control ', 'id'=>'inputPreview', 'rows'=>'5')); }}
            </div> -->
            <div class="form-group col-sm-4 col-xs-12">
                {{ Form::label('inputImage', 'Изображение') }}
                {{ Form::file('image') }}
                <p class="info-txt">(только для шаблонов "картинка-текст")</p>
                @if(isset($row->image)&&($row->image))
                    <br>
                    <div class="img img-thumbnail">
                        {{ HTML::image($row->image, 'img') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', (isset($row->description)?$row->description:''), array('class' => 'form-control')); }}
        </div>
        <div class="form-group">
            {{ Form::label('keywords') }}
            {{ Form::text('keywords', (isset($row->keywords)?$row->keywords:''), array('class' => 'form-control')); }}
        </div>
        <br />
        {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-success')) }}
        @if(isset($row['id']))
              {{ HTML::link('/admin/delete/page/'.$type_id.'/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить статью?')")) }}
        @endif

    </div>
    {{ Form::close() }}
</div>

 @include('admin.catalog.post-gallery')

@stop

@section('scripts')
<script type="text/javascript" >
    $(document).ready(function() {
        var ckeditorText = CKEDITOR.replace( 'inputText' );
        AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditorText});

        // var ckeditorPreview = CKEDITOR.replace( 'inputPreview', {
        //  toolbarGroups: [
        //         {"name":"basicstyles","groups":["basicstyles"]},
        //         {"name":"links","groups":["links"]},
        //         {"name":"paragraph","groups":["list","blocks"]},
        //         {"name":"document","groups":["mode"]},
        //         {"name":"insert","groups":["insert"]},
        //         {"name":"styles","groups":["styles"]}
        //     ],
        //     removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        //     });
        // AjexFileManager.init({returnTo: 'ckeditorPreview', editor: ckeditorPreview});

    });

</script>

@stop


