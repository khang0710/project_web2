document.addEventListener("DOMContentLoaded", function () {
    var toggleSearch = document.getElementById('toggleSearch');
    var searchContainer = document.getElementById('searchContainer');

    toggleSearch.addEventListener('click', function () {
        if (searchContainer.style.display === 'block') {
            searchContainer.style.display = 'none';
        } else {
            searchContainer.style.display = 'block';
        }
    });
    searchButtonClose.addEventListener('click', function () {
        if (searchContainer.style.display === 'block') {
            searchContainer.style.display = 'none';
        }
    });
});


function buildURL() {
    var giaBanValue = getSelectedValueSL('giaBan');
    var danhMucValue = getSelectedValue('danhMuc');
    var kichCoValue = getSelectedValue('kichCo');

    // Tạo URL dựa trên giá trị được chọn
    var url = 'index.php?giaBan=' + encodeURIComponent(giaBanValue) + '&danhMuc=' + encodeURIComponent(danhMucValue) + '&kichCo=' + encodeURIComponent(kichCoValue);

    // Chuyển hướng người dùng đến URL
    window.location.href = url;
}

function getSelectedValue(radioName) {
    var selectedRadio = document.querySelector('input[name="' + radioName + '"]:checked');
    return selectedRadio ? selectedRadio.value : '';
}

function getSelectedValueSL(selectName) {
    var selectedOption = document.querySelector('select[name="' + selectName + '"] option:checked');
    return selectedOption ? selectedOption.value : '';
}

var radioButtons = document.querySelectorAll('input[type="radio"]');
radioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', buildURL);
});

var selectElement = document.getElementById('selectGiaBan');
selectElement.addEventListener('change', buildURL);




