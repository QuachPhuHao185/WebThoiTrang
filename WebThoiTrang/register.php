<?php 
include "header.php";
?>
<section class="register">
    <div class="register-container">
        <div class="register-top-wrap">
            <div class="register-top">
                
            </div>
        </div>
    </div>
    <div class="register-container">
        <div class="register-content row">
    
            <div class="register-content-left">
                <p>Vui lòng chọn địa chỉ giao hàng</p>
                <div class="register-content-left-dangnhap row">
                    <i class="fas fa-sign-in-alt"></i>
                    <p>Đăng nhập (Nếu bạn đã có tài khoản của ICON)</p>
                </div><br>
    <form action="admin/class/process_register.php" method="POST">
                <div class="register-content-left-input-top row">
                    <div class="register-content-left-input-top-item">
                        <label for="">Họ tên <span style="color:red;">*</span></label>
                        <input type="text" id="user_name" name="user_name">
                    </div>
                    <div class="register-content-left-input-top-item">
                        <label for="">Email <span style="color:red;">*</span></label>
                        <input type="text" id="user_email" name="user_email">
                    </div>
                    <div class="register-content-left-input-top-item">
                        <label for="">Điện thoại <span style="color:red;">*</span></label>
                        <input type="text" id="user_phone" name="user_phone">
                    </div>
                    <div class="register-content-left-input-top-item">
                        <label for="">Ngày Sinh <span style="color:red;">*</span></label>
                        <input type="text" id="user_birth" name="user_birth">
                    </div>
                    <div class="register-content-left-input-top-item">
                        <label for="">Giới Tính <span style="color:red;">*</span></label>
                        <select name="user_gender" id="user_gender">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="register-content-left-input-top-item hidden">
                        <label for="">Vai trò <span style="color:red;">*</span></label>
                        <input type="text" id="user_role" name="user_role" value="khach">
                    </div>
                </div>
                <div class="register-content-left-input-bottom">
                    <label for="">Địa chỉ <span style="color:red;">*</span></label>
                    <input type="text" id="user_address" name="user_address">
                </div>
            </div>
            <div class="register-content-right">
                <br><br><br><br>
                <div class="register-content-right-input">
                    <label for="">Mật Khẩu Người Dùng<span style="color:red;">*</span></label>
                    <input type="password" id="user_pwd" name="user_pwd">
                </div><br><br>
                <div class="register-content-right-input">
                    <label for="">Nhập lại mật khẩu<span style="color:red;">*</span></label>
                    <input type="password" id="user_repwd" name="user_repwd">
                </div> <br>
                
                <div class="register-content-right-khachle row">
                    <input name="loaikhach" type="radio" value="khachle" required>&ensp;
                    <p><b>Đồng ý với các điều khoản của IVY</b></p>
                </div><br><br>
                <div class="register-content-right-submit">
                    <input type="submit" name="register" value="Đăng Ký">
                </div>
            </div>
    </form>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>