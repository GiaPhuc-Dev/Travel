<?php
session_start();

require_once('../admin/core/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];


    if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
        $error = 'Không được để trống tên, email, username và password';
    } else {
        if (isset($email)) {
            $regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
            if (!preg_match($regex, $email)) {
                $error = 'Email không hợp lệ';
            }
        }

        if (strlen($username) < 4 || strlen($username) > 50) {
            $error = 'Tài khoản từ 4 đến 50 ký tự';
        }

        if (strlen($password) < 4 || strlen($password) > 50) {
            $error = 'Mật khẩu phải từ 4 đến 50 ký tự';
        }

        if ($password != $repassword) {
            $error = 'Mật khẩu không trùng khớp';
        }

        if (is_numeric($fullname)) {
            $error = 'Tên không hợp lệ!';
        }
    }





    if (!isset($error)) {
        $query = "SELECT username from user WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $error = 'Tài khoản đã tồn tại';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = $conn->prepare('INSERT INTO user(username,password,email,fullname) VALUES(:username,:password,:email,:fullname)');

            $query->bindParam(':username', $username);
            $query->bindParam(':password', $password);
            $query->bindParam(':fullname', $fullname);
            $query->bindParam(':email', $email);

            $query->execute();

            $_SESSION['user']['name'] = $fullname;
            $_SESSION['user']['role'] = 2;

            header('location: ./index.php');
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
                <div class="form_signup-left">
                    <!-- Ảnh  -->
                </div>
            </div>
            <div class="col-5">
                <div class="form_signup-right d-flex justify-content-center">
                    <form action="" method="POST">

                        <div class="form_signup-container">
                            <h1>Đăng Ký Tài Khoản</h1>
                            <h6 style="font-size: 15px;color: red; margin: 0;">
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>
                            </h6>




                            <label class="form_signup-label"><b>Họ và tên </b></label>
                            <input type="text" placeholder="Nhập họ và tên" name="fullname">

                            <label class="form_signup-label"><b>Email</b></label>
                            <input type="text" placeholder="Nhập Email" name="email">

                            <label class="form_signup-label"><b>Username</b></label>
                            <input type="text" placeholder="Nhập Username" name="username">

                            <label class="form_signup-label"><b>Mật Khẩu</b></label>
                            <input type="password" placeholder="Nhập Mật Khẩu" name="password">

                            <label class="form_signup-label"><b>Nhập Lại Mật Khẩu</b></label>
                            <input type="password" placeholder="Nhập Lại Mật Khẩu" name="repassword">

                            <label class="form_signup-label">

                                Nếu bạn đã có tài khoản, hãy <a href="login.php">bấm vào đây!</a>
                            </label>

                            <div>
                                <button type="submit" class="signupbtn">Đăng ký</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

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