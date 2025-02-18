<?php
// Kết nối đến product_class.php để sử dụng các phương thức của class product
include 'header.php';
include 'admin/class/product_class.php';
include 'admin/session.php';
include 'admin/database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra đăng nhập
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== true) {
    echo "<script>alert('Bạn cần đăng nhập để tiếp tục!'); window.location='/WebThoiTrang/login.php';</script>";
    exit;
}
// Lấy thông tin user_id từ session
$user_id = Session::get('user_id');

// Tạo đối tượng product
$productObj = new product();

// Lấy product_ids từ URL
$product_ids = isset($_GET['product_ids']) ? explode(',', $_GET['product_ids']) : [];

// Lấy thông tin sản phẩm
$products = [];
foreach ($product_ids as $id) {
    $result = $productObj->get_product($id);
    if ($result) {
        $products[] = $result->fetch_assoc();
    }
}

// Initialize VAT and total
$vat = 0;
$total = 0;
foreach ($products as $product) {
    $vat += $product['product_price_new'] * 0.1;
    $total += $product['product_price_new'];
}

$tongtien = $total + $vat;

// Xử lý lưu vào cơ sở dữ liệu khi nhấn nút "THANH TOÁN VÀ GIAO HÀNG"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();

    foreach ($product_ids as $product_id) {
        // Kiểm tra nếu sản phẩm đã tồn tại trong tbl_user_cart
        $query_check = "SELECT * FROM tbl_user_cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $check_result = $db->select($query_check);

        if (!$check_result) {
            // Thêm sản phẩm mới vào giỏ hàng của người dùng
            $query_insert = "INSERT INTO tbl_user_cart (user_id, product_id) VALUES ('$user_id', '$product_id')";
            $db->insert($query_insert);
        }
    }

    // Chuyển hướng đến trang payment.php
    header("Location: payment.php");
    exit;
}
?>
<!---------------------------- delivery --------------------------->

<section class="delivery">
    <div class="delivery-container">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-cart delivery-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="delivery-top-adress delivery-top-item">
                    <i class="fas fa-map-marker-alt "></i>
                </div>
                <div class="delivery-top-payment delivery-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="delivery-container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <p>Vui lòng chọn địa chỉ giao hàng hiện tại của bạn nếu địa chi khi đăng ký không còn đúng</p>
                <div class="delivery-content-left-dangnhap row">
                    <i class="fas fa-sign-in-alt"></i>
                    <p>Hệ thống sử dụng địa chỉ trong tài khoản bạn để giao hàng.</p>
                </div>
                <div class="delivery-content-left-khachle row">
                    <input name="loaikhach" type="radio" value="khachle" checked>
                    <p><b>Địa chỉ hiện tại là đủ</b> (bạn không cần điền thông tin bên dưới.)</p>
                </div>
                <div class="delivery-content-left-dangky row">
                    <input name="loaikhach" type="radio">
                    <p><b>Nhập địa chỉ mới</b> (Nhập thông tin bên dưới.)</p>
                </div>
                <div class="delivery-content-left-input-top row">
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Họ tên <span style="color:red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Điện thoại <span style="color:red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Tỉnh/Tp <span style="color:red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Quận/Huyện <span style="color:red;">*</span></label>
                        <input type="text">
                    </div>
                </div>
                <div class="delivery-content-left-input-bottom">
                    <label for="">Địa chỉ <span style="color:red;">*</span></label>
                    <input type="text">
                </div>
                <div class="delivery-content-left-btn row">
                    <a href="cart.php"><p>&#171; Quay lại giỏ hàng</p></a>
                    <!-- Nút thanh toán và giao hàng -->
                    <form method="POST" action="">
                        <button type="submit" style="font-weight: bold;">THANH TOÁN VÀ GIAO HÀNG</button>
                    </form>
                </div>
            </div>
            <div class="delivery-content-right">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Số lượng</th>
                        <th>Thành tiền sau giảm giá</th>
                    </tr>

                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td><?php echo number_format($product['product_price'], 0, ',', '.'); ?> VND</td>
                        <td>1</td>
                        <td><?php echo number_format($product['product_price_new'], 0, ',', '.'); ?> VND</td>
                    </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td style="font-weight: bold;" colspan="3"><b>Tổng</b></td>
                        <td style="font-weight: bold;"><?php echo number_format($total, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3"><b>Thuế VAT</b></td>
                        <td style="font-weight: bold;"><?php echo number_format($vat, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3"><b>Tổng tiền hàng</b></td>
                        <td style="font-weight: bold;"><?php echo number_format($tongtien, 0, ',', '.'); ?> VND</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>