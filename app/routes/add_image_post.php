<?php
declare(strict_types=1);
$event_id = $_POST['event_id'];

    if (isset($_FILES['activity-image'])) {
        $files = $_FILES['activity-image'];
        $valid_extensions = array("jpg", "png");
        $fileCount = is_array($files['name']) ? count($files['name']) : 1;

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $files['name'][$i];
            $tmpName = $files['tmp_name'][$i];
            $timestamp = time();
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = "image_" . $timestamp . "_" . $i . basename($files["name"][$i]);
            $target_file = IMAGE_DIR . "/" . $newFileName;

            if (in_array($imageFileType, $valid_extensions)) {
                if (move_uploaded_file($tmpName, $target_file)) {
                    $profile_image_path = $target_file;
                    insertImageEvent($event_id, $profile_image_path);
                    // echo "The file has been uploaded and the path has been saved to the database.";
                    if (isset($profile_image_path) && file_exists($profile_image_path)) {
                        // echo "<img src='" . $profile_image_path . "' alt='Activity Image' />";
                        echo "<script>alert('เพิ่มรูปสำเร็จ'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
                    } else {
                        echo "<script>alert('Image not available.'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
                    }
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
                }
            } else {
                echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href = '/activity_detail?event_id=" . urlencode($event_id) . "';</script>";
            }
        }
    }

?>
