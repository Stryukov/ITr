function test (){
    console.log(getSelectedIds("dataTables-example","Browser"));
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



function format(item) { return '('+item.id+') '+item.tag; }
function formattext(item) { return item.tag; }
function redata(){
    
    $("#remote").select2("destroy");
    var data = [
        { tag: "Western2", children: [
            { id: "1", tag: "California2" },
            { id: "2", tag: "Arizona2" }
        ] },
        { tag: "Eastern2", children: [
            { id: "3", tag: "Florida2" }
        ] }
    ];
    
   $("#remote").select2({
data:{ results: data,text: 'tag' },
formatSelection: format,
formatResult: formattext,
 placeholder: "Справочник",
allowClear: true
}); 
  
  content = "<img src='img/cancel.png'></img>"
  $('#body').append(content);
    
}




$(document).ready(function () {
    $('#ftoogle').click(function (){
$('#filtr').fadeToggle();

    });
    $('#equipment').addClass('active');
    $('#reestr').addClass('active');
  
   // $('#dataTables-example').dataTable();
	 $('#dataTables-example').dataTable( {
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sRowSelect": "os",
            "aButtons": [ "select_all", "select_none" ]
        }
    } );
     
     
     
/*           $('#dataTables-example tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
           console.log(getSelectedIds("dataTables-example","Browser"));
    } );
*/    
$("#redata").click(function() { redata(); })    
$('#example1').datepicker({
 changeMonth: true,
changeYear: true
 }); 

$('#example1').datepicker( "option", "dateFormat", "dd.mm.yy" );
                ////////////////////////////////////////////////////////////////////  
 var data = {};
 
$("#remote").select2({
data:{ results: data, text: 'tag' },
formatSelection: format,
formatResult: format,
 placeholder: "Справочник",
allowClear: true
});
////////////////////////////////////////////////////////////////

    });