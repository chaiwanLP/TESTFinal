<?php
declare(strict_types=1); 
$image = $_POST['profile_image'] ?? '';
$username = $_POST['username'] ?? ''; 
$prefix = $_POST['prefix'] ?? '';
$gender = $_POST['gender'] ?? '';
$firstname = $_POST['first_name'] ?? '';
$lastname = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$birthday = $_POST['birthday'] ?? '';
$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$birthday_date = new DateTime($birthday);  
$current_date = new DateTime(); 
$age = $current_date->diff($birthday_date)->y; 
if($age<=10){
    echo '<script>alert("คุณอายุน้อยกว่า 10 ปี ไม่สามารถลงทะเบียนได้");window.location.href = "/register";</script>';
} else{
    if(!checkExistUsername($username)){
        if(!checkExistEmail($email)){
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile-image'])) {
                $target_file = IMAGE_DIR ."/".basename($_FILES["profile-image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $valid_extensions = array("jpg", "png");
                
                if (in_array($imageFileType, $valid_extensions)) {
                    if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file)) {
                        $profile_image_path = $target_file;  
                        if(insertUser($prefix, $firstname, $lastname, $username, $hash, $email, $phone, $gender, $birthday, $profile_image_path)){
                            echo "<script>alert('ลงทะเบียนสำเร็จ'); window.location.href = '/login';</script>";;
                        }
                        // echo "The file has been uploaded and the path has been saved to the database.";
                        if (isset($profile_image_path) && file_exists($profile_image_path)) {
                            // echo "<img src='" . $profile_image_path . "' alt='Activity Image' />";
                        } else {
                            // echo "Image not available.";
                            echo '<script>alert("Image not available.");window.location.href = "/register";</script>';
                        }
                    } else {
                        echo '<script>alert("Sorry, there was an error uploading your file.");window.location.href = "/register";</script>';
                    }
                } else {
                    echo '<script>alert("Sorry, only JPG, PNG  files are allowed.");window.location.href = "/register";</script>';
                }
            }
        }
        else{  
            echo '<script>alert("มีผู้ใช้ใช้อีเมลนี้แล้ว โปรดป้อนอีเมลใหม่!!!");window.location.href = "/register";</script>';
        }
    }else{
        echo '<script>alert("มีชื่อผู้ใช้นี้แล้ว โปรดใส่ชื่อผู้ใช้ใหม่!!!");window.location.href = "/register";</script>';
    }
}


// echo "Username: " . $username . "<br>";
// echo "Prefix: " . $prefix . "<br>";
// echo "Gender: " . $gender . "<br>";
// echo "Firstname: " . $firstname . "<br>";
// echo "Lastname: " . $lastname . "<br>";
// echo "Hash: " . $hash . "<br>";
// echo "Email: " . $email . "<br>";
// echo "Phone: " . $phone . "<br>";
// echo "Birthday: " . $birthday . "<br>";
// echo "Profile Image: " . $profile_image . "<br>";

exit; 