<?php 
require_once('admin/database.php');
    $db =new Database;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Shop Thời Trang Hiện Đại</title>
</head>
<body>
    <header>
    <div class="logoShop"><h2><i>Shop thời trang ICON</i></h2></div>
    <div class="headerMenu">
    <?php 
$tbltable = "tbl_cartegory";  // Tên bảng trong CSDL
$data = $db->select("SELECT * FROM $tbltable");

foreach($data as $dt) {
    echo '<li><a href="category.php?cartegory_id=' . $dt['cartegory_id'] . '">' . $dt['cartegory_name'] . '</a>';
    
    // Lấy dữ liệu từ bảng tbl_brand cho sub-menu
    $tbltable2 = "tbl_brand";
    $query = "SELECT * FROM $tbltable2 WHERE cartegory_id = " . $dt['cartegory_id']; 
    $data2 = $db->select($query); // Lọc theo category_id

    // Kiểm tra kết quả truy vấn
    if ($data2 === false) {
        // Nếu truy vấn bị lỗi, hiển thị lỗi SQL
        echo "Error in query: " . $query;
    } else {
        // Chuyển đổi mysqli_result thành mảng
        $data2_array = [];
        while ($row = $data2->fetch_assoc()) {
            $data2_array[] = $row;
        }

        if (count($data2_array) > 0) {
            echo '<ul class="sub-headerMenu">';
            foreach($data2_array as $dt2) {
                echo '<li><a href="category.php?cartegory_id=' . $dt['cartegory_id'] . '&brand_id=' . $dt2['brand_id'] . '">' . $dt2['brand_name'] . '</a></li>';
            }
            echo '</ul>';
        }
    }
    echo '</li>';
}
?>
<li><a href="info.php">THÔNG TIN</a></li>
    </div>
        <div class="headerOther">
            <li><input type="text" placeholder="Tìm Kiếm"> <i class="fa-solid fa-magnifying-glass"></i></li>
            <li><a class="fa fa-user" href="user.php"></a></li>
            <li><a class="fa fa-right-to-bracket" href="login.php"></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
            <li><a class="fa-regular fa-message" href="mailto:1851010037hao@ou.edu.vn"></a></li>
        </div>
</header>