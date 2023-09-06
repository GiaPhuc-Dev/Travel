<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<style>
    .navbar>.navbar-nav>.navbar-item>.nav-link {
        color: black;
        border-radius: 20px;
        margin: 0 5px;
    }

    .navbar-item:hover .nav-link:hover {
        background-color: #6ada4f;
        color: white;
        border-radius: 20px;
    }
</style>
<nav style="position: -webkit-sticky; position: sticky; top: 0;"
    class="navbar justify-content-between navbar-expand-sm bg-light nav-pills">
    <a href="index.php">
        <img class="" style="margin-left: 20px;width: 200px;" src="./assets/image/logo.png" />
    </a>
    <ul class="navbar-nav">
        <li class="navbar-item">
            <a style="font-weight: 500;" class="nav-link" href="./index.php">Trang chủ</a>
        </li>
        <li class="navbar-item">
            <a style="font-weight: 500;" class="nav-link" href="./about.php">Giới thiệu</a>
        </li>
        <li class="navbar-item">
            <a style="font-weight: 500;" class="nav-link" href="./product.php">Khám phá</a>
        </li>

    </ul>
    <ul class="navbar-nav" style="margin-right: 20px">
        <?php if (!isset($_SESSION['user'])): ?>
            <li class="navbar-item">
                <a style="color: black; font-weight: 500;" class="nav-link" href="./signup.php">Đăng ký</a>
            </li>
            <li class="navbar-item">
                <a style="color: black; font-weight: 500;" class="nav-link" href="./login.php">Đăng nhập</a>
            </li>
        <?php endif ?>

        <?php if (isset($_SESSION['user'])): ?>
            <li style="margin-right: 10px; " class="dropdown">
                <a href="#" style="text-decoration: none ;color: black; padding-left: 13px;" class="dropdown-toggle"
                    data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']['name'] ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a style="text-decoration: none; margin-left: 30px; color: black;" href="./logout.php">Đăng xuất</a>
                    </li>
                </ul>
            </li>
        <?php endif ?>

    </ul>
</nav>