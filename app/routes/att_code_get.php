<?php
declare(strict_types=1); 
$event_id = $_GET['event_id'];
$event=getEventById($event_id);

renderView('att_code_get', array("event"=>$event));
