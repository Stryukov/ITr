
function getDeadSouls(){

    $('#deadSouls').dataTable({
     "aProcessing": true,
     "aServerSide": true,
     "ajax": "data/deadSouls.php",
        "searching": false,
        "pagingType": "simple",
        "ordering":  false,
        //"info":     false,
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Все"]],
        "dom": 'rt<"bottom"ip><"clear">',
        "language": {
            "loadingRecords": "<img style='margin-left: 350px' src='/itr/img/table.svg' width='50' alt=''>",
            "lengthMenu": ""
        }
     });  
     $('#deadSouls_info').css('float','left'); 
     $('#deadSouls_paginate').css({'float' : 'right', 'margin-top':'-35px'});

}

$(document).ready(function () {

//счетчик события    
        var clock;
        var currentDate = new Date();
        var futureDate  = new Date(2017, 01, 22, 23, 59, 59, 0);
        var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
        clock = $('.clock').FlipClock({
            clockFace: 'DailyCounter', //вид счетчика (с количеством дней)
            autoStart: false, //Отключаем автозапуск
            countdown: true , //Отсчет назад
            language:'ru-ru', //Локаль языка
            callbacks: { //Действие после окончания отсчета
            stop: function() {
                $('.clock-stop').addClass("alert alert-success");
                $('.clock-stop').html('Ну вот и настал тот час! Добро пожаловать в мир большого интернета!');
                }
               }
            });
          
            clock.setTime(diff); //Устанавливаем нужное время в секундах
            clock.setCountdown(true); //Устанавливаем отсчет назад
            clock.start(); //Запускаем отсчет    

//пользователей в AD    
         $.get(
            "data/counts.php",
                        {},
                        function(data){
                        	var data = JSON.parse(data);
                           	$('#uAD').html(data.counts[0].uAD);
                           	$('#uITr').html(data.counts[0].users);
                           	$('#wStation').html(data.counts[0].workstations);
                           	$('#servers').html(data.counts[0].servers);
                            $('#morris-kind-os').html('');
                            
                             Morris.Donut({ 
                                element: 'morris-kind-os',
                                data: data.os,
                                resize: true
                            });

                    });

         getDeadSouls();


});