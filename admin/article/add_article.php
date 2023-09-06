<?php
require_once('../core/config.php');


// Select category 
$query = $conn->prepare('SELECT * FROM category');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

// Create 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $image_name = $_FILES['image']['name'];
    $intro = $_POST['intro'];
    $address = $_POST['address'];
}
// (Da check loi)

if (!empty($image_name)) {
    $tmp = $_FILES['image']['tmp_name'];
    $image_name = time() . $image_name;
    $new_path = '../../public/uploads/' . $image_name;

    if (!move_uploaded_file($tmp, $new_path)) {
        $error = 'Upload ảnh thất bại';
    } else {
        move_uploaded_file($tmp, $new_path);

        $query = $conn->prepare('INSERT INTO article(title,summary,content,image,category_id,author,intro,address) VALUES(:title,:summary,:content,:image,:category_id,:author,:intro,:address)');
        $query->bindParam(':title', $title);
        $query->bindParam(':summary', $summary);
        $query->bindParam(':content', $content);
        $query->bindParam(':image', $image_name);
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':author', $author);
        $query->bindParam(':intro', $intro);
        $query->bindParam(':address', $address);

        $query->execute();

        $success = "Thêm bài viết thành công";
    }
}
// else {
//     $error = 'Ảnh không được để trống';
// }

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin - Thêm bài viết</title>
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
                        <a style="text-decoration: none; margin-left: 20px; color: black;" href="./article.php">Quản lý
                            bài viết</a>
                    </li>
                    <li>
                        <a style="text-decoration: none; margin-left: 20px; color: black;" href="">Thêm bài viết</a>
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
                        <button style="margin-left: 170px;" type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div class="row">
            <div class="col-md-12">
                <form action="#" method="POST" role="form" enctype="multipart/form-data">
                    
                    <h4 style="padding-top: 30px">THÊM BÀI VIẾT</h4>
                    <hr>
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề">
                    </div>

                    <div class="form-group">
                        <label for="summary">Tóm tắt</label>
                        <textarea name="summary" id="summary" class="form-control" rows="1" type="text" placeholder="Tóm tắt"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="author">Tác giả</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="Tác giả">
                    </div>

                    <div class="form-group">
                        <label for="intro">Giới thiệu</label>
                        <textarea name="intro" id="intro" class="form-control" rows="1" type="text"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ">
                    </div>


                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content" class="form-control" rows="2" type="text" placeholder="Nội dung bài viết"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Hình ảnh</label>
                        <input name="image" id="image" class="form-control" type="file">
                    </div>


                    <div class="form-group">
                        <label for="category_id">Danh mục </label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Chọn danh mục</option>
                            <?php foreach ($categories as $row): ?>
                                <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    
                    <button style="margin-top: 12px; width:170px" type="submit" class="btn btn-primary">Thêm bài viết mới</button>
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

</html>