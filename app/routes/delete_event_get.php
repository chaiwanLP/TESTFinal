<?php
declare(strict_types=1); 
$user_id=$_SESSION['user_id'];
$event_id = $_GET['event_id'] ?? '';
$events = getEventById($event_id);
$result_organizer=getOrganizar($event_id);
$organizer_id=$result_organizer->user_id;
// echo "organizer".$organizer_id."user".$user_id;
// echo "event_id: " . $event_id;
// echo $events->title;
if($user_id==$organizer_id){
    if(deleteEvent($event_id)){
        echo "<script>alert('ลบกิจกรรมสำเร็จ'); window.location.href = '/';</script>";
    } else{
        echo "<script>alert('ลบกิจกรรมไม่สำเร็จ'); window.location.href = '/activity_detail_organizer?event_id=" . $event_id. "';</script>";
    }
}else{
    echo "<script>alert('คุณไม่ใช่เจ้าของกิจกรรมเข้าถึงไม่ได้'); window.location.href = '/';</script>";
    exit;
}