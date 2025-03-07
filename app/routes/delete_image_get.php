<?php
declare(strict_types=1); 
$image_id = $_GET['image_id'] ?? '';
$event_id = $_GET['event_id'] ?? '';
echo "event id ".$event_id;


if(countPicture($event_id)>1){
    if(deleteImage($image_id)){
        echo "<script>alert('ลบรูปสำเร็จ'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
    } else{
        echo "<script>alert('ขัดข้อง'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";

    }

} else{

echo "<script>alert('ไม่สามารถลบรูปภาพได้ คุณมีรูปภาพเพียง 1 รูป'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";

}