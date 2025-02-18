<?php
include "admin/session.php";

// Khởi động session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Hủy session
Session::destroy();

// Chuyển hướng về trang đăng nhập
header("Location: login.php");
exit();
?>