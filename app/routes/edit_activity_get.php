<?php
declare(strict_types=1); 
$user_id=$_SESSION['user_id'];
$event_id = $_GET['event_id'] ?? '';
$events = getEventById($event_id);
$result_organizer=getOrganizar($event_id);
$organizer_id=$result_organizer->user_id;

// echo $events->title;
if($user_id==$organizer_id){
    renderView('edit_activity_get',array('events' => $events));
}else{
    echo "<script>alert('คุณไม่ใช่เจ้าของกิจกรรมเข้าถึงไม่ได้'); window.location.href = '/';</script>";
    exit;
}