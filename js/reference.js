

function showTable(id,params,file,table,tablebody,hiddens,tekId){
    //alert(tekId);
     $.get(
    file,
                params,
                function(datas){
                    //alert(datas);
                    if (datas.charAt(2)=='$') {
                          $('#tHeadd').removeAttr('parent');  
                              hiddens.push(4);
                    } else {
                     $('#tHeadd').attr('parent','true');
                    }
                    datas = datas.replace('$','');
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
        stateSave: true,
        dom: 'T<"clear">lfrtip',
        "order": [[ 1, "asc" ]],
        tableTools: {
            "sRowSelect": "os",
            "aButtons": [  ]   
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




function newRec(){
    //alert('|'+$('#tHeadd').text()+'|')
    $('#dialogHead').text("Добавить запись");
    $('#saveBtn').text("Создать");
    //alert()
 if (  $('#tHeadd').text()=='Справочник не выбран') {
     $('#treeRefs').attr('data-content','Выберите подразделение');
        $('#treeRefs').popover('show');
    } else {
        $('#rName').val('');
        $('#rInfo').val('');
        if ($('#tHeadd').attr('parent')=='true') {
             $('#parentArea').show();
              loadRef('rParent','Не выбрано','',$('#tHeadd').attr('tag'));
               } else {
            $('#parentArea').hide();
        }
        // document.forms.main.reset();
        
  $('#refItem').modal('show');
  }
}


function delRec(){
     if (  $('#tHeadd').text()=='Справочник не выбран') {
     $('#treeRefs').attr('data-content','Выберите подразделение');
        $('#treeRefs').popover('show');
    } else {
        a = $("#refTable").DataTable().rows('.selected').data().length;
 if (a<1) {
     $('#refTableBody').attr('data-content','Выберите хотябы одну запись в таблице!');
        $('#refTableBody').popover('show');} else {
            ////////////////////////////////
           
           spr=$('#tHeadd').text();
           spr = spr.replace('Справочник','');
           $('#delTxt').text('Вы действительно хотите удалить "'+getSelectedIds("refTable","Наименование")+'" из справочника '+spr+'?');
            $('#delUser').modal('show');
            //////////////////////////////
            }
        
        
        
        
        }
    
    
}
 
 
 function clsModal(a) {
    $("#"+a).modal("hide");
}

function editRec(){
    //alert('|'+$('#tHeadd').text()+'|')
    $('#dialogHead').text("Редактировать запись");
      $('#saveBtn').text("Сохранить");
    //alert()
 if (  $('#tHeadd').text()=='Справочник не выбран') {
     $('#treeRefs').attr('data-content','Выберите подразделение');
        $('#treeRefs').popover('show');
    } else {
        
        
         a = $("#refTable").DataTable().rows('.selected').data().length;
 if (a!=1) {
     $('#refTableBody').attr('data-content','Выберите одну запись в таблице!');
        $('#refTableBody').popover('show');} else {
        
        
        //$('#rName').val('');
        //$('#rInfo').val('');
        if ($('#tHeadd').attr('parent')=='true') {
             $('#parentArea').show();
            
               } else {
            $('#parentArea').hide();
        }
        
        
        $.get(
    "data/loadRefRec.php",
                {idRec:getSelectedIds("refTable","ID"),tblId:$('#tHeadd').attr('tag')},
                function(refData){
                    //alert(refData)
                    t=0;s='';
                    for (i=0;i<refData.length;i++) {
       if (refData.charAt(i)=="|") {
        if (t==0) {$('#rName').val(s);}
         if (t==1) {$('#rInfo').val(s);}
          if (t==2) {value=s;}
        t=t+1;s='';}
       if (refData.charAt(i)!='|') {s=s+refData.charAt(i);}
      
       }
                 /////////////////////
                 if ($('#tHeadd').attr('parent')=='true') {
             $('#parentArea').show();
              loadRef('rParent',value,value,$('#tHeadd').attr('tag'));
               } else {
            $('#parentArea').hide();
        }
              //loadRef('rParent','Не выбрано',value,$('#tHeadd').attr('tag'));
              ////////////////////////
              $('#tHeadd').text('Редактирование записи');
          $('#refItem').modal('show');
  });
        }

  }
}





function delRefRec(){
    idRec=getSelectedIds("refTable","ID");
         idRec=idRec+',';
        $.get(
    "data/delRefRec.php",
                {recId:idRec,tblId:$('#tHeadd').attr('tag')},
                function(data){
                        clsModal("delUser");
                        id = $('#tHeadd').attr('tag');
                        table =  'refTable';
                        tablebody = 'refTableBody';
                        hiddens =[0,5];
                        showTable(id,{id:id},"data/loadRefTable.php",table,tablebody,hiddens,-1); 
                    
                   
                    });
    
}




function createRefRow(){
    if ($('#dialogHead').text()=='Добавить запись') {
        edit=0;
        recId='-1';
    } else {
        edit=1;
        recId=getSelectedIds("refTable","ID");
    }

   // alert(edit)
     if ($('#tHeadd').attr('parent')=='true') {
        parent=$("#rParent").select2("val");
        } else {
            parent = 'noparent';
        }
    $.get(
    "data/saveRefRec.php",
                {recId:recId,edit:edit,tblId:$('#tHeadd').attr('tag'),name:$('#rName').val(),descr:$('#rInfo').val(),parent:parent},
                function(data){
                    if (data=='0') {
$('#rName').on('shown.bs.popover', function() {
    setTimeout(function() {
        $('#rName').popover('hide');
    }, 5000);
});                        
                             $('#rName').popover({placement : 'top', content : 'Такая запись уже есть', trigger : 'manual'}); 
                             $('#rName').popover('show');

                    } else {
                        $('#refItem').modal('hide');
                        id = $('#tHeadd').attr('tag');
                        table =  'refTable';
                        tablebody = 'refTableBody';
                        hiddens =[0,5];
                        showTable(id,{id:id},"data/loadRefTable.php",table,tablebody,hiddens,-1); 
                    }
                   
                    });
    

}



function loadRef (ref,caption,value,tblId){
    $("#"+ref).select2("destroy");
   // alert(tblId);
$.get(
    "data/getRef.php",
                {a:ref,id:tblId},
                function(refData){
                  //  alert((refData))
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






function gettree(){
     $.get(
    "data/getTree_refs.php",
                {a:"a"},
                function(data){
                    $('#treeRefs').empty();
                    $('#treeRefs').append(data);
                    //tree();
                    });
}

function cl(e){
   $('#tblHead').css('display','');
    id = e.id.replace('e','');
    table =  'refTable';
    tablebody = 'refTableBody';
    hiddens =[0,5];
    $('#tHeadd').text('Справочник "'+$('#'+e.id).text()+'"');
    $('#tHeadd').attr('tag',e.id.replace('e',''));
   showTable(id,{id:id},"data/loadRefTable.php",table,tablebody,hiddens,-1); 
}




$(document).ready(function () {

// разворачиваем меню
     $('#reference').addClass('active');
     $('#lineRef').addClass('active');
//прячем навигацию навигацию
    $('#br-btn').click(function (){
$('.sidebar-collapse').fadeToggle();
       if($('#page-wrapper').css('margin-left') == '250px'){
          setTimeout("$('#page-wrapper').css('margin-left','0px')", 500);}
       else {
          $('#page-wrapper').css('margin-left','250px');}
    });    
    
    

gettree();




});




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