<?php 
include "header.php";
?>
<section class="login">
<div class="login-container">
        <div class="login-content row">
            <div class="login-content-left">
                <p>Vui lòng Đăng nhập nếu bạn có tài khoản</p>
                <div class="login-content-left-dangnhap row">
                    <i class="fas fa-sign-in-alt"></i>
                    <p>Đăng nhập (Nếu bạn đã có tài khoản của ICON)</p>
                </div>
                <br><br>
                <form  action="admin/class/process_login.php" method="POST">
                <div class="login-content-left-input-top row">
                    <div class="login-content-left-input-top-item">
                        <label for="">Email hoặt Số Điện thoại <span style="color:red;">*</span></label>
                        <input type="text" name="user_input" required>
                    </div>
                </div>
                <div class="login-content-left-input-bottom">
                    <label for="">Mật Khẩu Người Dùng<span style="color:red;">*</span></label>
                    <input type="text" name="user_password" required>
                </div><br><br>
                <div class="login-content-left-submit">
                    <input type="submit" name="register" value="Đăng Nhập">
                </div>
                </form>
            </div>
            <div class="login-content-right">
                <h2>Khách hàng mới của Thời Trang ICON</h2>
                <p>Nếu bạn chưa có tài khoản trên Thời Trang ICON, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.</p>

                <p>Bằng cách cung cấp cho IVY moda thông tin chi tiết của bạn, 
                quá trình mua hàng trên ivymoda.com sẽ là một trải nghiệm thú vị và nhanh chóng hơn! </p>
                <div class="login-content-left-btn row">
                    <button><a href="register.php"><p style="font-weight: bold;">Đăng Ký</p></a></button>
                </div>
            </div>
        </div>
</div>
</section>
<?php 
include "footer.php";
?>