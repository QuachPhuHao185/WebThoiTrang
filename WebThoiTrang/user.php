<?php 
include "header.php";
include "admin/session.php";
session_start();
if (!Session::get('user_login')) {
    header("Location: /WebThoiTrang/login.php");
    exit();
}

// Lấy thông tin từ session
$user_name = Session::get('user_name');
$user_id = Session::get('user_id');
$user_role = Session::get('user_role');
$user_email = Session::get('user_email');
$user_phone = Session::get('user_phone');
$user_birth = Session::get('user_birth');
$user_address = Session::get('user_address');
$user_gender = Session::get('user_gender');
?>
<section id="slider">
<div class="profile-container">
    <br><br><br><br><br><br><br><br><br>
        <h1>Chào mừng, <?php echo htmlspecialchars($user_name); ?>!</h1><br>
        <p>Mã người dùng: <?php echo htmlspecialchars($user_id); ?></p>
        <p>Vai trò: <?php echo htmlspecialchars($user_role); ?></p>
        <p>Email: <?php echo htmlspecialchars($user_email); ?></p>
        <p>Giới tính: <?php echo htmlspecialchars($user_gender); ?></p>
        <p>Số Điện thoại: <?php echo htmlspecialchars($user_phone); ?></p>
        <p>Ngày tháng năm sinh: <?php echo htmlspecialchars($user_birth); ?></p>
        <p>Địa chỉ: <?php echo htmlspecialchars($user_address); ?></p><br>
    <?php if ($user_role === 'nhanvien') : ?>
        <p><a href="admin/cartegorylist.php">Quản lý hệ thống dưới dạng nhân viên</a></p>
    <?php endif; ?>
    <?php if ($user_role === 'admin') : ?>
        <p><a href="admin/userlist.php">Quản lý hệ thống dưới dạng quản lý</a></p>
    <?php endif; ?>
        <a href="logout.php">Đăng xuất</a> <!-- Đường dẫn tới trang xử lý đăng xuất -->
    <br><br><br><br>
<div class="aspect-ratio-169">
    <img src="images/slide1.jpg">
    <img src="images/slide2.jpg">
    <img src="images/slide3.jpg">
    <img src="images/slide4.jpg">
</div>
<div class="dot-container">
    <div class="dot active"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
</div>
</section>

<script src="javascript.js/header-scroll.js"></script>
<script src="javascript.js/slider.js"></script>
<?php 
include "footer.php";
?>