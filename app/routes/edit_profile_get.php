<?php
declare(strict_types=1);
$user_id = $_SESSION['user_id']; 
$user_info = getInfoUserById($user_id);

renderView('edit_profile_get',array("user_info"=>$user_info));