function svButtonG () {
    $('#svButton').removeClass();
    $('#svButton').addClass('btn btn-success');
    $('#svButton').html('<li class="fa fa-check"> Сохранено</li>');
}




function svButtonB () {
    $('#svButton').removeClass();
    $('#svButton').addClass('btn btn-primary');
    $('#svButton').html('Сохранить изменения');    
}

function takeWP() {
    $.get(
    "data/WP.php",
                {inp:$('#inpWP').val(),id:getSelectedIds("dataUsers2","id_user")},
                function(wData){
                    var arr = JSON.parse(wData);
                    //alert(arr[0]+'|'+arr[1]);
                    if (arr[0]=="exist") {
                       // alert(arr);
                        $('#busyWP').modal('show');
                        $('#busyman').html(arr[1]);
                       return; 
                    }
                    if (arr[0]=='noexist') {
                        
                        $('#nnWP').html($('#inpWP').val());
                        $('#addStreet').val('');
                          $("#street").prop("disabled", false);
                          $('#newStreet').removeClass('collapse in');
                            $('#newStreet').addClass('collapse');
                        $('#newWP').modal('show');
                        loadRef('street','Выберите адрес','');
                       return; 
                    }
                    $('#nameWP').html($('#inpWP').val());
                    $('#inpWP').val('');
                    $('#streetWP').html('Расположение: '+arr[0]);
                    getJurnal();    
                    showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user"));  
                    $('#chStreet').removeClass('disabled');
                    $('#freeWP').removeClass('disabled');                                                         
                    });
}

function preloadChangeStreet (){
  $('#cStreet').html($('#streetWP').html().replace('Расположение: ',''));
  $('#addStreet2').val('');
  $("#csStreet").prop("disabled", false);
  $('#newStreet2').removeClass('collapse in');
  $('#newStreet2').addClass('collapse');
  loadRef('csStreet','Выберите адрес',$('#cStreet').html());
  $('#changeStreet').modal('show');
}

function usrclose () {
    clsModal('newUser');
    
}

function confirmWP(){
     $.get(
    "data/busyWP.php",
                {inp:$('#inpWP').val(),id:getSelectedIds("dataUsers2","id_user")},
                function(wData){
                    alert(wData);
                    var arr = JSON.parse(wData);
                    $('#nameWP').html($('#inpWP').val());
                    $('#inpWP').val('');
                    $('#streetWP').html('Расположение: '+arr[1]);
                    getJurnal();
                    clsModal('busyWP');
                    showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user")); 
                    $('#chStreet').removeClass('disabled');
                    $('#freeWP').removeClass('disabled'); 
                    });
}

function newStreet(){
    if ($("#street").prop("disabled")){$("#street").prop("disabled", false); return}
    $("#street").prop("disabled", true);
}
function newStreet2(){
    if ($("#csStreet").prop("disabled")){$("#csStreet").prop("disabled", false); return}
    $("#csStreet").prop("disabled", true);
}

function saveStreet () {
    if ($("#csStreet").prop("disabled")){
        street = $('#addStreet2').val();
    } else {street = $("#csStreet").select2("val");}
    $.get(
    "data/changeStreet.php",
                {inp:$('#nameWP').text(),street:street},
                function(data){
                    var arr = JSON.parse(data);
                    $('#streetWP').html('Расположение: '+arr[0]);
                    clsModal('changeStreet');                     
                    });
}

function saveWP(){
    if ($("#street").prop("disabled")){
        street = $('#addStreet').val();
    } else {street = $("#street").select2("val");}
    $.get(
    "data/createWP.php",
                {inp:$('#inpWP').val(),id:getSelectedIds("dataUsers2","id_user"),street:street},
                function(data){
                    alert(data);
                    var arr = JSON.parse(data);
                    $('#nameWP').html($('#inpWP').val());
                    $('#inpWP').val('');
                    $('#streetWP').html('Расположение: '+arr[1]);
                    getJurnal();
                    clsModal('newWP');
                    showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user")); 
                    $('#chStreet').removeClass('disabled');
                    $('#freeWP').removeClass('disabled');                                   
                    });
}

function screenSize() {
      var w, h; // Объявляем переменные, w - длина, h - высота
      w = (window.innerWidth ? window.innerWidth : (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.offsetWidth));
      h = (window.innerHeight ? window.innerHeight : (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.offsetHeight));
      return {w:w, h:h};
}

function clsModal(a) {
    $("#"+a).modal("hide");
}

function transferUser(){
    idDep = $("#depSelect").select2("val");
    if (idDep=='') {alert('Не удалось загрузить список отделов');} else {
$.get(
    "data/transferUser.php",
                {idDep:idDep,id:getSelectedIds("dataUsers2","id_user")},
                function(uData){
                    $('#depart').modal('hide');
showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user")); 
//alert(uData);
nDep = uData;
$.get(
    "data/insertTrans.php",
                {idDep:nDep,id:getSelectedIds("dataUsers2","id_user")},
                function(dData){
                   // alert(dData);
                    });

//alert(id);
});
}
}


function loadDeps(id){
     $("#depSelect").select2("destroy");
$.get(
    "data/loadDeps.php",
                {id:id},
                function(depData){
                    //alert(depData);
                             var data =  [ ];  
                t=0;id="";tag="";  
   for (i=0;i<depData.length;i++) {
       if (depData.charAt(i)=="[") {t=t+1;}
       if (depData.charAt(i)!='[' && depData.charAt(i)!=']' && t==0) {id=id+depData.charAt(i);}
       if (depData.charAt(i)!='[' && depData.charAt(i)!=']' && t==1) {tag=tag+depData.charAt(i);}
       if (depData.charAt(i)==']') {
       data.push({id:id,tag:tag});
       id='';tag='';t=0;
                                    }
       }
               
               
       $("#depSelect :selected").remove();            
   $("#depSelect").select2({
data:{ results: data,text: 'tag' },
formatSelection: function (item) { return item.tag; },
formatResult: function (item) { return item.tag; },
 placeholder: "Справочник",
allowClear: true
}); 
  
  content = "<img src='img/cancel.png'></img>"
  $('#body').append(content);
     $("#depSelect").select2("val", "");
               
                  
                  
                    });
    
}



function loadOrgs(){
 //alert('sss');  
   $("#orgSelect").select2("destroy");
   // $("#depSelect").select2("destroy");
    
$.get(
    "data/getOrgs.php",
                {a:"job"},
                function(orgData){
                  // alert(orgData);
                var data =  [ ];  
                t=0;id="";tag="";  
   for (i=0;i<orgData.length;i++) {
       if (orgData.charAt(i)=="[") {t=t+1;}
       if (orgData.charAt(i)!='[' && orgData.charAt(i)!=']' && t==0) {id=id+orgData.charAt(i);}
       if (orgData.charAt(i)!='[' && orgData.charAt(i)!=']' && t==1) {tag=tag+orgData.charAt(i);}
       if (orgData.charAt(i)==']') {
       data.push({id:tag,tag:tag});
       id='';tag='';t=0;
                                    }
       }

       $("#orgSelect :selected").remove();            
   $("#orgSelect").select2({
data:{ results: data,text: 'tag' },
formatSelection: function (item) { return item.tag; },
formatResult: function (item) { return item.tag; },
 placeholder: "Справочник",
allowClear: true
}); 
  
  content = "<img src='img/cancel.png'></img>"
  $('#body').append(content);
     $("#orgSelect").select2("val", "");
     
     $("#orgSelect").on("change", function(e) {
id = $("#orgSelect").select2("val");
$("#depSelect").select2("val", "");
loadDeps(id);
});
     /////////////////
      var data2 =  [ ];  
      $("#depSelect").select2("destroy");
       $("#depSelect :selected").remove();            
   $("#depSelect").select2({
data:{ results: data2,text: 'tag' },
formatSelection: function (item) { return item.tag; },
formatResult: function (item) { return item.tag; },
 placeholder: "Справочник",
allowClear: true
}); 
  
  content = "<img src='img/cancel.png'></img>"
  $('#body').append(content);
     $("#depSelect").select2("val", "");
     /////////////////
     
                });  
}




function loadFromAd(){
  login = $('#userad').val();
  if (login=='') {
        $('#userad').attr('data-content','Это поле не должно быть пустым');
        $('#userad').popover('show');    
        return;
  }
  $.get(
    "data/AD.php",
                {login:login},
                function(data){
                  //  alert(data)
                    if (data==-1) {
        $('#userad').attr('data-content','Пользователь с таким Логином не найден на контроллере домена!');
        $('#userad').popover('show');
                        } else
                    { t=0;s='';  lkt='';
                        for (i=0;i<data.length;i++)
                        {
                            if (data.charAt(i)=='|') {
                                if (t==0) {$('#fname').val(s);}
                                if (t==1) {$('#iname').val(s);}
                                if (t==2) {$('#oname').val(s);}
                                if (t==3) {$('#tel').val(s);}
                                if (t==4) {$('#kab').val(s);}
                                if (t==7) {$('#email').val(s);}
                                if (t==5) {
                                   // var dt = $("#job").select2("data");
                                    // delete dt.element; alert("Selected data is: "+JSON.stringify(dt));
                                     //$("#job").select2("val", s);
                                   // $('#job').val(s);
                                   loadRef('job','Выберите должность',s);
                                }
                                if (t==6) {
                                    //alert(s);
                                    if (s!='') {
                                    $('#tml').empty();
                                    $('#tml').append("<img id='imgU' style='margin-left: 1.5px;' src='data:image/png;base64,"+s+"' />");
                                    }
                                    }
                                t=t+1;s='';}
                            if (data.charAt(i)!='|') {s=s+data.charAt(i);}    
                        }
                    }
                   // alert(data);
                  //  getBase64Image(lkt);
                    });
svButtonB();    
}


function getJurnal(){
    ///////////////////////////
   // alert(getSelectedIds("dataUsers2","id_user"));
$('#history_body').empty();

$.get(
    "data/loadJurnal.php",
                {id:getSelectedIds("dataUsers2","id_user")},
                function(jurnalData){
                  // alert(jurnalData);
                    $('#uHistory').DataTable().destroy();
                    $('#history_body').html(jurnalData);
    $('#uHistory').dataTable({
        "searching": false,
        "pagingType": "simple",
        "ordering":  false,
        //"info":     false,
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Все"]],
        "dom": 'rt<"bottom"ip><"clear">',
        "language": {
            "lengthMenu": ""
        }
     });  
     $('#uHistory_info').css('float','left');                     
                    });
    
                                    
///////////////////////////
}




function loadRef (ref,caption,value){
    $("#"+ref).select2("destroy");
    
$.get(
    "data/getRef.php",
                {a:ref},
                function(refData){
                var data =  [ ];  
                t=0;id="";tag="";  
   for (i=0;i<refData.length;i++) {
       if (refData.charAt(i)=="[") {t=t+1;}
       if (refData.charAt(i)!='[' && refData.charAt(i)!=']' && t==0) {id=id+refData.charAt(i);}
       if (refData.charAt(i)!='[' && refData.charAt(i)!=']' && t==1) {tag=tag+refData.charAt(i);}
       if (refData.charAt(i)==']') {
       data.push({id:tag,tag:tag});
       id='';tag='';t=0;
                                    }
       }

       $("#"+ref+" :selected").remove();            
   $("#"+ref).select2({
data:{ results: data,text: 'tag' },
//onChange:chh(),
formatSelection: function (item) { return item.tag; },
formatResult: function (item) { return item.tag; },
 placeholder: caption,
allowClear: true
}); 
  
  content = "<img src='img/cancel.png'></img>"
  $('#body').append(content);
//     $("#"+ref).select2("val", "");
     if (value==''){value="";}                                
     $("#"+ref).select2("val", value);
                });     
                
}



function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    // Center modal vertically in window
    $dialog.css("margin-top", offset);
}




function showModalD(e){
   // alert(e)
   $('#userad').popover('hide');
   if (e=='noAD') {
     $('#alertBtn').text('Хорошо');
        $('#alertTtl').text('Предупреждение');
        $('#alertMsg').text("Заполните обязательное поле 'Пользователь AD'");
        $('#alert').modal('show');
   }
   if (e=='existUser') {
     $('#alertBtn').text('Хорошо');
        $('#alertTtl').text('Предупреждение');
        $('#alertMsg').text("Пользователем с таким логином в AD уже есть!");
        $('#alert').modal('show');
   }
   
    if (e=='newUser') {
        if (  $('#tHeadd').attr('tag')!='-1') {
svButtonB();            
           
           ///disabled buttons
           $('#utags').attr('disabled','disabled');
             $('#insEV').addClass('disabled');
           $('#tWP').addClass('disabled');
           $('#addIT').addClass('disabled');
           $('#tDrop').addClass('disabled');
           $('#addDrop').addClass('disabled');
           $('#removeIT').addClass('disabled');
           ///disabled buttons
    $('#chStreet').addClass('disabled');
    $('#freeWP').addClass('disabled');    
    document.forms.main.reset();
    $('.nav-pills li').removeClass('active');
    $('.tab-pane').removeClass('active in');
    $('#main-pill').addClass('active');
    $('#main-pills').addClass('active in');
    
    $('#dopInfo').val('');
     $('#myModalLabel').text('Добавление пользователя');
    $('#tml').empty();
    $('#tml').html('<img id="imgU" style="margin-left: 1.5px;" id="tml" src="img/96.svg" alt="...">');
    
    
    

    $('#'+e).modal('show');
    //$('#newUser').css('height','200px');
    //alert($('#newUser').css('height'));
    //alert(screenSize().h)
    //alert('ss');
    $('#utags').tagsinput('removeAll');
    $('#history_body').empty();
    $('#nameWP').html('Рабочее место отсутствует');
    $('#streetWP').html('Расположение: ');    
    loadRef('job','Выберите должность','');
    } else {
        $('#treeOrg').attr('data-content','Выберите подразделение');
        $('#treeOrg').popover('show');
    }
    
    } 
    //alert(e)
      if (e=='editUser') {
    document.forms.main.reset();
    $('.nav-pills li').removeClass('active');
    $('.tab-pane').removeClass('active in');
    $('#main-pill').addClass('active');
    $('#main-pills').addClass('active in');
    $('#myModalLabel').text('Редактирование данных пользователя');
    $('#tml').empty();
    $('#tml').html('<img id="imgU" style="margin-left: 1.5px;" id="tml" src="img/96.svg" alt="...">');
 
   

  //  $('#newUser').on('hide.bs.modal', function () {
//        alert(('s'));
//  showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"loadUsers.php",table,tablebody,hiddens,-1); 
//});     
    $('#newUser').modal('show');
/*
$('#utags').tagsinput('removeAll');   
$.get(
    "data/getTags.php",
                {id:getSelectedIds("dataUsers2","id_user")},
                function(data){
                    //alert(data)
                    nm='';
                    for (i=0;i<data.length;i++){
                        if (data.charAt(i)==';') {$('#utags').tagsinput('add', nm);;nm="";}
                        if(data.charAt(i)!=';') {nm=nm+data.charAt(i);}
                    }
                    }); */

    } 
    
       if (e=='transferUser') {
 a = $("#dataUsers2").DataTable().rows('.selected').data().length;
 if (a!=1) {
     $('#usersTable').attr('data-content','Выберите одну запись в таблице!');
        $('#usersTable').popover('show');
       
    } else {
    $('#depart').modal('show');
    loadOrgs();

    }
    } 
    
}



function deleteUser(){
 a = $("#dataUsers2").DataTable().rows('.selected').data().length;
 if (a<1) {
     $('#usersTable').attr('data-content','Выберите хотя бы одну запись в таблице!');
        $('#usersTable').popover('show');
      
    } else {
        $('#delUser').modal('show');
   }
   
}

function confirmDelUser(){
$.post(
    "data/deleteUser.php",
                {id:getSelectedIds("dataUsers2","id_user")},
                function(data){
                     table =  'dataUsers2';
                    tablebody = 'usersTable';
                    hiddens =[0];
showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user")); 
clsModal('delUser');                                       
                    });
    
}

function chh(){
    alert('change');
}

function editUser(){
        $('#chStreet').removeClass('disabled');
        $('#freeWP').removeClass('disabled');
 a = $("#dataUsers2").DataTable().rows('.selected').data().length;
 if (a!=1) {
     $('#usersTable').attr('data-content','Выберите одну запись в таблице!');
        $('#usersTable').popover('show');} else {
 svButtonG();
  ///enabled buttons
           $('#utags').removeAttr('disabled');
             $('#insEV').removeClass('disabled');
           $('#tWP').removeClass('disabled');
            $('#tDrop').removeClass('disabled');
           $('#addDrop').removeClass('disabled');
           $('#addIT').removeClass('disabled');
           $('#removeIT').removeClass('disabled');
           ///enabled buttons
    showModalD('editUser');
        $("#job").select2("destroy");
    
$.get(
    "data/getRef.php",
                {a:"job"},
                function(refData){
                var data =  [ ];  
                t=0;id="";tag="";  
   for (i=0;i<refData.length;i++) {
       if (refData.charAt(i)=="[") {t=t+1;}
       if (refData.charAt(i)!='[' && refData.charAt(i)!=']' && t==0) {id=id+refData.charAt(i);}
       if (refData.charAt(i)!='[' && refData.charAt(i)!=']' && t==1) {tag=tag+refData.charAt(i);}
       if (refData.charAt(i)==']') {
       data.push({id:tag,tag:tag});
       id='';tag='';t=0;
                                    }
       }

       $("#job :selected").remove();            
   $("#job").select2({
data:{ results: data,text: 'tag' },
//onChange: chh(),
formatSelection: function (item) { return item.tag; },
formatResult: function (item) { return item.tag; },
 placeholder: "Выберите должность",
allowClear: true
}).on("change", function() {
         svButtonB();
        }) 
  
  content = "<img src='img/cancel.png'></img>"
  $('#body').append(content);
     $("#job").select2("val", "");
     
     
      ///////////////////////////////////////////////////
$.get(
    "data/loadUserInfo.php",
                {id:getSelectedIds("dataUsers2","id_user")},
                function(userData){
                       for (i=0;i<userData.length;i++)
                        {
                            if (userData.charAt(i)==';') {
                                if (t==1) {$('#fname').val(s);}
                                if (t==2) {$('#iname').val(s);}
                                if (t==3) {$('#oname').val(s);}
                                if (t==4) {$('#userad').val(s);}
                                if (t==6) {$('#tel').val(s);}
                                if (t==7) {$('#kab').val(s);}
                                if (t==9) {
                                    if (s==' ') {s='';}
                                    $('#pass').val(s);
                                //alert("/"+s+"/")
                                }
                                if (t==10) {$('#dopInfo').val(s);}
                                if (t==11) {$('#nameWP').text(s);}
                                if (t==12) {$('#streetWP').text('Расположение: '+s);}
                                if (t==13) {$('#email').val(s);}
                                if (t==14) {$('#utags').tagsinput('removeAll');   
                    nm='';
                    s=s+',';
                    for (i=0;i<s.length;i++){
                        if (s.charAt(i)==',') {$('#utags').tagsinput('add', nm);;nm="";}
                        if(s.charAt(i)!=',') {nm=nm+s.charAt(i);}
                    } svButtonG();}
                                if (t==5) {
                                   // var dt = $("#job").select2("data");
                                    // delete dt.element; alert("Selected data is: "+JSON.stringify(dt));
                                     $("#job").select2("val", s);
                                   // $('#job').val(s);
                                }
                                if (t==8) {
                                    //alert(s);
                                    $('#tml').empty();
                                    $('#tml').append("<img id='imgU' style='margin-left: 1.5px;' src='"+s+"' />");
                                    }
                                t=t+1;s='';}
                            if (userData.charAt(i)!=';') {s=s+userData.charAt(i);}    
                        }
                    getJurnal();
                    
                    
 
    if ($('#nameWP').text()=='Рабочее место отсутствует'){
        $('#chStreet').addClass('disabled');
        $('#freeWP').addClass('disabled');
    }
                    });
                    ////////////////////////////////////////////////////////////////////
     
     
                });  
   
    
 }
   
}

function checkSave (e){
    
}

function insert_event(){
    checkSave('insert_event');
    if ($('#event').val()!='') {
         $.get(
    "data/insertEvent.php",
                {id:getSelectedIds("dataUsers2","id_user"),text:$('#event').val()},
                function(data){
                   // alert(data);
                   $('#event').val('');
                    getJurnal();
                    });
        
        
    }
}



function saveNewUser(){
  arr =  $("#utags").tagsinput('items');
    //console.log(arr);
    fname = $('#fname').val();iname = $('#iname').val();oname = $('#oname').val();dolgn = $('#dolgn').val();tel = $('#tel').val();
    kab = $('#kab').val();userad = $('#userad').val();pass = $('#pass').val();rabm = $('#rabm').val();dopInfo = $('#dopInfo').val();
    email = $('#email').val();
    //dolgn = $('#job').val();
    if (userad=='') {
        $('#userad').attr('data-content','Это поле не должно быть пустым');
        $('#userad').popover('show');
        return;
    }
    
     dolgn = $("#job").select2("val");
    idDep = $('#tHeadd').attr('tag');
  var img = document.getElementById("imgU");
   var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var context = canvas.getContext('2d');
    context.drawImage(img,0,0);
    var dataImg = canvas.toDataURL("image/png");
   if ( $('#myModalLabel').text()=='Добавление пользователя') { edit=0;} else {edit=1;}
   $.post(
    "data/saveNewUser.php",
                {tags:arr,id:getSelectedIds("dataUsers2","id_user"),fname:fname,iname:iname,oname:oname,dolgn:dolgn,tel:tel,kab:kab,userad:userad,
                pass:pass,rabm:rabm,dopInfo:dopInfo,photo:dataImg,idDep:idDep,edit:edit,email:email},
                function(data){
                    //alert(data);
                    if (data=='no') {
                       
        $('#userad').attr('data-content','Такой пользователь уже есть');
        $('#userad').popover('show');
                        return;
                    }
                    //alert(data);
                    //$('#newUser').modal('hide');
                    table =  'dataUsers2';
                    tablebody = 'usersTable';
                    hiddens =[0];
                    //showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"loadUsers.php",table,tablebody,hiddens);
                    //alert('sss');
                      ///enabled buttons
           $('#utags').removeAttr('disabled');
             $('#insEV').removeClass('disabled');
           $('#tWP').removeClass('disabled');
            $('#tDrop').removeClass('disabled');
           $('#addDrop').removeClass('disabled');
           $('#addIT').removeClass('disabled');
           $('#removeIT').removeClass('disabled');
           ///enabled buttons
                    $('#myModalLabel').text('Редактирование данных пользователя');
                    svButtonG();
                    //showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,data); 
                    });
}


function clearWP(){
    id = getSelectedIds("dataUsers2","id_user");
    //alert(id);
     $.get(
    "data/clearWP.php",
                {id:id},
                function(datas){
                    getJurnal();
                    $('#nameWP').text('Рабочее место отсутствует');
                    $('#streetWP').text('Расположение : ');
    clsModal('emptyWP');
    showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user")); 
    $('#chStreet').addClass('disabled');
    $('#freeWP').addClass('disabled');  
    });
}



function getOrg(){
    
     $.get(
    "data/getOrg.php",
                {a:"a"},
                function(datas){

     var data =  [ ];
       tg1='';id1='';t=0;
                         for (i=0;i<datas.length;i++) {
                   if (datas.charAt(i)=='%') {t=t+1;};
                   if (datas.charAt(i)!='%' && t==0) {tg1=tg1+datas.charAt(i);};
                   if (datas.charAt(i)!='%' && datas.charAt(i)!=';' && t==1) {id1=id1+datas.charAt(i);};
                   if (datas.charAt(i)==';') {t=0;
                   data.push( { id: id1, tag: tg1 });
                   tg1='';id1='';
                   }
                   } 

});
    
}





function tree() {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', '');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', '').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', '').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
    var children =$('.tree li:has(ul)').find(' > ul > li');
    children.hide('fast');
}

function cl(e){
    $('#treeOrg').popover('hide');
    //el = e.parentNode.parentNode.parentNode.firstChild;
   // $(el)
    
   // alert($(el).text());
   $('#tHeadd').empty();
   $('#tHeadd').attr('tag',e.id.replace('e',''));
   $('#tHeadd').append($('#'+e.id).text() +' - '+ $(e.parentNode.parentNode.parentNode.firstChild).text());
    table = 'dataUsers2';
    tablebody = 'usersTable';
    hiddens = [0];
   showTable(e.id.replace('e',''),{id:e.id.replace('e','')},"data/loadUsers.php",table,tablebody,hiddens,getSelectedIds("dataUsers2","id_user")); 
}


function showTable(id,params,file,table,tablebody,hiddens,tekId){
    //alert(tekId);
     $.get(
    file,
                params,
                function(datas){
                   // alert(datas);
                   // $('#dataUsers2').dataTable( {
  //"destroy": true
//} );
 $('#'+table).DataTable().destroy();
                    $('#'+tablebody).empty();
                    
                    /////////////////////////////
                    s='';content='';t=0;
                        for (i=0;i<datas.length;i++)
                        {
                             if (datas.charAt(i)=='|') {
                                t=0;
                                if (i==datas.length-1) {
                                content=content+'</tr>';} else {content=content+'</tr>';}
                                }
                                
                                if (datas.charAt(i)==';' && t==0) {
                                    //alert(s);
                                    if (parseInt(s)==tekId) {
                                        content=content+'<tr id="sel_row">';
                                    } else {
                                    content=content+'<tr>';}
                                    t=t+1;
                                    }
                                
                            if (datas.charAt(i)==';') {
                                content=content+'<td>'+s+'</td>';
                                s='';}
                            if (datas.charAt(i)!='|' && datas.charAt(i)!=';') {s=s+datas.charAt(i);}    
                        }
                       // alert(content)
                    /////////////////////////////
                    if (content=='<tr>') {content='';}
                       $('#'+tablebody).append(content);
                    ////////////////////
                   tbl = $('#'+table).dataTable( {
        rowId: 'extn',
        dom: 'T<"clear">lfrtip',
        "order": [[ 1, "asc" ]],
        tableTools: {
            "sSwfPath": "swf/copy_csv_xls_pdf.swf", 
            "sRowSelect": "os", 
                        "aButtons": [ 
                {
                    "sExtends":     "copy",
                    "sButtonText": "<a class='fa fa-copy fa-fw'></a>",
                    "sToolTip": "Копировать в буфер"
                },
                {
                    "sExtends":     "xls",
                    "sButtonText": "<a class='fa fa-file-excel-o fa-fw'></a>",
                    "sFileName": "Users.csv",
                    "sToolTip": "Экспортировать в Excel"
                } 
                        ] 
  
        },
        "columnDefs": [
            {
                "targets":  hiddens ,
                "visible": false
            }
        ]
    } );
      $('#sel_row').addClass('DTTT_selected selected');
          $('#'+table+' tbody').on( 'click', 'tr', function () {
           if (this.id!='sel_row')
          $('#sel_row').removeClass('DTTT_selected selected');
    } );
    //tbl.row('#sel_row').addClass('selected');
                    //////////////////////
                    
                    });
}



function gettree(){
     $.get(
    "data/getTree.php",
                {a:"a"},
                function(data){
                   // alert(data);
                    $('#treeOrg').empty();
                    $('#treeOrg').append(data);
                    tree();
                    });
}



function getSelectedIds(tableProto,fieldName){
     var tableaa = $('#'+tableProto).DataTable();
      tdata =  tableaa.rows( ".selected" ).data() ;
           //alert((tdata[1,1]));
           idx = tableaa.column( ':contains('+fieldName+')' ).index();
           s='';
           for (i=0;i<tdata.length;i++){
           s=s+ tdata[i][idx]+',' ;
           }
           s=s.substring(0, s.length - 1)
    return s;
}



$(document).ready(function () {
    $('#ftoogle').click(function (){
        $('#filtr').fadeToggle();
        });
    $('.modal').on('show.bs.modal', centerModal);
    $('#newUser').on('hide.bs.modal', function () {
  //  alert('sd');
  showTable($('#tHeadd').attr('tag'),{id:$('#tHeadd').attr('tag')},"data/loadUsers.php",table,tablebody,hiddens,-1); 
});


    $('#br-btn').click(function (){
$('.sidebar-collapse').fadeToggle();
       if($('#page-wrapper').css('margin-left') == '250px'){
          setTimeout("$('#page-wrapper').css('margin-left','0px')", 500);}
       else {
          $('#page-wrapper').css('margin-left','250px');}
    });    
    
    
    
     $('#users').addClass('active');
     $('#ulists').addClass('active');

$('.mytag').on('itemAdded', function(event) {
  svButtonB();
});
       
     $('#dataUsers2').dataTable( {
        rowId: 'extn',
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "swf/copy_csv_xls_pdf.swf", 
            "sRowSelect": "os", 
                        "aButtons": [ 
                {
                    "sExtends":     "copy",
                    "sButtonText": "<a class='fa fa-copy fa-fw'></a>",
                    "sToolTip": "Копировать в буфер"
                },
                {
                    "sExtends":     "xls",
                    "sButtonText": "<a class='fa fa-file-excel-o fa-fw'></a>",
                    "sFileName": "Users.csv",
                    "sToolTip": "Экспортировать в Excel"
                } 
                        ] 
  
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            } ]
    } );
      
gettree();
var data = {};

getOrg();




});