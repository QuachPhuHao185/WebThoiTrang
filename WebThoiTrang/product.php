<?php
session_start(); // Bắt đầu session nếu chưa bắt đầu

// Kết nối đến product_class.php để sử dụng các phương thức của class product
include 'header.php';
include 'admin/class/product_class.php';

// Tạo đối tượng product
$productObj = new product();

// Lấy `product_id` từ URL hoặc request
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Kiểm tra nếu session 'cart' chưa tồn tại, tạo mới
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Thêm product_id vào session 'cart'
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }

    // Điều hướng tới trang giỏ hàng
    header("Location: cart.php");
    exit();
}

if ($product_id) {
    // Lấy thông tin sản phẩm
    $product = $productObj->get_product($product_id)->fetch_assoc();

    // Lấy danh sách ảnh mô tả
    $product_images = $productObj->get_product_img_desc($product_id);
} else {
    die("Không tìm thấy sản phẩm.");
}
?>

<!---------------------------product-------------------------------->
<section class="product">
    <div class="product-container">
        <div class="product-top">
            <p>Trang Chủ</p><span> &#8594; </span><p> Nữ </p><span> &#8594; </span><p> Hàng Nữ Mới Về</p><span> &#8594; </span><p>  <?php echo htmlspecialchars($product['product_name']); ?> </p>
        </div>
        <div class="product-content">
            <div class="product-content-left">
                <div class="product-content-left-big-img">
                <?php if (!empty($product['product_img'])): ?>
                    <img src="admin/uploads/<?php echo $product['product_img']; ?>" alt="Ảnh chính của sản phẩm">
                <?php else: ?>
                    <p>Không có ảnh chính.</p>
                <?php endif; ?>
                </div>
                <div class="product-content-left-small-img">
                <?php if ($product_images): ?>
                    <?php while ($img = $product_images->fetch_assoc()): ?>
                        <img src="admin/uploads/<?php echo $img['product_img_desc']; ?>" alt="Ảnh mô tả">
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Không có ảnh mô tả.</p>
                <?php endif; ?>
                </div>
            </div>
            <div class="product-content-right">
                <div class="product-content-right-product-name">
                    <h1> <?php echo htmlspecialchars($product['product_name']); ?></h1>
                    <p>MSP: 76M8878</p>
                </div>
                <div class="product-content-right-product-price">
                    <p> Giá: <?php echo number_format($product['product_price'], 0, ',', '.'); ?> VND</p>
                </div>
                <div class="product-content-right-product-color">
                    <p><span>Màu Sắc</span>: Kẻ Xanh tím than</p>
                    <div class="product-content-right-product-color-img">
                        <img src="images/sp1Color.jpg">
                    </div>
                    <div class="product-content-right-product-size">
                        <p style="font-weight: bold;">Size</p>
                        <div class="size">
                            <span>S</span>
                            <span>M</span>
                            <span>L</span>
                            <span>XL</span>
                            <span>XXL</span>
                        </div>
                        <div class="quantity">
                            <p style="font-weight: bold;">Số lượng:</p>
                            <input type="number" min="0" value="1">
                            
                        </div>
                        <p style="color:red">Vui lòng chọn size</p>
                        <div class="product-content-right-product-button">
                        <form method="POST" action="product.php">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <button type="submit">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <p>MUA HÀNG</p>
                                </button>
                            </form>
                            <button><p>TÌM TẠI CỬA HÀNG</p></button>
                        </div>
                        <div class="product-content-right-product-icon">
                            <div class="product-content-right-product-icon-item">
                                <i class="fas fa-phone-alt"></i><p>Hotline</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fas fa-comments"></i><p>Comment</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fas fa-envelope"></i><p>Mail</p>
                            </div>
                        </div>
                        <div class="product-content-right-product-QR">
                            <img src="images/QRCode.png">
                        </div>
                        <div class="product-content-right-bottom">
                            <div class="product-content-right-bottom-top">
                                &#8744;
                            </div> 
                            <div class="product-content-right-bottom-content-big">
                                <div class="product-content-right-bottom-content-title">
                                    <div class="product-content-right-bottom-content-title-item gioithieu">
                                        <p> Giới thiệu</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-title-item chitiet">
                                        <p> Chi tiết</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-title-item baoquan">
                                        <p> Bảo quản</p>
                                    </div>
                                </div>
                                <div class="product-content-right-bottom-content">
                                    <div class="product-content-right-bottom-content-gioithieu">
                                        <p>Thiết kế nằm trong BST SAPPHIRE CHIC, lấy cảm hứng từ sắc xanh quý phái của đá Sapphire với những thiết kế công sở hiện đại, 
                                            ghi dấu ấn với tính thẩm mỹ cao và sự tinh tế qua các chi tiết tạo điểm nhấn mà không mất đi nét sang trọng vốn có.<br><br>
    
                                            Áo gile mang đến vẻ đẹp thanh lịch và hiện đại với thiết kế trẻ trung, thời thượng. Chất liệu vải Serge dệt vân chéo cao cấp không chỉ mềm mại mà còn bền bỉ, giữ được phom dáng chuẩn trong suốt thời gian dài sử dụng. 
                                            Họa tiết kẻ sọc tinh tế giúp chiếc áo gile trở nên nổi bật nhưng vẫn dễ phối đồ, tạo nên nhiều phong cách thời trang đa dạng.<br><br>
                                            
                                            Thiết kế gile không tay, dáng ôm vừa vặn, giúp tôn lên vẻ ngoài lịch sự, chuyên nghiệp mà vẫn năng động. 
                                            Bạn có thể phối áo gile kẻ Serge với áo sơ mi hoặc áo thun bên trong hay áo blazer bên ngoài để tạo nên bộ trang phục hoàn hảo cho công sở, sự kiện, hoặc dạo phố.<br><br>
    
                                            Hơn nữa, màu sắc trung tính và họa tiết kẻ tinh tế càng làm cho áo trở thành món đồ thời trang không thể thiếu trong tủ đồ của bạn.<br><br>                                       
                                            Thông tin mẫu:<br><br>                                      
                                            Chiều cao: 165 cm<br><br>                                     
                                            Cân nặng: 49 kg<br><br>                                       
                                            Số đo 3 vòng: 81-63-90 cm<br><br>                                        
                                            Mẫu mặc size S<br><br>
                                            Lưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-chitiet">
                                <p> Dòng sản phẩm Ladies;<br><br>
                                    Nhóm sản phẩm Áo khoác; <br><br>
                                    Cổ áo Cổ chữ V;<br><br>
                                    Tay áo Sát nách; <br><br>
                                    Kiểu dáng Eo; <br><br>
                                    Độ dài Ngang hông; <br><br>
                                    Họa tiết Kẻ; <br><br>
                                    Chất liệu Tuysi.
                                </p>
                                </div>
                                    <div class="product-content-right-bottom-content-baoquan">
                                        <p>Chi tiết bảo quản sản phẩm : <br><br>
    
                                            * Các sản phẩm thuộc dòng cao cấp (Senora) và áo khoác (dạ, tweed, lông, phao) chỉ giặt khô, tuyệt đối không giặt ướt.<br><br>
                                            
                                            * Vải dệt kim: sau khi giặt sản phẩm phải được phơi ngang tránh bai giãn.<br><br>
                                            
                                            * Vải voan, lụa, chiffon nên giặt bằng tay.<br><br>
                                            
                                            * Vải thô, tuytsi, kaki không có phối hay trang trí đá cườm thì có thể giặt máy.<br><br>
                                            
                                            * Vải thô, tuytsi, kaki có phối màu tương phản hay trang trí voan, lụa, đá cườm thì cần giặt tay.<br><br>
                                            
                                            * Đồ Jeans nên hạn chế giặt bằng máy giặt vì sẽ làm phai màu jeans. Nếu giặt thì nên lộn trái sản phẩm khi giặt, đóng khuy, kéo khóa, không nên giặt chung cùng đồ sáng màu, tránh dính màu vào các sản phẩm khác. <br><br>
                                            
                                            * Các sản phẩm cần được giặt ngay không ngâm tránh bị loang màu, phân biệt màu và loại vải để tránh trường hợp vải phai. Không nên giặt sản phẩm với xà phòng có chất tẩy mạnh, nên giặt cùng xà phòng pha loãng.<br><br>
                                            
                                            * Các sản phẩm có thể giặt bằng máy thì chỉ nên để chế độ giặt nhẹ, vắt mức trung bình và nên phân các loại sản phẩm cùng màu và cùng loại vải khi giặt.<br><br>
                                            
                                            * Nên phơi sản phẩm tại chỗ thoáng mát, tránh ánh nắng trực tiếp sẽ dễ bị phai bạc màu, nên làm khô quần áo bằng cách phơi ở những điểm gió sẽ giữ màu vải tốt hơn.<br><br>
                                            
                                            * Những chất vải 100% cotton, không nên phơi sản phẩm bằng mắc áo mà nên vắt ngang sản phẩm lên dây phơi để tránh tình trạng rạn vải.<br><br>
                                            
                                            * Khi ủi sản phẩm bằng bàn là và sử dụng chế độ hơi nước sẽ làm cho sản phẩm dễ ủi phẳng, mát và không bị cháy, giữ màu sản phẩm được đẹp và bền lâu hơn. Nhiệt độ của bàn là tùy theo từng loại vải. </p><br><br>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-related">
    <div class="product-related-title">
        <p>SẢN PHẨM LIÊN QUAN</p>
    </div>
    <div class="row product-content">
        <div class="product-related-item">
            <img src="images/sp2.webp" alt="">
            <h1>Áo Tweed kẻ Eagean</h1>
            <p>2.490.000đ</p>
        </div>
        <div class="product-related-item">
            <img src="images/sp3.webp" alt="">
            <h1>Áo Tweed kẻ Eagean</h1>
            <p>2.490.000đ</p>
        </div>
        <div class="product-related-item">
            <img src="images/sp4.webp" alt="">
            <h1>Áo Tweed kẻ Eagean</h1>
            <p>2.490.000đ</p>
        </div>
        <div class="product-related-item">
            <img src="images/sp5.webp" alt="">
            <h1>Áo Tweed kẻ Eagean</h1>
            <p>2.490.000đ</p>
        </div>
        <div class="product-related-item">
            <img src="images/sp6.webp" alt="">
            <h1>Áo Tweed kẻ Eagean</h1>
            <p>2.490.000đ</p>
        </div>
    </div>
</section>
<script src="javascript.js/productPanel.js"></script>
<?php 
include "footer.php";
?>