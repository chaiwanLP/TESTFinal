<?php
declare(strict_types=1); 
$user_id=$_SESSION['user_id'];

$user=getInfoUserById($user_id);

renderView('profile_get',array("user"=>$user));
