


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
                   	$('#uAD').html(data['uAD']);
                   	$('#uITr').html(data['users']);
                   	$('#wStation').html(data['workstations']);
                   	$('#servers').html(data['servers']);
                    });

});