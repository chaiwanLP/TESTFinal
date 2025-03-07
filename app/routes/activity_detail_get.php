<?php
declare(strict_types=1); 
$event_id = $_GET['event_id'] ?? '';
$event = getEventById($event_id);
$count_participants=getParticipantCount($event_id);
$organizer=getOrganizar($event_id);
$event_image=getImageByEventId($event_id);
$images = getImagAlleByEventId($event_id);
$participant=getParticipant($event_id);
$isMember=isMember($_SESSION['user_id'],$event_id);

if ($_SESSION['user_id'] == $organizer->user_id) {
    $requeted = getRequetedParticipants($event_id);
    $count_requeted = getRequetedParticipantsCount($event_id);
    renderView('activity_detail_organizer_get', array(
        'event' => $event,
        'event_image' => $event_image,
        'requeted' => $requeted,
        'count_requeted' => $count_requeted,
        'participant' => $participant,
        'count_participants' => $count_participants,
        'organizer' => $organizer,
        'images' => $images
    ));
} else {
    renderView('activity_detail_get', array(
        'event' => $event,
        'event_image' => $event_image,
        'organizer' => $organizer,
        'participant' => $participant,
        'count_participants' => $count_participants,
        'images' => $images,
        'isMember' => $isMember 
    ));
}


?>
