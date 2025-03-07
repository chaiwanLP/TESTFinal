<?php
declare(strict_types=1); 
$user_id=$_SESSION['user_id'];
$event_id = $_GET['event_id'] ?? '';
$status ='Pending';

$date = new DateTime();

$result_organizer=getOrganizar($event_id);
$organizer_id=$result_organizer->user_id;

if($user_id!=$organizer_id){

    $event=getEventById($event_id);

    if(getParticipantCount($event_id)<$event->participant_amount){
        if (!checkExistRequest($user_id, $event_id)) { 

            if(!isMember($user_id,$event_id)){
                if (joinEvent($user_id, $event_id, $status, $date, $date)) {
                    echo "<script>alert('ส่งคำขอเข้าร่วมสำเร็จ รอผู้จัดกิจกรรมอนุมัติ'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
                }
            }else {

                echo "<script>alert('คุณเป็นสมาชิกอยู่แล้ว'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
            }

        } else {

            echo "<script>alert('คุณส่งคำขอไปแล้วโปรดรอเจ้าของกิจกรรมอนุมัติ'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
        }

    }else{
        echo "<script>alert('ผู้เข้าร่วมกิจกรรมเต็มแล้ว'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";

    }



}else{
    echo "<script>alert('คุณเป็นเจ้าของกิจกรรม'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
    exit;

}
