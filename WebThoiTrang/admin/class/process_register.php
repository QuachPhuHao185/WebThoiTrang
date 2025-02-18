<?php
include dirname(__DIR__) . "/database.php";
include dirname(__DIR__) . "/session.php";

// Khởi tạo Database
$db = new Database();

if (isset($_POST['register'])) {
    // Lấy dữ liệu từ form
    $name = mysqli_real_escape_string($db->link, $_POST['user_name']);
    $email = mysqli_real_escape_string($db->link, $_POST['user_email']);
    $phone = mysqli_real_escape_string($db->link, $_POST['user_phone']);
    $birth = mysqli_real_escape_string($db->link, $_POST['user_birth']);
    $gender = mysqli_real_escape_string($db->link, $_POST['user_gender']);
    $role = mysqli_real_escape_string($db->link, $_POST['user_role']);
    $address = mysqli_real_escape_string($db->link, $_POST['user_address']);
    $password = mysqli_real_escape_string($db->link, $_POST['user_pwd']);
    $repassword = mysqli_real_escape_string($db->link, $_POST['user_repwd']);

    // Kiểm tra mật khẩu khớp nhau
    if ($password !== $repassword) {
        echo "<script>alert('Mật khẩu nhập lại không khớp!');</script>";
    } else {
        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Tạo câu truy vấn INSERT
        $query = "INSERT INTO tbl_user (user_name, user_email, user_phone, user_birth, user_gender, user_address, user_role, user_pwd) 
          VALUES ('$name', '$email', '$phone', '$birth', '$gender', '$address', '$role' ,  '$hashedPassword')";

        // Thực thi truy vấn
        $insert = $db->insert($query);
        if ($insert) {
            echo "<script>alert('Đăng ký thành công!'); window.location='/WebThoiTrang/login.php';</script>";
        } else {
            echo "<script>alert('Đăng ký thất bại!');</script>";
        }
    }
}
?>