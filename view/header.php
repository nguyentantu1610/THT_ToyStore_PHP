<?php
if (isset($_GET['name'])) {
    if ($_GET['name'] == 'logout') {
        session_start();
        session_destroy();
        session_unset();
        header('Location:../view/signin.php');
    }
}
?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href=" http://localhost:3000/view/dashboard.php">
                        <i class="menu-icon fa fa-laptop"></i>Trang chủ
                    </a>
                </li>
                <li class="menu-title">Quản lý</li><!-- /.menu-title -->
                <li><a href=" http://localhost:3000/view/list-category.php">
                        <i class="menu-icon fa fa-bars"></i>Danh mục</a>
                </li>
                <li>
                    <a href=" http://localhost:3000/view/list-product.php">
                        <i class="menu-icon fa fa-product-hunt"></i>Sản phẩm
                    </a>
                </li>
                <li>
                    <a href="http://localhost:3000/view/list-bills.php">
                        <i class="menu-icon fa fa-money"></i>Đơn hàng
                    </a>
                </li>
                <li class="menu-title">Đối tác</li><!-- /.menu-title -->
                <li>
                    <a href=" http://localhost:3000/view/list-user.php">
                        <i class="menu-icon fa fa-user"></i>Người dùng
                    </a>
                </li>
                <li>
                    <a href=" http://localhost:3000/view/list-publisher.php">
                        <i class="menu-icon fa fa-truck"></i>Nhà xuất bản
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- ------------------------------------------------------------- -->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost:3000/view/dashboard.php">
                    <h2 style="text-align:center ;margin-right:80px">THT</h2>
                </a>
                <a class="navbar-brand hidden" href="http://localhost:3000/view/dashboard.php">
                    <img src="https://res.cloudinary.com/ddt8drwas/image/upload/c_lpad,h_175,q_100,w_500/v1679934580/TVT_n5hd3g.png" alt="Logo">
                </a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="/resources/images/avatar/default-user.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-65px, 55px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="nav-link" href="/view/header.php?name=logout"><i class="fa fa-power -off"></i>Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <!-- Right Panel -->

    </body>

    </html>