<?php
declare(strict_types=1); 
$image = $_POST['activity-image'] ?? '';
$title = $_POST['activity-title'] ?? '';
$event_type = $_POST['event_type'] ?? '';

$description = $_POST['activity_description'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';
$time = $_POST['activity_time'] ?? '';
$participant_amount = (int)$_POST['participant_amount'] ?? '';
$location = $_POST['location'] ?? '';
$organizer_id = $_SESSION['user_id'];
$text_code_att = uniqid(); 
$start_date_obj = new DateTime($start_date);
$end_date_obj = new DateTime($end_date);
if ($end_date_obj >= $start_date_obj) {
    if($participant_amount!=0){
        if (!checkDuplicateTitle($title)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['activity-image'])) {
                $files = $_FILES['activity-image'];
                $valid_extensions = array("jpg", "png");
                if (insertEvent($title, $description, $event_type, $start_date, $end_date, $time, $participant_amount, $location, $organizer_id,$text_code_att)) {
                    echo "<script>alert('สร้างกิจกรรมสำเร็จ'); window.location.href = '/';</script>";
                }
                for ($i = 0; $i < count($files['name']); $i++) {
                    $timestamp = time();
                    $target_file = IMAGE_DIR . "/" . $timestamp."_".$i.basename($files["name"][$i]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
                    if (in_array($imageFileType, $valid_extensions)) {
                        if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
                            $profile_image_path = $target_file;
                            $event_id = getIdEventByTitle($title, $organizer_id);
                            $qr_code_att = "?text_code_att=" . urlencode($text_code_att) . "&event_id=" . $event_id;
                            updateQrCode($event_id,$qr_code_att);
                            insertImageEvent($event_id, $profile_image_path);
                            // echo $event_id;
                            // echo "The file has been uploaded and the path has been saved to the database.";
        
                            if (isset($profile_image_path) && file_exists($profile_image_path)) {
                                // echo "<img src='" . $profile_image_path . "' alt='Activity Image' />";
                            } else {
                                // echo "Image not available.";
                            }
                        } else {
                            echo "<script>alert('Sorry, only JPG, PNG  files are allowed.'); window.location.href = '/create_activity';</script>";
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "<script>alert('Sorry, only JPG, PNG  files are allowed.'); window.location.href = '/create_activity';</script>";
                    }
                }
            }
        } else {
            echo "<script>alert('มีชื่อกิจกรรมนี้แล้ว โปรดใส่ชื่อกิจกรรมใหม่'); window.location.href = '/create_activity';</script>";
        }
    }else if($participant_amount==0){
        echo "<script>alert('ผู้เข้าร่วมไม่สามารถเป็น 0 ได้'); window.location.href = '/create_activity';</script>";
    } else{
        echo "<script>alert('ข้อมูลผิด'); window.location.href = '/create_activity';</script>";
        // header('Location: /'); 
        exit; 
    }
}else {
    echo "<script>alert('วันเริ่มและวันสิ้นสุดไม่ถูกต้อง'); window.location.href = '/create_activity';</script>";
    exit;
}




?>