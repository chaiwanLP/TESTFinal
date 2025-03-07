<?php
declare(strict_types=1); 

unset($_SESSION['user_id']);
unset($_SESSION['timestamp']);
unset($_SESSION['email']);

echo '<script>alert("ออกจากระบบสำเร็จ"); window.location.href = "/";</script>';
exit;
?>
