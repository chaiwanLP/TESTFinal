<?php
declare(strict_types=1);
function joinEvent($user_id, $event_id, $status, $register_date, $requested_at) {
    $register_date_str = $register_date->format('Y-m-d H:i:s'); 
    $requested_at_str = $requested_at->format('Y-m-d H:i:s'); 
    $conn = getConnection();
    $sql = 'INSERT INTO Registration (user_id, event_id, status, register_date, requested_at) 
            VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iisss', $user_id, $event_id, $status, $register_date_str, $requested_at_str);
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}
function getParticipant($event_id): mysqli_result|bool{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT Users.* 
                            FROM Registration,Users 
                            WHERE Users.user_id=Registration.user_id 
                            AND event_id=? 
                            AND Registration.status ='Approved';");
    $stmt->bind_param('i',$event_id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    return $result;
}
function getParticipantCount($event_id): int {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as count 
                            FROM Registration, Users 
                            WHERE Users.user_id = Registration.user_id 
                            AND event_id = ? 
                            AND Registration.status = 'Approved'");
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count']; 
    }
    return 0; 
}

function getFemaleParticipantscount($event_id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as count 
                            FROM Users, Registration 
                            WHERE Users.user_id = Registration.user_id 
                            AND event_id = ? 
                            AND Registration.status = 'Approved' 
                            AND gender = 'Female' ");
    $stmt->bind_param("i", $event_id); 
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $count;
}

function getMaleParticipantscount($event_id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as count 
                            FROM Users, Registration 
                            WHERE Users.user_id = Registration.user_id 
                            AND event_id = ? 
                            AND Registration.status = 'Approved' 
                            AND gender = 'Male' ");
    $stmt->bind_param("i", $event_id); 
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $count;
}



function getRequetedParticipants($event_id): mysqli_result{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT Users.* FROM Registration,Users WHERE Users.user_id=Registration.user_id AND event_id=? AND Registration.status ='Pending';");
    $stmt->bind_param('i',$event_id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    return $result;
}
function getRequetedParticipantsCount($event_id): int {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM Registration, Users WHERE Users.user_id = Registration.user_id AND event_id = ? AND Registration.status = 'Pending';");
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $stmt->bind_result($count); 
    $stmt->fetch(); 
    return $count;
}
function updateParticipantStatusToApproved($event_id, $user_id): bool { 
    $conn = getConnection();
    $stmt = $conn->prepare("
        UPDATE Registration 
        SET status = 'Approved', approved_at = NOW() 
        WHERE event_id = ? AND user_id = ? AND status = 'Pending'
    ");
    $stmt->bind_param('ii', $event_id, $user_id);
    return $stmt->execute();
}

function updateParticipantStatusToReject($user_id, $event_id): bool{
    $conn = getConnection();  
    $stmt = $conn->prepare("UPDATE Registration SET status = 'Rejected' WHERE user_id = ? AND event_id = ?");
    $stmt->bind_param('ii', $user_id, $event_id);
    return $stmt->execute();

    $stmt->close();
    $conn->close();
}
function getOrganizar($event_id) {
    $conn = getConnection();
    $sql = 'SELECT Users.* FROM Events, Users WHERE Events.organizer_id = Users.user_id AND Events.event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($row = $result->fetch_object()) {
        return $row; 
    } else {
        return null; 
    }
}
function checkExistRequest($user_id, $event_id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM Registration WHERE user_id = ? AND event_id = ? AND status = 'Pending'");
    $stmt->bind_param('ii', $user_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true; 
    } else {
        return false;  
    }
}
function isMember($user_id,$event_id){
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM Registration WHERE user_id = ? AND event_id = ? AND status = 'Approved'");
    $stmt->bind_param('ii', $user_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true; 
    } else {
        return false;  
    }
}
function getEventWithMostRegistrations(): stdClass|bool {
    $conn = getConnection();
    $stmt = $conn->prepare("
        SELECT 
            Events.event_id,
            Events.title,
            (SELECT image FROM Event_Images WHERE event_id = Events.event_id LIMIT 1) AS image
        FROM 
            Events
        LEFT JOIN 
            Registration ON Events.event_id = Registration.event_id
        GROUP BY 
            Events.event_id
        ORDER BY 
            COUNT(Registration.reg_id) DESC
        LIMIT 1;  -- แสดงกิจกรรมที่มีคนลงทะเบียนมากที่สุด
    ");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_object(); 
        return $row;
    } else {
        return false;  
    }
    $stmt->close();
    $conn->close();
}

// ฟังก์ชันดึงสถิติจำนวนผู้สมัครทั้งหมด
function get_total_count($event_id) {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as total_count FROM Registration WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_count = $row['total_count'];
    $stmt->close();
    $conn->close();

    return $total_count;
}

// ฟังก์ชันดึงสถิติจำนวนผู้สมัครเพศหญิง
function get_female_count($event_id) {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as female_count FROM Registration 
            JOIN Users ON Registration.user_id = Users.user_id 
            WHERE event_id = ? AND gender = 'Female'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $female_count = $row['female_count'];
    $stmt->close();
    $conn->close();

    return $female_count;
}

// ฟังก์ชันดึงสถิติจำนวนผู้สมัครเพศชาย
function get_male_count($event_id) {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as male_count FROM Registration 
            JOIN Users ON Registration.user_id = Users.user_id 
            WHERE event_id = ? AND gender = 'Male'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $male_count = $row['male_count'];
    $stmt->close();
    $conn->close();

    return $male_count;
}

// ฟังก์ชันดึงสถิติจำนวนผู้สมัครที่อนุมัติ
function get_approved_count($event_id) {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as approved_count FROM Registration 
            WHERE event_id = ? AND status = 'Approved'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $approved_count = $row['approved_count'];
    $stmt->close();
    $conn->close();

    return $approved_count;
}

// ฟังก์ชันดึงสถิติจำนวนผู้สมัครที่ปฏิเสธ
function get_rejected_count($event_id) {
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as rejected_count FROM Registration 
            WHERE event_id = ? AND status = 'Rejected'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $rejected_count = $row['rejected_count'];
    $stmt->close();
    $conn->close();

    return $rejected_count;
}

// ฟังก์ชันดึงสถิติช่วงอายุของผู้สมัคร
function get_age_stats($event_id) {
    $conn = getConnection();
    $age_stats = [];
    $sql = "SELECT 
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 6 AND 12 THEN '6 - 12 ปี'
                    WHEN TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 13 AND 19 THEN '13 - 19 ปี'
                    WHEN TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 20 AND 35 THEN '20 - 35 ปี'
                    WHEN TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 36 AND 55 THEN '36 - 55 ปี'
                    ELSE '56 ปีขึ้นไป'
                END AS age_group,
                COUNT(*) AS count
            FROM Registration 
            JOIN Users ON Registration.user_id = Users.user_id 
            WHERE event_id = ?
            GROUP BY age_group";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $age_stats[] = $row;
    }
    $stmt->close();
    $conn->close();

    return $age_stats;
}

function getParticipantAgecount($event_id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age 
                            FROM Users, Registration 
                            WHERE Users.user_id = Registration.user_id 
                            AND event_id = ? 
                            AND Registration.status = 'Approved'");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($age);

    $age_count = [
        '6-12' => 0,
        '13-19' => 0,
        '20-35' => 0,
        '36-55' => 0,
        '56+' => 0
    ];

    while ($stmt->fetch()) {
        if ($age >= 6 && $age <= 12) $age_count['6-12']++;
        elseif ($age >= 13 && $age <= 19) $age_count['13-19']++;
        elseif ($age >= 20 && $age <= 35) $age_count['20-35']++;
        elseif ($age >= 36 && $age <= 55) $age_count['36-55']++;
        else $age_count['56+']++;
    }

    $stmt->close();
    $conn->close();
    return $age_count;
}
?>
