<?php
declare(strict_types=1);

$user_id = $_SESSION['user_id'];
$event_id = $_GET['event_id'] ?? '';

if (empty($event_id)) {
    echo "<script>alert('ไม่พบข้อมูลกิจกรรม'); window.location.href = '/';</script>";
    exit;
}

$event = getEventById($event_id);
$result_organizer = getOrganizar($event_id);

if ((!$event || !$result_organizer)) {
    echo "<script>alert('ไม่พบข้อมูลกิจกรรมหรือผู้จัดกิจกรรม'); window.location.href = '/';</script>";
    exit;
}

$organizer_id = $result_organizer->user_id;

$get_total = get_total_count($event_id);
$get_age = get_age_stats($event_id);  
$get_male = get_male_count($event_id);
$get_female = get_female_count($event_id);
$get_approved = get_approved_count($event_id);
$get_rejected = get_rejected_count($event_id);
$getParticipantCount = getParticipantCount($event_id);
$getMaleParticipantscount = getMaleParticipantscount($event_id);
$getFemaleParticipantscount = getFemaleParticipantscount($event_id);
$getCheckedInCount = getCheckedInCount($event_id);
$getNotCheckedInCount = $getParticipantCount - $getCheckedInCount;
$getParticipantAgecount = getParticipantAgecount($event_id);


if ($user_id == $organizer_id) {
    renderView('statistics_get',array('event' => $event, 
    'get_total' => $get_total, 
    'get_age' =>$get_age, 
    'get_male' => $get_male, 
    'get_female' => $get_female, 
    'get_approved' => $get_approved, 
    'get_rejected' => $get_rejected,  
    'getParticipantCount' => $getParticipantCount,
    'getMaleParticipantscount' => $getMaleParticipantscount,
    'getFemaleParticipantscount' => $getFemaleParticipantscount,
    'getParticipantAgecount' => $getParticipantAgecount,
    'getCheckedInCount' => $getCheckedInCount,
    'getNotCheckedInCount' => $getNotCheckedInCount
    )
    );
    

} else {
    echo "<script>alert('คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); window.location.href = '/';</script>";
    exit;
}
?>
