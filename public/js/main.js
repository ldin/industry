$(document).ready(function(){

   // menu
    var $menu = $("#menu");
    var $header = $('.js-header-block');
    // console.log($header)

    $(window).scroll(function(){
        var height = $header.height();
        if ( $(this).scrollTop() > height ){
            $menu.addClass("fixed");
        } else if($(this).scrollTop() <= height && $menu.hasClass("fixed")) {
            $menu.removeClass("fixed");
        }
    });	
    //menu-end

    //loc link
    $('.loc').on('click', function() {
        // console.log($(this).data('link'));
        document.location.replace($(this).data('link') );
    });

    $('#menu ul li ul li.active');
     // console.log($('#menu ul li ul li.active').parent().addClass('active'))

    function openForm(that){
    	//console.log(55, that);
    }


//Parallax Scrolling animation

    $('section[data-type="background"]').each(function(){
        var $bgobj = $(this); // создаем объект
        $(window).scroll(function() {
            var yPos = -($(window).scrollTop() / $bgobj.data('speed')); // вычисляем коэффициент 
            // Присваиваем значение background-position
            var coords = 'center '+ yPos + 'px';
            // Создаем эффект Parallax Scrolling
            $bgobj.css({ backgroundPosition: coords });
        });
    });
});
