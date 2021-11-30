<?php
$meetings = get_posts(array(
    'post_type' => 'rdv',
    'numberposts' => -1,
));

$calendar_schedules = array();

foreach ($meetings as $meeting) {
    $date_start = get_post_meta( $meeting->ID, 'maclecustom', true );
    $date_start = strtotime( $date_start );
    $date_start = date('d/m/Y h:i
:s
', $date_start);
    
    $date_end = get_post_meta( $meeting->ID, 'maclecustom', true );
    $date_end = strtotime( $date_end );
    $date_end = date('d/m/Y h:i:s
', $date_end);

    $calendar_schedules[] = array(
        "id"=> $meeting->ID,
        "calendarId"=> '?????',
        "title"=> $meeting->post_title,
        "category"=>'time',
        "dueDateClass"=> '',
        "start"=> $date_start,
        "end" => $date_end
    );
}
?>