<?php
declare(strict_types=1);
function insertEnrollment(string $course_id,string $student_id): bool{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO enrollment (student_id, course_id) VALUES (?, ?)");
    $stmt->bind_param("ss", $student_id, $course_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function checkExistUsername($username): bool{
    $conn = getConnection();
    $sql = 'SELECT COUNT(*) AS count FROM Users WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count>0;
}
function checkExistEmail($email): bool{
    $conn = getConnection();
    $sql = 'SELECT COUNT(*) AS count FROM Users WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count>0;
}
function insertUser($prefix, $firstname, $lastname, $username, $hash, $email, $phone, $gender, $birthday, $profile_image) {
    $birthday_date = new DateTime($birthday);
    $current_date = new DateTime();
    $age = $current_date->diff($birthday_date)->y; 

    $conn = getConnection();
    $sql = 'INSERT INTO Users (prefix, firstname, lastname, username, password, email, phone, gender, birthday, profile_image, age) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

    // เตรียมคำสั่ง SQL และผูกค่าพารามิเตอร์
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssssi', $prefix, $firstname, $lastname, $username, $hash, $email, $phone, $gender, $birthday, $profile_image, $age);
    $stmt->execute();

    // คืนค่าผลลัพธ์
    return $stmt->affected_rows > 0;
}


function getInfoUserById($user_id):stdClass|null{
    $conn = getConnection();
    $sql = 'SELECT * FROM Users WHERE user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($row = $result->fetch_object()) {
        return $row; 
    } else {
        return null; 
    }
}

function updateUserProfile($user_id, $username, $image_profile, $firstname, $lastname, $email, $phone, $birthday):bool {
    $conn = getConnection();
    $sql_update = "UPDATE Users SET profile_image = ?, username = ?, firstname = ?, lastname = ?, email = ?, phone = ?, birthday = ? WHERE user_id = ? ";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssssi", $image_profile, $username, $firstname, $lastname, $email, $phone, $birthday, $user_id);
    $stmt_update->execute();

    if ($stmt_update->affected_rows > 0) {
        return true;
    }else{
        return false;
    }
    $stmt_check->close();
    $stmt_update->close();
    $conn->close();
}

function updateUserProfileNoImage($user_id, $username, $firstname, $lastname, $email, $phone, $birthday):bool {
    $conn = getConnection();
    $sql_update = "UPDATE Users SET  username = ?, firstname = ?, lastname = ?, email = ?, phone = ?, birthday = ? WHERE user_id = ? ";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssssi", $username, $firstname, $lastname, $email, $phone, $birthday, $user_id);
    $stmt_update->execute();

    if ($stmt_update->affected_rows > 0) {
        return true;
    }else{
        return false;
    }
    $stmt_check->close();
    $stmt_update->close();
    $conn->close();
}

