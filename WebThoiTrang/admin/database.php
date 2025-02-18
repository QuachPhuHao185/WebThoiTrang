<?php
 include "config.php";
?>

<?php 
if (!class_exists('Database')) {
class Database{
    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbname = DB_NAME;


    public $link;
    public $error;
    public $result;

public function __construct(){
    $this->connectDB();
}
private function connectDB(){
    $this->link = new mysqli($this->host, $this->user, $this->pass,
    $this->dbname);
    if(!$this->link){
        $this->error ="connection fail".$this->link->connect_error;
        return false;
    }
}
public function disconnect(){//ngắt kết nối
    if ($this->link) { // Kiểm tra nếu kết nối tồn tại
        $this->link->close(); // Đóng kết nối
        $this->link = null; // Gán giá trị null sau khi đóng
    }
}
public function execute($sql) {
    $this->result = $this->link->query($sql); // Thực thi câu lệnh SQL
    
    if ($this->result === false) { // Nếu truy vấn thất bại
        $this->error = "Query failed: " . $this->link->error; // Lưu lỗi vào thuộc tính
        return false; // Trả về false để báo hiệu thất bại
    }
    
    return true; // Trả về true nếu truy vấn thành công
}
public function num_rows() {//cho biết bao nhiêu dòng
    if (isset($this->result) && $this->result instanceof mysqli_result) {
        return $this->result->num_rows; // Trả về số hàng từ kết quả
    } else {
        return 0; // Nếu không có kết quả, trả về 0
    }
}
public function getData() {
    // Kiểm tra nếu $this->result hợp lệ và là đối tượng mysqli_result
    if (isset($this->result) && $this->result instanceof mysqli_result) {
        return $this->result->fetch_assoc(); // Lấy dòng dữ liệu kế tiếp
    } else {
        return null; // Trả về null nếu không có kết quả
    }
}
//select or read data
public function select($query){
    $result = $this->link->query($query) or 
    die($this->link->error.__line__);
    if($result->num_rows > 0){
        return $result;
    }else{
        return false;
    }
}
// Insert data
public function insert($query){
    $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if($insert_row){
        return $insert_row;
    }else{
        return false;
    }
}
// update data
public function update($query){
    $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if($update_row){
        return $update_row;
    }else{
        return false;
    }
}
//delete data
public function delete($query){
    $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if($delete_row){
        return $delete_row;
    }else{
        return false;
    }
}
}
}
?>