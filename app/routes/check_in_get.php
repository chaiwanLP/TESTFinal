<?php
declare(strict_types=1); 

if (isset($_GET['text_code_att']) && isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $text_code_att = $_GET['text_code_att'];
    $user_id=$_SESSION['user_id'];
    $reg_id=getRegId($user_id, $event_id);
    $event=getEventById($event_id);
    echo $event_id." ".$user_id;
    if(isMember($user_id,$event_id)){
        if(!checkinAlready($user_id, $event_id)){
            echo "hi";
            if($text_code_att==$event->text_code_att) {
                if(makeCheckin($user_id,$reg_id,$event_id)){
                    echo "<script>alert('เช็คชื่อเรียบร้อย'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
                } else{
                    echo "<script>alert('เช็คชื่อผิดพลาด'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
                }
            } else{
                echo "<script>alert('รหัสไม่ถูกต้อง ขอรหัสจากผู้สร้างกิจกรรม ภายในงาน'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
            }
        } else{
            echo "<script>alert('คุณเช็คชื่อไปแล้ว'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
        }
    } else{
        echo "<script>alert('คุณไม่ใช่สมาชิกของกิจกรรมนี้'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
    }
} else {
    echo "<script>alert('กรุณากรอกข้อมูล'); window.location.href = '/';</script>";
}
