<?php
include dirname(__DIR__) . "/database.php";
include dirname(__DIR__) . "/session.php";

// Khởi tạo Database
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_or_phone = mysqli_real_escape_string($db->link, $_POST['user_input']);
    $password = mysqli_real_escape_string($db->link, $_POST['user_password']);

    // Truy vấn kiểm tra user
    $query = "SELECT * FROM tbl_user WHERE user_email = '$email_or_phone' OR user_phone = '$email_or_phone' LIMIT 1";
    $result = $db->select($query);

    if ($result) {
        $user = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['user_pwd'])) {
            // Khởi tạo session
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            Session::set('user_login', true);
            Session::set('user_name', $user['user_name']);
            Session::set('user_id', $user['user_id']);
            Session::set('user_role', $user['user_role']);
            Session::set('user_gender', $user['user_gender']);
            Session::set('user_email', $user['user_email']);
            Session::set('user_phone', $user['user_phone']);
            Session::set('user_birth', $user['user_birth']);
            Session::set('user_address', $user['user_address']);
            // Điều hướng dựa trên vai trò
            if ($user['user_role'] == 'khach') {
                header("Location: /WebThoiTrang/user.php");
                exit();
            } else if ($user['user_role'] == 'admin') {
                header("Location: /WebThoiTrang/admin/userlist.php");
                exit();
            }
            else {
                header("Location: /WebThoiTrang/admin/cartegorylist.php");
                exit();
            }
        } else {
            echo "<script>alert('Mật khẩu không chính xác!'); window.location='/WebThoiTrang/login.php';</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại!'); window.location='/WebThoiTrang/login.php';</script>";
    }
}
?>