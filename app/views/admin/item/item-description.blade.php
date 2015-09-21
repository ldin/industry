
{{ Form::open(array('url' => 'admin/item-description/'.(!empty($row->parent)?$row->parent:'').'/'.(!empty($row->id)?$row->id:'') , 'class' => 'form-group', 'files' => true)) }}

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
                {{ Form::label('selectParent', 'Родительская категория') }}
                {{ Form::select('parent', $parents, (isset($row->parent)?$row->parent:''), array('class' => 'form-control', 'id'=>'selectParent'))}}
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
            {{Form::textarea('description', (isset($row->description)?$row->description:''), array('class' => 'form-control ', 'id'=>'inputText')); }}
        </div>

        <div class="form-group">
            {{ Form::label('meta description') }}
            {{ Form::text('meta_description', (isset($row->meta_description)?$row->meta_description:''), array('class' => 'form-control')); }}
        </div>
        <div class="form-group">
            {{ Form::label('meta keywords') }}
            {{ Form::text('meta_keywords', (isset($row->meta_keywords)?$row->meta_keywords:''), array('class' => 'form-control')); }}
        </div>
        <br />
        {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-success')) }}
        @if(isset($row['id']))
              {{ HTML::link('/admin/delete/item/'.$row['id'], 'Удалить', array('class' => 'btn btn-danger', 'onClick' =>"return window.confirm('Вы уверены что хотите удалить статью?')")) }}
        @endif

    </div>
    {{ Form::close() }}