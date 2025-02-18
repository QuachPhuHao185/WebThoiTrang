<?php
session_start();
include "header.php";
include 'admin/class/product_class.php';

// Tạo đối tượng product
$productObj = new product();

// Lấy danh sách product_id từ session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Giỏ hàng của bạn đang trống.</p>";
    include "footer.php";
    exit;
}

$product_ids = $_SESSION['cart'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$products = [];
foreach ($product_ids as $id) {
    $result = $productObj->get_product($id);
    if ($result) {
        $products[] = $result->fetch_assoc();
    }
}
?>
<!---------------------------- cart --------------------------->
<section class="cart">
    <div class="cart-container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart cart-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="cart-top-adress cart-top-item">
                    <i class="fas fa-map-marker-alt "></i>
                </div>
                <div class="cart-top-payment cart-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-container">
        <div class="cart-content row">
            <div class="cart-content-left">
                <table>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Mầu</th>
                        <th>Size</th>
                        <th>SL</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <?php if (!empty($product['product_img'])): ?>
                                <img src="admin/uploads/<?php echo $product['product_img']; ?>" alt="Ảnh chính của sản phẩm">
                            <?php else: ?>
                                <p>Không có ảnh chính.</p>
                            <?php endif; ?>
                        </td>
                        <td><p><?php echo htmlspecialchars($product['product_name']); ?></p></td>
                        <td><img src="images/sp1Color.jpg"></td>
                        <td><p>L</p></td>
                        <td><input name="soluong" type="number" value="1" min="1"></td>
                        <td><p><?php echo number_format($product['product_price'], 0, ',', '.'); ?> VND</p></td>
                        <td><a href="remove_from_cart.php?product_id=<?php echo $product['product_id']; ?>">X</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="cart-content-right">
                <table>
                    <tr>
                        <th colspan="2">Tổng Tiền Giỏ Hàng</th>
                    </tr>
                    <tr>
                        <td>Tổng Sản Phẩm</td>
                        <td><?php echo count($products); ?></td>
                    </tr>
                    <tr>
                        <td>Tổng Tiền Hàng</td>
                        <td>
                            <?php 
                                $total_price = array_sum(array_column($products, 'product_price'));
                                echo number_format($total_price, 0, ',', '.'); 
                            ?> VND
                        </td>
                    </tr>
                    <tr>
                        <td>Tạm Tính</td>
                        <td><p style="color: black;font-weight: bold;"><?php echo number_format($total_price, 0, ',', '.'); ?> VND</p></td>
                    </tr>
                </table>
                <div class="cart-content-right-text">
                    <p>Bạn sẽ được miễn phí ship khi đơn hàng có giá trị hơn 2.000.000đ</p>
                    <p style="color: red;font-weight: bold;"> Mua thêm để đươc miễn phí SHIP</p>
                </div>
                <div class="cart-content-right-button">
                    <button onclick="window.location.href='index.php'">TIẾP TỤC MUA SẮM</button>
                    <a href="delivery.php?product_ids=<?php echo urlencode(implode(',', $_SESSION['cart'])); ?>">
                        <button>THANH TOÁN</button>
                    </a>
                </div>
                <div class="cart-content-right-dangnhap">
                    <p>TÀI KHOẢN SHOP ICON</p>
                    <p>Hãy <a href="register.php">Đăng Ký</a> tài khoản của bạn nếu bạn chưa có.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
include "footer.php";
?>