<?php 
include "header.php";
?>
<!---------------------------- payment --------------------------->
<section class="payment">
    <div class="payment-container">
        <div class="payment-top-wrap">
            <div class="payment-top">
                <div class="payment-top-cart payment-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="payment-top-adress payment-top-item">
                    <i class="fas fa-map-marker-alt "></i>
                </div>
                <div class="payment-top-payment payment-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="payment-container">
        <div class="payment-content row">
            <div class="payment-content-left">
                <div class="payment-content-left-method-delivery">
                    <p style="font-weight: bold;">Phương thức giao hàng</p>
                    <div class="payment-content-left-method-delivery-item">
                        <input type="radio">
                        <label for="">Giao hàng chuyển phát nhanh</label>
                    </div>
                </div>
                <div class="payment-content-left-method-payment">
                    <p style="font-weight: bold;">Phương thức thanh toán</p>
                    <p>Mọi giao dịch đều được bảo mật và mả hóa. 
                        Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
                    <div class="payment-content-left-method-payment-item">
                        <input checked name="method-payment" type="radio">
                        <label for="">Thanh toán bằng thẻ tín dụng (OnePay)</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="images/visalogo.webp" style="height: 50px; width: 70px;">
                        <img src="images/mastercardlogo.webp" style="height: 50px; width: 70px;">
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thanh toán bằng MOMO</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="images/MomoLogo.png" style="height: 50px; width: 80px;">
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thu tiền tận nơi</label>
                    </div>
                </div>
            </div>
            <div class="payment-content-right">
                <div class="payment-content-right-btn">
                    <input type="text" placeholder="Mã giảm giá/Quà tặng">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div class="payment-content-right-btn">
                    <input type="text" placeholder="Mã công tác viên">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div class="payment-content-right-mnv">
                    <select name="" id="">
                        <option value="">Chọn mã nhân viên thân thiết</option>
                        <option value="">D345</option>
                        <option value="">A345</option>
                        <option value="">E365</option>
                        <option value="">I345</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="payment-content-right-payment">
            <button onclick="completePayment()">TIẾP TỤC THANH TOÁN</button>
        </div>
    </div>
    
</section>
<script>
    function completePayment() {
        alert("Quá trình thanh toán thành công!");
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 100);
    }
</script>
<?php 
include "footer.php";
?>