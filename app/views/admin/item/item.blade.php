@extends('admin.layout')

@section('sidebar')
    <!-- @ include('admin.post-menu') -->
@stop

@section('content')


<?php // var_dump('<pre>', $row) ?>

<div class="panel panel-default">

  <div class="panel-heading">
    <h3 class="panel-title"> <i class="glyphicon glyphicon-list-alt"></i> Товар </h3>
  </div>

  <div class="panel-body">

      <ul class="nav nav-tabs" role="tablist" id="tablist">
        <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Общие</a></li>
        <li role="presentation"><a href="#attribute" aria-controls="attribute" role="tab" data-toggle="tab">Атрибуты</a></li>
        <li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">Изображения</a></li>
      </ul>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="description">
            @include('admin.item.item-description')
        </div>
        <div role="tabpanel" class="tab-pane fade" id="attribute">
            @include('admin.item.item-attribute')
        </div>
        <div role="tabpanel" class="tab-pane fade" id="image">
            @include('admin.item.item-image')
        </div>
      </div> <!-- /.tab-content -->

  </div> <!-- /.panel-body -->

  <div class="panel-footer"></div>

</div>


@stop

@section('scripts')
    <script type="text/javascript">
        var attribute_row = <?php echo(count($product_attribute)); ?>;  
    </script>
    {{ HTML::script('/js/admin-item.js') }}
@stop


