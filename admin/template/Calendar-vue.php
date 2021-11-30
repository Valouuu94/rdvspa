<?php
    $calendar_schedules = array(

        array(
            
            "id"=> '1',
            "calendarId"=> '1',
            "title"=> 'my schedule',
            "category"=>'time',
            "dueDateClass"=> '',
            "start"=> '2021-06-07T22:30:00+09:00',
            "end" =>'2021-06-19T02:30:00+09:00'
            
        ),

    ) ;
    var_dump($calendar_schedules);
    var_dump(json_encode($calendar_schedules));


?>

<h1> Calendrier</h1>
<body>
    <button onclick="calendar.prev();">Previous week</button>
    <button onclick="calendar.today();">Today</button>
    <button onclick="calendar.next();">Next week</button>
    <br>
    <div id="calendar" style="height: 100vh;"></div> 
</body>


<script>
var Calendar = tui.Calendar;
    var calendar = new Calendar('#calendar');

    calendar.createSchedules(<?php echo json_encode($calendar_schedules); ?>);
</script>

<style>
    .tui-full-calendar-today {
  background: #E1BEE7 !important;
}
</style>