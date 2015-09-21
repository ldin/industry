//инициируем автокомплит для имеющихся полей    
$( ".js-select-attr" ).autocomplete({
    source: "/admin/item-attribute-autocomplete",
    // source: JSON.parse('<?php echo (json_encode($attributes)) ?>'),
    minLength: 1,
    select: function(event, ui) {
      $(this).val(ui.item.value);
      $(this).parent().find("input[type='hidden']").val(ui.item.id);
      console.log( ui.item.id);
        // $('#q_street').val(ui.item.value);
        $(this).parent().parent().find(".attr-value").prop( "disabled", false);
        // $('#check-house').animate({height: 'show'}, 500);
    },
    search:function (event,ui) {
        // $('#answer-block').animate({height: 'hide'}, 500);
        $(this).parent().parent().find(".attr-value").prop( "disabled", true);
    },

});

    //тест
    // var hw1=JSON.parse('<?php echo (json_encode($attributes)) ?>');
    // var hw2=('<?php echo (json_encode($attributes)) ?>');
    // console.log(hw1, hw2);


$(document).ready(function(){
    var ckeditorText = CKEDITOR.replace( 'inputText' );
    AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditorText});
});    

// $('#tablist a').click(function (e) {
//   e.preventDefault()
//   $(this).tab('show')
// })    


//атрибуты

//удаляем атрибут
function deleteAttribute(attr_id, that){

    var elem_tr = $(that).parent().parent();
    if (confirm("Вы решили удалить строку. После удаления нельзя будет восстановить! Продолжаем?")){
        $.ajax({
          method: "get",
          url: "/admin/delete/attribut_product/0/"+attr_id, 
          success: function(){
            elem_tr.remove();
            alert( "Аттрибут удален" );
           }
        });
    }
}
//добавляем новую строку, блокируем значение до выбора атрибута 
    function addAttribute() {
        html =  '<tr id="attribute-row' + attribute_row + '">';
        html += '  <td><input type="text" name="attr[' + attribute_row + '][attr_value]" value="" class="form-control js-select-attr" /><input type="hidden" name="attr[' + attribute_row + '][attr_id]" value="" /></td>';
        html += '  <td><input name="attr[' + attribute_row + '][value]" class="form-control attr-value" disabled="true"></td>';
        html += '  <td><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button">Удалить</a></td>';
        html += '</tr>';        
        $('#js-add-attr').before(html);

        //инициируем автокомплит для нового поля(надо доработать и объединить)
        $('.js-select-attr').autocomplete({
            source: "/admin/item-attribute-autocomplete",
            minLength: 1,
            select: function(event, ui) {
              $(this).val(ui.item.value);
              $(this).parent().find("input[type='hidden']").val(ui.item.id);
              $(this).parent().parent().find(".attr-value").prop( "disabled", false);
            },
            search:function (event,ui) {
              $(this).parent().parent().find(".attr-value").prop( "disabled", true);
            },
        });
      
      attribute_row++;
    }

    // function attributeautocomplete(attribute_row) {
    //   $('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
    //     delay: 500,
    //     source: function(request, response) {
    //       $.ajax({
    //         url: 'index.php?route=catalog/attribute/autocomplete&token=a63434da82c4681840b087836842ba9a&filter_name=' +  encodeURIComponent(request.term),
    //         dataType: 'json',
    //         success: function(json) { 
    //           response($.map(json, function(item) {
    //             return {
    //               category: item.attribute_group,
    //               label: item.name,
    //               value: item.attribute_id
    //             }
    //           }));
    //         }
    //       });
    //     }, 
    //     select: function(event, ui) {
    //       $('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
    //       $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
          
    //       return false;
    //     },
    //     focus: function(event, ui) {
    //           return false;
    //       }
    //   });
    // }

    // $('#attribute tbody').each(function(index, element) {
    //   attributeautocomplete(index);
    // });

