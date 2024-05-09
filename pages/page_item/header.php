
<header>
        
        <div class="logo">
        </div>
        <div class="menu">
            <ul>
                <li><a href="../pages/Home.php"><img class="logo" src="../image/logo.jpg" width="67" height="50"></a></li>
            </ul>
            <ul>
                <li>
                    <div class="dropdown">
                        <a href="../collection/all/">TẤT CẢ</a>
                        <div class="dropdown-child" style="width: 47px;">
                            <div class="line"></div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown">
                        <a href="../collection/ao/">ÁO</a>
                        <div class="dropdown-child">
                            <div class="line"></div>
                            <div class="listdanhmuc">
                            <a href="">Áo Thun</a>
                            <a href="">Sơ Mi</a>
                            <a href="">Cardigan</a>
                            <a href="">Áo Khoác</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown">
                        <a href="../collection/quan/">QUẦN</a>
                        <div class="dropdown-child">
                            <div class="line"></div>
                            <div class="listdanhmuc">
                            <a href="">Quần Dài</a>
                            <a href="">Quần Short</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown">
                        <a href="../collection/vay/">VÁY</a>
                        <div class="dropdown-child">
                            <div class="line"></div>
                            <div class="listdanhmuc">
                            <a href="">Váy Cottagecore</a>
                            <a href="">Váy Princess</a>
                            <a href="">Váy Ngắn</a>
                            <a href="">Chân Váy</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown">
                        <a href="../collection/phukien/">PHỤ KIỆN</a>
                        <div class="dropdown-child">
                            <div class="line"></div>
                            <div class="listdanhmuc">
                            <a href="">Mũ, Khăn Chùm</a>
                            <a href="">Trang Sức</a>
                            </div>
                        </div>
                    </div>

                </li>

                <li>
                    <div class="dropdown">
                        <a href="">GIỚI THIỆU</a>
                        <div class="dropdown-child" style="width: 70px;">
                            <div class="line"></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="other">
            <li id="toggleSearch"><i class='bx bx-search-alt-2'></i></li>
            <li><a href="../pages/User.php"><i class='bx bx-user-circle'></i></a></li>
            <!--<li><i class='bx bx-heart' ></i></li>-->
            <li><a href="http://localhost/CottagecoreWeb/collection/cart/"><i class='bx bx-store-alt'></i></a></li>

        </div>
        
    </header>

    <form action="../collection/timkiem/index.php" method="GET">
    <div id="searchContainer" class="search-container">
        <input type="text" id="searchInput" name="q" placeholder="Search...">
        <button type="submit" style="display: none"></button>
        </form>
        <i id="searchButtonClose" class='bx bx-x'></i>
    </div>