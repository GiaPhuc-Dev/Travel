<?php
session_start();
if (isset($_SESSION['user'])) {
    header('location: ./index.php');
}
require_once('../admin/core/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
        $error = 'Không được để trống username và password';
    }

    if (!isset($error)) {
        // CHECK USERNAME
        $query = $conn->prepare("SELECT username,password,fullname,role FROM user WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $error = 'Tài khoản không tồn tại';
        } else {
            // CHECK PASSWORD
            if (password_verify($password, $user['password'])) {
                $_SESSION['user']['name'] = $user['fullname'];
                $_SESSION['user']['role'] = $user['role'];

                header('location: ./index.php');
            } else {
                $error = 'Sai mật khẩu';
            }
        }
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


</head>

<body>
    <!-- Menu -->
    <?php include("./inc/menu.php") ?>

    <!-- Main content -->
    <div class="container ">
        <div class="row">


            <div class="col-1"></div>
            <div class="col-5">
                <div class="form_login-left">
                    <!-- Ảnh  -->
                </div>
            </div>
            <div class="col-5">
                <div class="form_login-right d-flex justify-content-center">
                    <form action="" method="POST">
                        <div class="form_login-container">
                            <h1>Đăng Nhập Tài khoản</h1>
                            <h6 style="font-size: 15px;color: red; margin: 0;">
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>
                            </h6>
                            <label class="form_login-label"><b>Username</b></label>
                            <input type="text" placeholder="Nhập Username" name="username">

                            <label class="form_login-label"><b>Mật Khẩu</b></label>
                            <input type="password" placeholder="Nhập Mật Khẩu" name="password">
                            <label class="form_signup-label">

                                Nếu bạn chưa có tài khoản, hãy <a href="signup.php">bấm vào đây!</a>
                            </label>

                            <div class="">
                                <button type="submit" class="loginbtn">Đăng Nhập</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-1"></div>

        </div>
    </div>
    </div>








    <!-- Footer  -->
    <?php
    include("./inc/footer.php")
        ?>







    <!-- Link CDN  -->
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <!-- Jquery -->


</body>

</html>