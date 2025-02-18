<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>
<?php
$product = new product; 
$show_product = $product->show_product(); 
?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách Sản phẩm</h1>
        <table>
            <tr>
                <th>Stt</th>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Loại Danh Mục</th>
                <th>Loại Sản Phẩm</th>
                
                <th>Giá</th>
                <th>Giá Mới</th>
                <th>Hình Ảnh</th>
                <th>Tùy Biến</th>
            </tr>
            <?php
            if ($show_product && is_array($show_product)) { // Kiểm tra nếu là mảng
                $i = 0;
                foreach ($show_product as $result) { // Lặp qua mảng
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['cartegory_name'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><?php echo number_format($result['product_price'], 0, ',', '.') ?>₫</td>
                        <td><?php echo number_format($result['product_price_new'], 0, ',', '.') ?>₫</td>
                        <td>
                            <img src="uploads/<?php echo $result['product_img'] ?>" alt="Hình ảnh sản phẩm" width="100px">
                        </td>
                        <td>
                            <a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a> | 
                            <a href="productdelete.php?product_id=<?php echo $result['product_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>