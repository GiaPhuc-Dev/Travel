<?php
require_once('../admin/core/config.php');

$article_id = $_GET['product'];
// Select article
$query = $conn->prepare('SELECT * FROM article');
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

// Select 1 article
$query = $conn->prepare('SELECT * FROM article WHERE article_id = :article_id');
$query->bindParam(':article_id', $article_id);
$query->execute();
$result = $query->fetch();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <!-- Menu -->
    <?php include("inc/menu.php") ?>

    <div class="main">
        <div class="container-fluid">
            <div class="product_detail">
                <div class="row">
                    <div class="col-8">
                        <div class="product_detail-left">
                            <h1 class="product_detail-title">Chủ đề:
                                <?php echo $result['title'] ?>
                            </h1>
                            <span class="product_detail-time">
                                <i class="fa-solid fa-clock"></i>
                                <?php echo $result['posted'] ?>
                            </span>
                            <h4 class="product_detail-summary-mini">
                                <?php echo $result['summary'] ?>
                            </h4>


                            <div class="product_detail-img-summary">
                                <img class="product_detail-img" src="./uploads/<?php echo $result['image'] ?>">
                                <span>
                                    <?php echo $result['title'] ?> (Tác giả:
                                    <?php echo $result['author'] ?>)
                                </span>
                            </div>
                            <h3 class="product_detail-summary-big">
                                <?php echo $result['intro'] ?>
                            </h3>
                            <div class="product_detail-info">
                                <h1 class="product_detail-info-title">Thông tin chính</h1>
                                <span class="product_detail-info-content">
                                    <h6 class="product_detail-info-content-fullname">Tên đầy đủ:
                                        <?php echo $result['title'] ?>
                                    </h6>
                                    <h6 class="product_detail-info-content-address">Địa chỉ:
                                        <?php echo $result['address'] ?>
                                    </h6>
                                    <h6 class="product_detail-info-content-origin-name">Nội dung:
                                        <?php echo $result['content'] ?>
                                    </h6>
                                </span>
                            </div>
                            <div class="product_detail-img">
                                <h1 class="product_detail-img-title">Hướng dẫn di chuyển</h1>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.0497414847864!2d104.9680703148348!3d10.41762426856229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109f9f2fcc8a1db%3A0xee50f59e5d6acbfd!2z4bqkcCBUw7QgSOG6oSwgeMOjIE7DumkgVMO0LCBodXnhu4duIFRyaSBUw7RuLCB04buJbmggQW4gR2lhbmc!5e0!3m2!1svi!2s!4v1678983989276!5m2!1svi!2s"
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="product_detail-right">
                            <h1 class="product-pr">Bài viết dành cho bạn</h1>

                            <?php foreach ($articles as $row): ?>
                                <div class="product-pr-maincontent">
                                    <div class="product-pr-line">
                                        <div class="product-pr-line1"></div>
                                        <div class="product-pr-line2"></div>
                                    </div>

                                    <div class="row product-pr-content">
                                        <div class="col-3">
                                            <a href="?product=<?php echo $row['article_id'] ?>"><img class="product-pr-img"
                                                    src="./uploads/<?php echo $row['image'] ?>"></a>
                                        </div>
                                        <div class="col-9 content_summary">
                                            <?php echo $row['summary'] ?>
                                        </div>

                                    </div>
                                    <div class="product-pr-line3"></div>
                                </div>
                            <?php endforeach ?>





                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="clear"></div>



    <!-- Footer  -->

    <?php include('./inc/footer.php'); ?>




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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
</body>

</html>