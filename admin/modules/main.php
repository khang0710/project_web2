<div class="main" style="padding: 30px;">
    <?php
        if (isset($_GET['action']) && ($_GET['query'])){
            $tam = $_GET['action'];
            $query = $_GET['query'];
        }else{  
            $tam = "";
            $query = "";
        }
        //QuanLyDanhMuc
        if ($tam == "danhmuc" && $query == "them"){
            //include("modules/danhmuc/lietke.php");
            include("modules/danhmuc/them.php");
        }
        else if ($tam == "danhmuc" && $query == "sua"){
            include("modules/danhmuc/sua.php");
        }
        else if ($tam == "danhmuc" && $query == "lietke"){
            include("modules/danhmuc/lietke.php");
        }
        //QuanLySanPham
        else if ($tam == "sanpham" && $query == "lietke"){
            include("modules/sanpham/lietke.php");
        }
        else if ($tam == "sanpham" && $query == "them"){
            include("modules/sanpham/them.php");
            //include("modules/sanpham/chitiet.php");
        }
        else if ($tam == "sanpham" && $query == "sua"){
            include("modules/sanpham/sua.php");
        }
        else if ($tam == "sanpham" && $query == "lietke-chitiet"){
            include("modules/sanpham/lietke-chitiet.php");
        }
        else if ($tam == "sanpham" && $query == "themchitiet"){
            include("modules/sanpham/themchitiet.php");
        }

        //Quan Ly Don Hang
        else if ($tam == "donhang" && $query == "lietke"){
            include("modules/donhang/lietke.php");
        }
        else if ($tam == "donhang" && $query == "chitiet"){
            include("modules/donhang/chitietdonhang.php");
        }

        //Quan Ly Nhap Hang
        else if ($tam == "nhaphang" && $query == "lietke"){
            include("modules/nhaphang/lietke.php");
        }
        else if ($tam == "nhaphang" && $query == "chitiet"){
            include("modules/nhaphang/chitiet.php");
        }
        else if ($tam == "nhaphang" && $query == "themchitiet"){
            include("modules/nhaphang/themchitiet.php");
        }
        else if ($tam == "nhaphang" && $query == "sua"){
            include("modules/nhaphang/sua.php");
        }

        //Thong Ke
        else if ($tam == "thongke" && $query == "thongke"){
            include("modules/donhang/thongke.php");
        }

        //Dang Xuat
        else if ($tam == "dangxuat" && $query == "dangxuat"){
            unset($_SESSION['dangNhap']);
            header("location:login.php");
        }

        //DashBoard
        else{
            include("dashboard.php");
        }

    ?>
</div>