<?php
declare(strict_types=1); 
getConnection();

$events = getEvent();
$recommend = getEventWithMostRegistrations();
if ($recommend) {
    renderView('home_get', array('events' => $events, "recommend" => $recommend));
} else {
    renderView('home_get', array('events' => $events));
}

