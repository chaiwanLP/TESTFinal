<?php
declare(strict_types=1);
getConnection();

$user_id = $_SESSION['user_id'] ?? '';
$image_profile = trim($_POST['profile-img'] ?? '');
$username = trim($_POST['username'] ?? '');
$firstname = $_POST['first_name'] ?? '';
$lastname = $_POST['last_name'] ?? '';
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$birthday = trim($_POST['birthday'] ?? '');

$birthday_date = new DateTime($birthday);  
$current_date = new DateTime(); 
$age = $current_date->diff($birthday_date)->y; 

if($age<=10){
    echo '<script>alert("คุณอายุน้อยกว่า 10 ปี ไม่สามารถลงทะเบียนได้");window.location.href = "/profile";</script>';   
}else{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile-img'])) {
        $target_file = IMAGE_DIR ."/".basename($_FILES["profile-img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = array("jpg", "png");
        
        if (in_array($imageFileType, $valid_extensions)) {
        

            if (move_uploaded_file($_FILES["profile-img"]["tmp_name"], $target_file)) {
                $image_profile = $target_file;  
                echo $image_profile;
                echo $username;
                echo $user_id;
                if(updateUserProfile($user_id, $username, $image_profile, $firstname, $lastname, $email, $phone, $birthday)){
                    echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location.href = '/profile';</script>";
                }else{
                    echo "<script>alert('อัปเดตข้อมูลไม่สำเร็จ');";
                }
                echo "The file has been uploaded and the path has been saved to the database.";
                if (isset($image_profile) && file_exists($image_profile)) {
                    // echo "<img src='" . $image_profile . "' alt='Activity Image' />";
                    
                } else {
                    // echo "Image not available.";
                    echo '<script>alert("Image not available.");window.location.href = "/profile";</script>';
                }
            } else {
                echo '<script>alert("Sorry, there was an error uploading your file.");window.location.href = "/profile";</script>';
            }
        }else{
            if(updateUserProfileNoImage($user_id, $username, $firstname, $lastname, $email, $phone, $birthday)){
                echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location.href = '/profile';</script>";
            }else{
                echo "<script>alert('อัปเดตข้อมูลไม่สำเร็จ');";
            }
        }
    }
}


