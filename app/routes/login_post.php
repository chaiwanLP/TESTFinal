<?php
declare(strict_types=1);

getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกอีเมลและรหัสผ่าน";
        header('Location: /login');
        exit;
    }
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['timestamp'] = time();

            echo '<script>alert("เข้าสู่ระบบสําเร็จ"); window.location.href = "/home";</script>';
            exit();
        } else {
            echo '<script>alert("อีเมลหรือรหัสผ่านไม่ถูกต้อง")</script>';
            renderView('login_get', ['error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
            exit;
        }
    } else {
        echo '<script>alert("ไม่พบบัญชีผู้ใช้")</script>';
        renderView('login_get');
        exit;
    }
    
    $stmt->close();
    $conn->close();
}