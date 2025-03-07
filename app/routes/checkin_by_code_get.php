<?php
declare(strict_types=1); 
$event_id = $_GET['event_id'];

renderView('checkin_by_code_get', array("event_id"=>$event_id));
