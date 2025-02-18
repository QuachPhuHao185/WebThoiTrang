<?php
include "database.php";
?>
<?php

class user{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }
    public function show_user(){
        $query = "SELECT * FROM tbl_user ORDER BY user_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_user_cart($user_id){
        $query = "SELECT * FROM tbl_user_cart WHERE user_id = '$user_id' ORDER BY user_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_user($user_id){
        $query = "DELETE FROM tbl_user WHERE user_id = '$user_id'";
        $result = $this ->db->delete($query);
        header('location:userlist.php');
        return $result;
    }
    public function get_user($user_id){
        $query = "SELECT * FROM tbl_user where user_id = '$user_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_user($user_id, $data){
        $user_name = $data['user_name'];
        $user_email = $data['user_email'];
        $user_phone = $data['user_phone'];
        $user_birth = $data['user_birth'];
        $user_gender = $data['user_gender'];
        $user_address = $data['user_address'];
        $user_role = $data['user_role'];
        $user_pwd = $data['user_pwd'];
    
        // Kiểm tra xem mật khẩu có bị thay đổi hay không
        $query_check = "SELECT user_pwd FROM tbl_user WHERE user_id = '$user_id'";
        $result_check = $this->db->select($query_check)->fetch_assoc();
        
        if ($result_check['user_pwd'] !== $user_pwd) {
            // Nếu mật khẩu bị thay đổi, mã hóa lại
            $user_pwd = password_hash($user_pwd, PASSWORD_DEFAULT);
        }
    
        $query = "UPDATE tbl_user SET 
            user_name = '$user_name', 
            user_email = '$user_email', 
            user_phone = '$user_phone', 
            user_birth = '$user_birth', 
            user_gender = '$user_gender', 
            user_address = '$user_address', 
            user_role = '$user_role', 
            user_pwd = '$user_pwd' 
            WHERE user_id = '$user_id'";
        
        $result = $this->db->update($query);
        header('Location: userlist.php');
        return $result;
    }
}