    $('#br-btn').click(function (){
$('.sidebar-collapse').fadeToggle();
       if($('#page-wrapper').css('margin-left') == '250px'){
          setTimeout("$('#page-wrapper').css('margin-left','0px')", 500);}
       else {
          $('#page-wrapper').css('margin-left','250px');}
    });    