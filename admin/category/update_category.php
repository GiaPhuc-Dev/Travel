<?php
require_once('../core/config.php');
$category_id = $_GET['id'];
// Select category 
$query = $conn->prepare('SELECT * FROM category');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);


// Select category
$query = $conn->prepare('SELECT * FROM category WHERE category_id = :category_id');
$query->bindParam(':category_id', $category_id);
$query->execute();
$result = $query->fetch();

// Khi nhan Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    if ($category_name) {
        $query = $conn->prepare('UPDATE category SET category_name = :category_name WHERE category_id = :category_id ');
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':category_name', $category_name);
        $query->execute();

        $success = "Sửa danh mục thành công";
        header("location: ./category.php");
    } else {
        $error = "Sửa danh mục thất bại";
    }
}




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
                <a style="font-weight: 500;color: white" class="nav-link" href="../category/category.php">Quản lý danh
                    mục</a>
            </li>
            <li class="dropdown navbar-item">
                <a href="#"
                    style="text-decoration: none ;color: white; margin-left: 10px; position: absolute; top: 8px; font-weight: 600"
                    class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">Bài viết<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="margin-top: 40px; ">
                    <li style="padding-bottom: 8px;">
                        <a style="text-decoration: none; margin-left: 20px; color: black;"
                            href="../article/article.php">Quản lý
                            bài viết</a>
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

    <main class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" role="form" enctype="multipart/form-data">
                    <center>
                    <br>
                    <h4 style="padding-top: 200px">SỬA DANH MỤC</h4>
                    <div class="form-group">
                        <label  style="padding-bottom: 10px"for="category_name">Tên danh mục</label>
                        
                        <input style=" width:300px" type="text" class="form-control" id="category_name" name="category_name"
                            value="<?php echo $result['category_name']; ?>">
                    </div>
                    <button style="margin-top: 12px;" type="submit" class="btn btn-primary">Sửa danh mục</button>
                    </center>
                </form>
            </div>
        </div>
    </main>







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