document.getElementById("btIn").addEventListener("click", function() {
    event.preventDefault();
    var inputElement = document.getElementById("inputValue");
    var a = parseInt(inputElement.value);
    inputElement.value = a + 1;
}); // Nút tăng
document.getElementById("btDe").addEventListener("click", function(event) {
    event.preventDefault();
    var inputElement = document.getElementById("inputValue");
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
        inputElement.value = currentValue - 1;
    }
}); // Nút giảm

/*function validateForm() {
    var mauSacElements = document.getElementsByName("mauSac");
    var kichCoElements = document.getElementsByName("kichCo");

    var mauSacChecked = false;
    var kichCoChecked = false;

    for (var i = 0; i < mauSacElements.length; i++) {
        if (mauSacElements[i].checked) {
            mauSacChecked = true;
            break;
        }
    }

    for (var i = 0; i < kichCoElements.length; i++) {
        if (kichCoElements[i].checked) {
            kichCoChecked = true;
            break;
        }
    }

    if (!mauSacChecked || !kichCoChecked) {
        alert("Vui lòng chọn phân loại sản phẩm!");
        return false; // Ngăn không gửi biểu mẫu nếu không chọn loại sản phẩm
    }
}*/

window.onload = function() {
    var btMau = document.querySelector('input[type="radio"][name="mauSac"]');
    var btKC = document.querySelector('input[type="radio"][name="kichCo"]');
    if (btMau && btKC) {
        btMau.click();
        btKC.click();
    }
}; //Click trước các radio button

function kiemTraSoLuong() {
    var selectedColor = document.querySelector('input[name="mauSac"]:checked').value;
    var selectedSize = document.querySelector('input[name="kichCo"]:checked').value;

    for (var i = 0; i < data.length; i++) {
        var item = data[i];

        if (item['mauSac'] === selectedColor && item['kichCo'] === selectedSize) {
            if (item['soLuong'] > 0) {
                document.getElementById('s').value = "Còn Hàng";
                return; // Dừng vòng lặp và thoát khỏi hàm khi soLuong > 0
            } else {
                document.getElementById('s').value = "Hết Hàng";
            }
        } else if (item['mauSac'] === selectedColor && item['kichCo'] !== selectedSize) {
            document.getElementById('s').value = "Hết Hàng";
        }
    }
}

// Gắn hàm kiểm tra số lượng vào sự kiện change của các radiobutton
document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        kiemTraSoLuong(); // Gọi hàm kiểm tra số lượng khi có thay đổi trong radiobutton
    });
});

function validateForm() {
    var inputValue = document.getElementById("s").value;
    if (inputValue == "Hết Hàng") {
            alert("Phân loại này đã hết hàng!\nVui lòng chọn phân loại khác!");
            return false; // Ngăn không gửi biểu mẫu
    }
}
