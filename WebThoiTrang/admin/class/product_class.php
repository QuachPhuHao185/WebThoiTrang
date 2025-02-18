<?php
include dirname(__DIR__) . "/database.php";
?>
<?php

class product {
    public $db;
   
    public function __construct(){
        $this -> db = new Database();
    }
    public function show_cartegory(){
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_brand(){
        // $query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC"; nếu chỉ lấy id không
        $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name
        FROM tbl_brand INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
        ORDER BY tbl_brand.brand_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_brand_ajax($cartegory_id){
        $query = "SELECT * FROM tbl_brand where cartegory_id = '$cartegory_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function insert_product(){
        $product_name =$_POST['product_name'];
        $cartegory_id =$_POST['cartegory_id'];
        $brand_id = $_POST['brand_id'];
        $product_price =$_POST['product_price'];
        $product_price_new =$_POST['product_price_new'];
        $product_desc =$_POST['product_desc'];
        $product_img =$_FILES['product_img']['name'];
            move_uploaded_file($_FILES['product_img']['tmp_name'],"uploads/".$_FILES['product_img']['name']);
            $query = "INSERT INTO tbl_product (
            product_name,
            cartegory_id,
            brand_id,
            product_price,
            product_price_new,
            product_desc,
            product_img
            ) VALUES (
            '$product_name',
            '$cartegory_id',
            '$brand_id',
            '$product_price',
            '$product_price_new',
            '$product_desc',
            '$product_img')";
                $result = $this ->db->insert($query);
                if($result){
                    $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
                    $result = $this -> db -> select($query )->fetch_assoc();
                    $product_id = $result['product_id'];
                    $filename =$_FILES['product_img_desc']['name'];
                    $filetmp =$_FILES['product_img_desc']['tmp_name'];
                    foreach($filename as $key => $value)
                    {
                        move_uploaded_file($filetmp [$key],"uploads/".$value);
                        $query = "INSERT INTO tbl_product_img_desc (product_id,product_img_desc) VALUE ('$product_id','$value')";
                        $result = $this ->db->insert($query);
                    }
                }
        header('location:productlist.php');
        return $result;
    }
    public function show_product() {
        $query = " SELECT tbl_product.*, tbl_cartegory.cartegory_name,tbl_brand.brand_name
            FROM tbl_product
            INNER JOIN tbl_cartegory 
                ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
            INNER JOIN tbl_brand 
                ON tbl_product.brand_id = tbl_brand.brand_id
            ORDER BY tbl_product.product_id DESC
        ";
        $result = $this->db->select($query);
    
        if ($result) {
            $products = [];
            while ($row = $result->fetch_assoc()) {
                // Đưa sản phẩm vào danh sách
                $products[] = $row;
            }
            return $products;
        } else {
            return false; // Không có sản phẩm nào
        }
    }
    public function delete_product($product_id){
        $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this ->db->delete($query);
        header('location:productlist.php');
        return $result;
    }
    
    public function get_product($product_id) {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    // Hàm cập nhật sản phẩm
    public function update_product($data, $files, $product_id) {
        // Tạo một mảng để lưu tất cả các trường cần cập nhật
        $fields = [
            'product_name' => $data['product_name'],
            'cartegory_id' => $data['cartegory_id'],
            'brand_id' => $data['brand_id'],
            'product_price' => $data['product_price'],
            'product_price_new' => $data['product_price_new'],
            'product_desc' => $data['product_desc']
        ];
    
        // 1. Xử lý ảnh chính
        $file_name_main = $files['product_img']['name'];
        if (!empty($file_name_main)) { // Nếu có tải lên ảnh mới
            $unique_image_main = time() . '-' . $file_name_main;
            $uploaded_image_main = "uploads/" . $unique_image_main;
            move_uploaded_file($files['product_img']['tmp_name'], $uploaded_image_main);
    
            // Thêm ảnh chính mới vào mảng $fields
            $fields['product_img'] = $unique_image_main;
        }
    
        // 2. Tạo câu lệnh SQL `UPDATE` dựa trên $fields
        $update_query = "UPDATE tbl_product SET ";
        foreach ($fields as $key => $value) {
            $update_query .= "$key = '" . $this->db->link->real_escape_string($value) . "', ";
        }
        // Xóa dấu phẩy cuối cùng và thêm điều kiện WHERE
        $update_query = rtrim($update_query, ', ') . " WHERE product_id = '$product_id'";
    
        // 3. Thực thi truy vấn cập nhật
        $update_product = $this->db->update($update_query);
    
        // Kiểm tra kết quả cập nhật
        if ($update_product) {
            // 4. Xử lý ảnh mô tả
            if (!empty($files['product_img_desc']['name'][0])) {
                // Xóa các ảnh mô tả cũ
                $this->db->delete("DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id'");
    
                foreach ($files['product_img_desc']['name'] as $key => $img_desc_name) {
                    $unique_img_desc = time() . '-' . $img_desc_name;
                    $uploaded_img_desc = "uploads/" . $unique_img_desc;
                    move_uploaded_file($files['product_img_desc']['tmp_name'][$key], $uploaded_img_desc);
    
                    // Thêm ảnh mô tả mới vào bảng
                    $query_img_desc = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) 
                                       VALUES ('$product_id', '$unique_img_desc')";
                    $this->db->insert($query_img_desc);
                }
            }
    
            return "Sản phẩm đã được cập nhật thành công.";
        } else {
            return "Lỗi: Không thể cập nhật sản phẩm.";
        }
    }
    public function get_product_img_desc($product_id) {
        $query = "SELECT * FROM tbl_product_img_desc WHERE product_id = '$product_id'";
        return $this->db->select($query);
    }
    



    public function insert_brand($cartegory_id, $brand_name){
        $query = "INSERT INTO tbl_brand (cartegory_id,brand_name) VALUES ('$cartegory_id','$brand_name')";
        $result = $this ->db->insert($query);
        header('location:brandlist.php');
        return $result;
    }
    
    public function get_brand($brand_id){
        $query = "SELECT * FROM tbl_brand where brand_id = '$brand_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_brand($cartegory_id, $brand_name,$brand_id){
        $query ="UPDATE tbl_brand SET brand_name = '$brand_name', 
        cartegory_id = '$cartegory_id' Where brand_id = '$brand_id'";
        $result = $this ->db ->update($query);
        header('location:brandlist.php');
        return $result;
    }
    public function delete_brand($brand_id){
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this ->db->delete($query);
        header('location:brandlist.php');
        return $result;
    }














    public function get_cartegory($cartegory_id){
        $query = "SELECT * FROM tbl_cartegory where cartegory_id = '$cartegory_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_cartegory($cartegory_name, $cartegory_id ){
        $query ="UPDATE tbl_cartegory SET cartegory_name = '$cartegory_name' Where cartegory_id = '$cartegory_id'";
        $result = $this ->db ->update($query);
        header('location:cartegorylist.php');
        return $result;
    }
    public function delete_cartegory($cartegory_id){
        $query = "DELETE FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
        $result = $this ->db->delete($query);
        header('location:cartegorylist.php');
        return $result;
    }
   
}
?>