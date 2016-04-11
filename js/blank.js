

function showTable(id,params,file,table,tablebody,hiddens,tekId){
    //alert(tekId);
     $.get(
    file,
                params,
                function(datas){
                    alert(datas);
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
        dom: 'T<"clear">lfrtip',
        //"destroy": true,
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











function gettree(){
     $.get(
    "getTree_refs.php",
                {a:"a"},
                function(data){
                    //alert(data);
                    $('#treeRefs').empty();
                    $('#treeRefs').append(data);
                    //tree();
                    });
}

function cl(e){
    id = e.id.replace('e','');
    table =  'refTable';
    tablebody = 'refTableBody';
    hiddens =[0];
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