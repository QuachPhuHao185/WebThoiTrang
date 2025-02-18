<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>
<?php
$product = new product;
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // var_dump($_POST,$_FILES);

    $insert_product = $product ->insert_product($_POST, $_FILES);
}
?>
<div class="admin-content-right">
<div class="admin-content-right-product-add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm</label>
                    <input name="product_name"required type="text" placeholder="Nhập tên sản phẩm">
                    <label for="">Chọn danh mục</label>
                    <select name="cartegory_id" id="cartegory_id">
                    <option value="#">--Chọn--</option>
                        <?php 
                        $show_cartegory = $product-> show_cartegory();
                        if($show_cartegory){while($result = $show_cartegory -> fetch_assoc()){
                        
                        ?>
                        <option value="<?php echo $result['cartegory_id']?>"><?php echo $result['cartegory_name']?></option>
                        <?php 
                        }}
                        ?>
                    </select>
                    <label for="">Chọn loại sản phẩm</label>
                    <select name="brand_id" id="brand_id">
                        <option value="#">--Chọn--</option>
                      
                    </select>
                    <label for="">Chọn Giá sản phẩm</label>
                    <input name="product_price" required type="text" placeholder="Giá sản phẩm">
                    <label for="">Chọn Giá khuyến mải</label>
                    <input name="product_price_new" required type="text" placeholder="Giá khuyến mải">
                    <label for="">Mô tả sẩn phẩm</label>
                    <div class="editor-container">
                    <textarea name="product_desc" id="editor1" cols="30" rows="10"></textarea>
                    </div>
                    <label for="">Ảnh sẩn phẩm</label>
                    <input name="product_img" required type="file">
                    <label for="">Ảnh Mô tả</label>
                    <input name="product_img_desc[]" multiple type="file">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
   ClassicEditor
    .create(document.querySelector('#editor1'),{ckfinder: {
			uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		},})
    .then(editor => {
        // Đảm bảo chiều cao và chiều rộng của phần tử chỉnh sửa
        const editable = editor.ui.getEditableElement();
        editable.style.width = '600px'; // Tương đương với cols=30
        editable.style.height = '200px'; // Tương đương với rows=10

        // Kiểm tra lại khi focus vào trường chỉnh sửa
        editable.addEventListener('focus', function() {
            editable.style.height = '200px'; // Đảm bảo chiều cao khi focus
        });
    })
    .catch(error => {
        console.error('Error initializing CKEditor:', error);
    });
</script>

<script>
    $(document).ready(function(){
        $("#cartegory_id").change(function(){
            // alert($(this).val())
            var x =$(this).val()
            $.get("productadd_ajax.php", {cartegory_id: x}, function(data){
                $("#brand_id").html(data);
            })
        })
    })
</script>
</html>