<?php
require_once('../core/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];

    if ($category_name == '') {
        $error = "Không được để trống";
    } else {
        $query = $conn->prepare('SELECT category_name FROM category WHERE category_name = :category_name');

        $query->bindParam(':category_name', $category_name);

        $query->execute();
        $result = $query->fetch();

        if (!$result) {
            $query = $conn->prepare('INSERT INTO category (category_name) VALUES (:category_name) ');
            $query->bindParam(':category_name', $category_name);
            $query->execute();
            $success = 'Thêm danh mục thành công';
        } else {
            $error = 'Danh mục đã tồn tại';
        }
    }
}

$query = $conn->prepare('SELECT * FROM category');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin</title>
    <link rel="stylesheet" href="../core/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>



</head>

<body>

    <nav style="position: -webkit-sticky; position: sticky; top: 0;"
        class="navbar justify-content-between navbar-expand-sm bg-primary  nav-pills">

        <ul class="navbar-nav ">
            <li class="navbar-item">
                <a style="font-weight: 700;" class="nav-link" href="#">ADMIN PAGE</a>
            </li>

            <li style="margin-left: 30px" class="navbar-item">
                <a style="font-weight: 500;color: white" class="nav-link" href="../index.php">Trang chủ</a>
            </li>

            <li class="navbar-item">
                <a style="font-weight: 500;color: white" class="nav-link" href="">Quản lý danh
                    mục</a>
            </li>
            <li class="dropdown navbar-item">
                <a href="#"
                    style="text-decoration: none ;color: white; margin-left: 10px; position: absolute; top: 8px;font-weight: 600"
                    class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">Bài viết<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="margin-top: 40px; ">
                    <li style="padding-bottom: 8px;">
                        <a style="text-decoration: none; margin-left: 20px; color: black;"
                            href="../article/article.php">Quản lý bài viết</a>
                    </li>
                    <li>
                        <a style="text-decoration: none; margin-left: 20px; color: black;"
                            href="../article/add_article.php">Thêm bài viết</a>
                    </li>
                </ul>
            </li>

        </ul>
        <li style="margin-right: 40px; list-style:none " class="dropdown">
            <a href="#" style="text-decoration: none ;color: white; padding-left: 50px;" class="dropdown-toggle"
                data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span
                    class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a style="text-decoration: none; margin-left: 20px; color: black;" href="#">Đăng xuất</a>
                </li>
            </ul>
        </li>
    </nav>

    <!-- Main  -->
    <main class="container-fluid">
        <?php if (isset($error)): ?>
            <div class="row">
                <div class="col-md-4 notice-input-category">
                    <div class="alert alert-danger">
                        <strong>Lỗi!</strong>
                        <?php echo $error; ?>
                        <button style="margin-left: 200px;" type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php if (isset($success)): ?>
            <div class="row">
                <div class="col-md-4 notice-input-category">
                    <div class="alert alert-success">
                        <strong>
                            <?php echo $success ?>
                        </strong>
                        <button style="margin-left: 180px;" type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <form class="form-inline" method="POST" action="" role="form">
            <div class="form-group input_category_group">
                <input class="form-control input_category" type="text" name="category_name"
                    placeholder="Nhập tên danh mục">
            </div>
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </form>
        <hr>

        <?php if (!empty($categories)): ?>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <td class="col-6">Tên danh mục</td>
                                <td class="col-2" style="padding-left: 34px" colspan="2">Quản lý</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $row): ?>
                                <tr>
                                    <th>
                                        <?php echo $row['category_id'] ?>
                                    </th>
                                    <td>
                                        <?php echo $row['category_name'] ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" id="delete_category"
                                            href="./delete_category.php?id=<?php echo $row['category_id']; ?>">Xóa
                                        </a>
                                        <a class="btn btn-primary" id="update_category"
                                            href="./update_category.php?id=<?php echo $row['category_id']; ?>">Sửa
                                        </a>
                                    </td>


                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif ?>


      




    </main>
    <script>

    </script>









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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>





</body>

</html>