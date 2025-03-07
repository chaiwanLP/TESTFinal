<?php
declare(strict_types=1);
function insertImageEvent($event_id,$image){
    $conn = getConnection();
    $sql = 'INSERT INTO Event_Images (event_id, image) VALUES(?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss',$event_id,$image);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}
function getPathImageEvent(int $event_id): ?string {
    $conn = getConnection();
    $sql = "SELECT image FROM Events WHERE event_id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($image);
    if ($stmt->fetch()) {
        return $image;
    } else {
        return null; 
    }
}
function countPicture($event_id){
    $conn = getConnection();
    $sql = 'SELECT COUNT(*) as total FROM Event_Images WHERE event_id = ?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i',$event_id);
    $stmt->execute();
    $stmt->bind_result($total);
    if ($stmt->fetch()) {
        return $total;
    } else {
        return 0; 
    }
}
function deleteImage($image_id){
    $conn = getConnection();
    $sql = 'DELETE FROM Event_Images WHERE image_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i',$image_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}
