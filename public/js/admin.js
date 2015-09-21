$(document).ready(function(){

    $('.js-remove').click(function(){
        var elem_tr = $(this).parent().parent();
        if (confirm("Вы решили удалить пункт. После удаления его нельзя будет восстановить! Продолжаем?")){
            var elem_id = elem_tr.data('id');
            $.ajax({
              type: "POST",
              url: "/admin/rate-item-delete",
              data: {'type': 'inetOption', 'elem-id':elem_id},
              success: function() {
                  elem_tr.remove();
              }
            });
        }
    });

});



