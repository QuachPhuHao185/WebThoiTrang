<!-- <?php
// define("DB_HOST","localhost");
// define("DB_USER","root");
// define("DB_PASS","");
// define("DB_NAME","website_thoitrang_icon");
?> -->
<?php
// Kiểm tra xem hằng số đã được định nghĩa chưa trước khi định nghĩa lại
if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'website_thoitrang_icon');
}

if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost'); // Hoặc địa chỉ máy chủ của bạn
}
?>