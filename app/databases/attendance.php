<?php
declare(strict_types=1);
function makeCheckin($user_id,$reg_id,$event_id){
    $conn = getConnection();
    $sql = 'INSERT INTO Attendance (user_id, reg_id, event_id) 
            VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $reg_id, $event_id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
function getRegId($user_id, $event_id): int {
    $conn = getConnection();
    $sql = "SELECT reg_id FROM Registration WHERE user_id = ? AND event_id = ? AND status='Approved'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $stmt->bind_result($reg_id);
    if ($stmt->fetch()) {
        return $reg_id;
    } else {
        return 0;
    }
    $stmt->close();
}
function checkinAlready($user_id, $event_id) :bool{
    $conn = getConnection();
    $sql = 'SELECT COUNT(*)  as count FROM Attendance WHERE user_id = ? AND event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count >= 1;
}


function checkUserExistInEvent($user_id,$event_id):stdClass|bool{
    $conn = getConnection();
    $sql = 'SELECT * FROM Registration,Users WHERE Registration.user_id=Users.user_id AND user_id=? AND event_id=?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $reg_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($row = $result->fetch_object()) {
        return $row; 
    } else {
        return false; 
    }
}

function getCheckedInCount($event_id) {
    $conn = getConnection();
    $sql = 'SELECT COUNT(DISTINCT user_id) as checked_in_count 
            FROM Attendance 
            WHERE event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->bind_result($checked_in_count);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result -> num_rows > 0){
        $row = $result->fetch_assoc();
        $checked_in_count = $row['checked_in_count'];
    }else{
        $checked_in_count = 0;
    }

    $stmt->close();
    $conn->close();

    return $checked_in_count;
}

function getNotCheckedInCount(int $event_id): int {
    $conn = getConnection();
    $sql = 'SELECT COUNT(DISTINCT Registration.user_id) as not_checked_in_count 
            FROM Registration 
            LEFT JOIN Attendance ON Registration.user_id = Attendance.user_id 
                AND Registration.event_id = Attendance.event_id 
            WHERE Registration.event_id = ? 
                AND Attendance.user_id IS NULL 
                AND Registration.status = "Approved"';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);


    $stmt->bind_result($not_checked_in_count);
    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $not_checked_in_count;
}