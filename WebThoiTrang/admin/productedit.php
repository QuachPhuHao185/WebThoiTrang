<?php
include "header.php";
include "slider.php";
include "class/product_class.php";

// Tạo một đối tượng `product` từ lớp `product`
$product = new product;

// Kiểm tra xem `product_id` có được gửi qua URL hay không
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // Lấy thông tin sản phẩm theo ID
    $get_product = $product->get_product($product_id);
    if ($get_product) {
        $resultA = $get_product->fetch_assoc();
    }
}

// Kiểm tra nếu người dùng đã gửi biểu mẫu để cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gọi hàm `update_product` để cập nhật sản phẩm
    $update_product = $product->update_product($_POST, $_FILES, $product_id);
    if ($update_product) {
        // Chuyển hướng về trang productlist.php
        header("Location: productlist.php");
        exit();
    }
}

?>

<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Chỉnh Sửa Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Nhập tên sản phẩm -->
            <label for="">Nhập tên sản phẩm</label>
            <input name="product_name" required type="text" value="<?php echo $resultA['product_name']; ?>" placeholder="Nhập tên sản phẩm">

            <!-- Chọn danh mục sản phẩm -->
            <label for="">Chọn danh mục</label>
            <select name="cartegory_id" id="cartegory_id">
                <option value="#">--Chọn--</option>
                <?php 
                // Hiển thị danh sách danh mục từ cơ sở dữ liệu
                $show_cartegory = $product->show_cartegory();
                if ($show_cartegory) {
                    while ($result = $show_cartegory->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result['cartegory_id']; ?>" <?php if ($resultA['cartegory_id'] == $result['cartegory_id']) { echo "selected"; } ?>>
                            <?php echo $result['cartegory_name']; ?>
                        </option>
                    <?php }} ?>
            </select>

            <!-- Chọn loại sản phẩm (thương hiệu) -->
            <label for="">Chọn loại sản phẩm</label>
            <select name="brand_id" id="brand_id">
                <option value="#">--Chọn--</option>
                <!-- Phần này sẽ được cập nhật qua AJAX -->
                <?php 
                // Hiển thị danh sách danh mục từ cơ sở dữ liệu
               $show_brand = $product->show_brand();
                if ($show_brand) {
             while ($result = $show_brand->fetch_assoc()) {
            ?>
            <option value="<?php echo $result['brand_id']; ?>" <?php if ($resultA['brand_id'] == $result['brand_id']) { echo "selected"; } ?>>
                <?php echo $result['brand_name']; ?>
            </option>
        <?php }} ?>
            </select>
            <!-- Nhập giá sản phẩm -->
            <label for="">Chọn Giá sản phẩm</label>
            <input name="product_price" required type="text" value="<?php echo $resultA['product_price']; ?>" placeholder="Giá sản phẩm">

            <!-- Nhập giá khuyến mãi -->
            <label for="">Chọn Giá khuyến mải</label>
            <input name="product_price_new" required type="text" value="<?php echo $resultA['product_price_new']; ?>" placeholder="Giá khuyến mải">

            <!-- Mô tả sản phẩm -->
            <label for="">Mô tả sản phẩm</label>
            <div class="editor-container">
                <textarea name="product_desc" id="editor1" cols="30" rows="10" required><?php echo $resultA['product_desc']; ?></textarea>
            </div>

            <!-- Ảnh sản phẩm chính -->
            <label for="">Ảnh sản phẩm</label>
            <input name="product_img" type="file">
            <!-- Lưu trữ ảnh cũ để sử dụng nếu người dùng không tải ảnh mới -->
            <input type="hidden" name="old_product_img" value="<?php echo $resultA['product_img']; ?>">

            <!-- Ảnh mô tả sản phẩm -->
            <label for="">Ảnh mô tả</label>
            <input name="product_img_desc[]" multiple type="file">
            <!-- Lưu trữ ảnh mô tả cũ -->
            <input type="hidden" name="old_product_img_desc" value="<?php echo htmlspecialchars($resultA['product_img_desc'] ?? ''); ?>">
            <label for="">Ảnh mô tả củ</label>
            <div>
            <?php 
             $get_img_desc = $product->get_product_img_desc($product_id);
            if ($get_img_desc) {
            while ($img = $get_img_desc->fetch_assoc()) {
            echo '<img src="uploads/' . $img['product_img_desc'] . '" alt="" style="width: 100px; height: auto; margin: 5px;">';
            }
            }
            ?>
            </div>
            <!-- Nút gửi để cập nhật -->
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>
</section>

<!-- Tích hợp CKEditor -->
<script>
   ClassicEditor
    .create(document.querySelector('#editor1'), {
        ckfinder: {
            uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
        },
    })
    .then(editor => {
        const editable = editor.ui.getEditableElement();
        editable.style.width = '600px';
        editable.style.height = '200px';
    })
    .catch(error => {
        console.error('Error initializing CKEditor:', error);
    });
</script>

<!-- Sử dụng AJAX để cập nhật danh sách thương hiệu dựa trên danh mục -->
<script>
    $(document).ready(function(){
        $("#cartegory_id").change(function(){
            var x = $(this).val();
            $.get("productadd_ajax.php", {cartegory_id:x}, function(data){
                $("#brand_id").html(data);
            });
        });
    });
</script>
</body>
</html>