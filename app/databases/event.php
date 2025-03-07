<?php
declare(strict_types=1);
function getEvent(): mysqli_result|bool {
    $conn = getConnection();
    $stmt = $conn->prepare("
        SELECT 
            Events.event_id, 
            Events.title, 
            Events.description, 
            Events.event_types, 
            Events.participant_amount, 
            Events.start_date, 
            Events.end_date, 
            Events.time, 
            Events.location, 
            Events.organizer_id,
            (SELECT image FROM Event_Images WHERE event_id = Events.event_id LIMIT 1) AS image
        FROM 
            Events
    ");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function insertEvent(  
    string $title,
    string $description,
    string $event_types,
    string $start_date,
    string $end_date,
    string $time,
    int $participant_amount,
    string $location,
    int $organizer_id,
    string $text_code_att
): bool {
    $conn = getConnection();
    $sql = 'INSERT INTO Events (title, description, event_types, start_date, end_date, time, participant_amount, location, organizer_id, text_code_att) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssisss', $title, $description, $event_types, $start_date, $end_date, $time, $participant_amount, $location, $organizer_id, $text_code_att);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
function updateQrCode($event_id,$qr_code_att):bool{
    $conn = getConnection();
    $sql = 'UPDATE Events SET qr_code_att = ? WHERE event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $qr_code_att,$event_id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
function getIdEventByTitle(string $title, int $organizer_id): int {
    $conn = getConnection();
    $sql = 'SELECT event_id FROM Events WHERE title = ? AND organizer_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $title, $organizer_id);
    $stmt->execute();
    $stmt->bind_result($result_event_id);
    if ($stmt->fetch()) {
        return $result_event_id;
    } else {
        return 0; 
    }
    $stmt->close();
    $conn->close();
}
function  checkDuplicateTitle($title):bool{
    $conn = getConnection();
    $sql = 'SELECT COUNT(*) AS count FROM Events WHERE title = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $title);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count>0;
}
function getEventById($event_id): stdClass|null {
    $conn = getConnection();
    $sql = 'SELECT * FROM Events WHERE event_id = ?';
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
function getImageByEventId($event_id): stdClass|null{
    $conn = getConnection();
    $sql = 'SELECT * FROM Event_Images WHERE event_id = ?';
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
function getImagAlleByEventId($event_id):  mysqli_result|bool {
    $conn = getConnection();
    $sql = 'SELECT * FROM Event_Images WHERE event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    return $result;
}
function searchEventByTitle($search_title): mysqli_result|array {
    $search_title = trim($search_title);
    if (empty($search_title)) {
        return []; 
    }
    $conn = getConnection();
    $stmt = $conn->prepare("
        SELECT DISTINCT  
    Events.event_id, 
    Events.title,
    Events.description,
    Events.event_types,
    Events.participant_amount,
    Events.start_date,
    Events.end_date,
    Events.time,
    Events.location,
    Events.organizer_id,
    (SELECT image FROM Event_Images WHERE event_id = Events.event_id LIMIT 1) AS image
FROM Events
WHERE Events.title LIKE ?

");
// INNER JOIN Event_Images ON Events.event_id = Event_Images.event_id
    $search_term = "%" . $search_title . "%"; 
    $stmt->bind_param('s', $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result; 
    } else {
        return $result;
    }
    $stmt->close();
    $conn->close();
}
function searchEventByTypes($types): mysqli_result|array {
    $conn = getConnection();
    $stmt = $conn->prepare("
        SELECT DISTINCT  
            Events.event_id, 
            Events.title,
            Events.description,
            Events.event_types,
            Events.participant_amount,
            Events.start_date,
            Events.end_date,
            Events.time,
            Events.location,
            Events.organizer_id,
            (SELECT image FROM Event_Images WHERE event_id = Events.event_id LIMIT 1) AS image
        FROM Events
        WHERE Events.event_types LIKE ?
        ");
        // INNER JOIN Event_Images ON Events.event_id = Event_Images.event_id
    $stmt->bind_param('s', $types); 
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result; 
    } else {
        return $result;
    }
    $stmt->close();
    $conn->close();
}
function searchEventByTitleAndType($search_title, $search_type): mysqli_result|bool { 
    $search_title = trim($search_title);
    $search_type = trim($search_type);
    $conn = getConnection();
    $sql = "
        SELECT 
            Events.event_id, 
            Events.title,
            Events.description,
            Events.event_types,
            Events.participant_amount,
            Events.start_date,
            Events.end_date,
            Events.time,
            Events.location,
            Events.organizer_id,
            (SELECT image FROM Event_Images WHERE event_id = Events.event_id LIMIT 1) AS image 
        FROM Events
        WHERE 1=1"; 
    $params = [];

    if (!empty($search_title)) {
        $sql .= " AND Events.title LIKE ?";
        $params[] = "%" . $search_title . "%"; 
    }

    if (!empty($search_type)) {
        $sql .= " AND Events.event_types LIKE ?";
        $params[] = "%" . $search_type . "%"; 
    }
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param(str_repeat('s', count($params)), ...$params); 
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result;  
    } else {
        return $result;
    }
    $stmt->close();
    $conn->close();
}
function updateEvent($event_id, $title, $description, $event_types, $participant_amount, $start_date, $end_date, $time, $location){ 
    $conn = getConnection();

    $sql = 'UPDATE Events SET 
                    title = ?, 
                    description = ?, 
                    event_types = ?, 
                    participant_amount = ?, 
                    start_date = ?, 
                    end_date = ?, 
                    time = ?, 
                    location = ?
                WHERE event_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssissssi', $title, $description, $event_types, $participant_amount, $start_date, $end_date, $time, $location, $event_id);
    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $result; 
}
function searchByTime($start_date, $end_date) {
    $conn = getConnection();
    $query = "
       SELECT DISTINCT
    Events.event_id, 
    Events.title, 
    Events.description, 
    Events.event_types, 
    Events.participant_amount, 
    Events.start_date, 
    Events.end_date, 
    Events.time, 
    Events.location, 
    Events.organizer_id,
    (SELECT image FROM Event_Images WHERE event_id = Events.event_id LIMIT 1) AS image
FROM 
    Events
    WHERE (Events.start_date BETWEEN ? AND ?) OR (Events.end_date BETWEEN ? AND ?)
    ";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        return false;
    }
    $stmt->bind_param('ssss', $start_date, $end_date, $start_date, $end_date); 
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
// LEFT JOIN Event_Images ON Events.event_id = Event_Images.event_id

function deleteEvent($event_id){
    
    $conn = getConnection();
    $sql = 'DELETE FROM Events WHERE event_id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
