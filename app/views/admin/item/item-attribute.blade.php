
{{ Form::open(array('url' => 'admin/item-attributes/'.(!empty($row->id)?$row->id:'') , 'class' => 'form-group', 'files' => true)) }}

	<h3>Атрибуты</h3>
  @if(!empty($product_attribute))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Атрибут</th>
          <th>Значение</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($product_attribute as $k=>$attr)
          <tr>
            <td>
              {{ '';//Form::select("attr[$k][attr_id]", $attributes, $attr->attribute_id, array('class'=>'form-control')); }}

              {{ Form::text("attr[$k][attr_value]", (!empty($attributes[$attr->attribute_id])?$attributes[$attr->attribute_id]:''), array('class'=>'form-control js-select-attr')); }}
              {{ Form::hidden("attr[$k][attr_id]", $attr->attribute_id); }}
            </td>
            <td>
              {{ Form::text("attr[$k][value]", $attr->value, array('class'=>'form-control attr-value')); }}

            </td>
            <td>
              <a href="#" onclick="deleteAttribute({{$attr->id}}, this)">Удалить</a>
            </td>
          </tr>
        @endforeach

          <tr id="js-add-attr">
            <td>
              <a class="js-add" onclick="addAttribute();">Добавить строку</a><br>
            </td>
          </tr>

      </tbody>
    </table>
  @endif

  {{ Form::label('', '') . Form::submit('Сохранить', array( 'class' => 'btn btn-success')) }}

{{ Form::close() }}

<br>
<p class="text-right">
  <a >Добавить атрибут</a><br>    
</p>

