//change pwd
$('#chgpwd').click(function (){
  if ($('#oldpwd').val()=='' || $('#newpwd').val()=='' || $('#chkpwd').val()==''){
    $('#info').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Заполните все поля.</div>');
    return;
  } else if ($('#newpwd').val()!=$('#chkpwd').val()){
    $('#info').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Пароли не совпадают. Проверьте введенные данные.</div>');
    return;
  }
  $.post("data/changepwd.php",
              {old:$('#oldpwd').val(),new:$('#newpwd').val()},
              function(data){
                    var data = JSON.parse(data);
                    if (data == 'notmatch'){

                      $('#info').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Вы не правильно ввели старый пароль. Попробуйте еще раз.</div>');
                      return;
                    }                     
                    if (data == 'yes'){
                      $('#info').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Поздравляю! Вы успешно сменили пароль. </div>');
                      return;
                    }                     

                  });
})

//toogle sidebar
$('#br-btn').click(function (){
  $('.sidebar-collapse').fadeToggle();
  if($('#page-wrapper').css('margin-left') == '250px'){
    setTimeout("$('#page-wrapper').css('margin-left','0px')", 500);}
  else {
    $('#page-wrapper').css('margin-left','250px');}
    }); 

    $(document).ready(function () {

    });