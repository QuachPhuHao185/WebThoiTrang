<?php 
include "header.php"; // Thêm include cho header
$cartegory_id = isset($_GET['cartegory_id']) ? $_GET['cartegory_id'] : null;
$brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] : null;

// Lấy cartegory_name từ cơ sở dữ liệu
$cartegory_name = "Danh mục không hợp lệ";
if ($cartegory_id !== null) {
    $query = "SELECT cartegory_name FROM tbl_cartegory WHERE cartegory_id = $cartegory_id";
    $result = $db->select($query);

    if ($result !== false) {
        $cartegory_name = $result->fetch_assoc()['cartegory_name'];
    }
}

// Lấy brand_name từ cơ sở dữ liệu
$brand_name = '';
if ($brand_id !== null) {
    $query = "SELECT brand_name FROM tbl_brand WHERE brand_id = $brand_id";
    $result = $db->select($query);

    if ($result !== false) {
        $brand_name = $result->fetch_assoc()['brand_name'];
    }
}

// Lấy sản phẩm theo category_id và brand_id
$product_query = "SELECT * FROM tbl_product WHERE cartegory_id = $cartegory_id";
if ($brand_id !== null) {
    $product_query .= " AND brand_id = $brand_id";
}
$product_query .= " ORDER BY product_id DESC";
$products = $db->select($product_query);
?>
<!-----------------------------------Category--------------------------->
<section class="category">
    <div class="category-container">
        <div class="category-top">
            <p><a href="index.php">Trang Chủ</a></p><span> &#8594; </span>
            <p><?php echo htmlspecialchars($cartegory_name); ?></p><span> &#8594; </span>
            <p><?php echo htmlspecialchars($brand_name); ?></p>
        </div>
    </div>
    <div class="category-container">
        <div class="row">
            <div class="category-left">
                <ul>
                <?php 
        $tbltable = "tbl_cartegory"; // Tên bảng trong CSDL
        $categories = $db->select("SELECT * FROM $tbltable");

        if ($categories) {
            foreach($categories as $category) {
                echo '<li class="category-left-li"><a href="category.php?cartegory_id=' . $category['cartegory_id'] . '">' . $category['cartegory_name'] . '</a>';

                // Lấy danh sách thương hiệu theo danh mục
                $tbltable2 = "tbl_brand";
                $query = "SELECT * FROM $tbltable2 WHERE cartegory_id = " . $category['cartegory_id'];
                $brands = $db->select($query);

                if ($brands && $brands->num_rows > 0) {
                    echo '<ul>';
                    while ($brand = $brands->fetch_assoc()) {
                        echo '<li><a href="category.php?cartegory_id=' . $category['cartegory_id'] . '&brand_id=' . $brand['brand_id'] . '">' . $brand['brand_name'] . '</a></li>';
                    }
                    echo '</ul>';
                }

                    echo '</li>';
                }
            } else {
                echo '<li>Không có danh mục nào.</li>';
                }
                ?>
                </ul>
            </div>
            <div class="category-right">
                <div class="category-right-Top">
                    <div class="category-right-Top-item">
                        <p>Hàng Nữ Mới Về</p>
                    </div>
                    <div class="category-right-Top-item">
                        <button><span>Bộ Lọc</span><i class="fas fa-sort-down"></i></button>
                    </div>
                    <div class="category-right-Top-item">
                        <select name="" id="">
                            <option value="">Sắp Xếp</option>
                            <option value="">Giá Cao Đến Thấp</option>
                            <option value="">Giá Thấp Đến Cao</option>
                        </select>
                    </div>
                </div>
                <div class="category-right-content row">
                    <?php 
                    if ($products) {
                        foreach ($products as $product) {
                    ?>
                        <div class="category-right-content-item">
                            <a href="product.php?product_id=<?php echo $product['product_id']; ?>">
                                <img src="admin/uploads/<?php echo $product['product_img']; ?>" alt="">
                            </a>
                            <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
                            <p><?php echo number_format($product['product_price'], 0, ',', '.'); ?>đ</p>
                        </div>
                    <?php 
                        }
                    } else {
                        echo "<p>Không có sản phẩm nào trong danh mục này.</p>";
                    }
                    ?>
                </div>
                <div class="category-right-bottom">
                    <!-- <div class="category-right-bottom-item">
                        <p>Hiển Thị 2 <span>|</span> 4 sản phẩm</p>
                    </div>
                    <div class="category-right-bottom-item">
                        <p><span>&#171;</span> 1 2 3 4 5 <spam>&#187;</spam> Trang Cuối</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<script src="javascript.js/header-scroll.js"></script>
<script src="javascript.js/slider.js"></script>
<?php 
include "footer.php";
?>