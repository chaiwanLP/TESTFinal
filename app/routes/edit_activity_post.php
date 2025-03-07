<?php
declare(strict_types=1); 
$user_id = $_SESSION['user_id'] ?? '';
$event_id = $_POST['event_id'] ?? '';
$title = $_POST['activity-title'] ?? '';
$event_types = $_POST['event_types'] ?? '';
// echo $event_types;

$description = $_POST['activity_description'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';
$time = $_POST['activity_time'] ?? '';
$participant_amount = (int)$_POST['participant_amount'] ?? '';
$location = $_POST['location'] ?? '';

// echo "Image: " . $event_id . "<br>";

// echo "Title: " . $title . "<br>";
// echo "Event Type: " . $event_types . "<br>";
// echo "Description: " . $description . "<br>";
// echo "Start Date: " . $start_date . "<br>";
// echo "End Date: " . $end_date . "<br>";
// echo "Time: " . $time . "<br>";
// echo "Participant Amount: " . $participant_amount . "<br>";
// echo "Location: " . $location . "<br>";

$start_date_obj = new DateTime($start_date);
$end_date_obj = new DateTime($end_date);
if ($end_date_obj >= $start_date_obj) {
    if(getParticipantCount($event_id)<$participant_amount){
        if(updateEvent($event_id, $title, $description, $event_types, $participant_amount, $start_date, $end_date, $time, $location)){
            echo "<script>alert('อัพเดตเรียบร้อย'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
        } else{
            echo "<script>alert('ไม่สามารถอัพเดต'); window.location.href = '/edit_activity?event_id=" . urlencode($event_id) . "';</script>";
        }
    }else{
        echo "<script>alert('ไม่สามารถอัพเดตได้ จำนวนผู้เข้าร่วมตอนนี้มากกว่าที่ป้อนเข้ามา'); window.location.href = '/edit_activity?event_id=" . urlencode($event_id) . "';</script>";
    }
}else {
    echo "<script>alert('วันเริ่มและวันสิ้นสุดไม่ถูกต้อง'); window.location.href ='/edit_activity?event_id=" . urlencode($event_id) . "';</script>";
}



?>