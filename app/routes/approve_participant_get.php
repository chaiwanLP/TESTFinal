<?php
declare(strict_types=1); 
$user_id = $_GET['user_id'] ?? '';
$event_id = $_GET['event_id'] ?? '';

$event=getEventById($event_id);

if(getParticipantCount($event_id)<$event->participant_amount){
    if(updateParticipantStatusToApproved($event_id, $user_id)){
        echo "<script>alert('รับคำขอเข้าร่วมสำเร็จ'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
    }
    renderView('activity_detail_get', array('event' => $event,"event_image" => $event_image));
}else{
    echo "<script>alert('ผู้เข้าร่วมกิจกรรมเต็มแล้ว'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";

}

?>
