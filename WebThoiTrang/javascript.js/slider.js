
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    // Chọn tất cả các hình ảnh trong container của slider với class "aspect-ratio-169"
    const imgContainer =document.querySelector('.aspect-ratio-169')
     // Chọn container chứa tất cả các hình ảnh để có thể di chuyển chúng bằng cách thay đổi vị trí
    const dotItem =document.querySelectorAll(".dot")// Chọn tất cả các nút chấm (nút điều hướng) trong slider để chỉ báo hình ảnh đang hiển thị
    let index = 0 // Khởi tạo biến index để theo dõi vị trí của hình ảnh hiện tại
    let imgNumber = imgPosition.length // Lưu số lượng hình ảnh trong slider để sử dụng cho việc lặp qua các hình ảnh
    // console.log(imgPosition) có thể được dùng để kiểm tra img có được chọn không
    imgPosition.forEach(function(image,index){
        image.style.left = index*100 +"%"// Đặt vị trí mỗi hình ảnh cạnh nhau theo chiều ngang từ trái sang phải
        dotItem[index].addEventListener("click",function(){
            slider(index)
        })// Thêm sự kiện click vào mỗi chấm để hiển thị hình ảnh tương ứng khi chấm đó được nhấn
    })
    function imgSlide (){
        index++; // Tăng index lên 1 mỗi lần hàm này được gọi để chuyển sang hình ảnh tiếp theo
        console.log(index)
        if(index >= imgNumber){
            index = 0 // Đặt lại index về 0 nếu vượt quá số lượng hình ảnh, tạo thành một vòng lặp liên tục
        }
        slider(index)// Gọi hàm slider với index mới để hiển thị hình ảnh tiếp theo
    }
    function slider(index){
        imgContainer.style.left = "-" + index*100+ "%" // Điều chỉnh vị trí bên trái của container để hiển thị hình ảnh đã chọn
        const dotActive = document.querySelector('.active')  // Chọn chấm đang được kích hoạt
        dotActive.classList.remove("active")// Bỏ class "active" khỏi chấm trước đó
        dotItem[index].classList.add("active") // Thêm class "active" vào chấm mới tương ứng với hình ảnh đang hiển thị
    }
    setInterval(imgSlide,5000) // Thiết lập bộ hẹn giờ tự động gọi hàm imgSlide mỗi 5 giây, chuyển đến hình ảnh tiếp theo
// --------------------Menu-Slidebar-Category-------------------//
  const itemsliderbar = document.querySelectorAll(".category-left-li")
  itemsliderbar.forEach(function(menu,index){
    menu.addEventListener("click",function(){
        menu.classList.toggle("block");
    })
  });