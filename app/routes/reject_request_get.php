<?php
declare(strict_types=1); 
$user_id = $_GET['user_id'] ?? '';
$event_id = $_GET['event_id'] ?? '';

if(updateParticipantStatusToReject($user_id,$event_id)){
    echo "<script>alert('ปฎิเสธสำเร็จ'); window.location.href = '/activity_detail?event_id=" . $event_id . "';</script>";
}   else{
    echo "<script>alert('ปฎิเสธผิดพลาด'); window.location.href = '/activity_detail?event_id=" . $event_id . "';</script>";
}
renderView('activity_detail_organizer_get', array('event' => $event,"event_image" => $event_image,"requeted"=> $requeted,"count_requeted"=>$count_requeted));
?>
