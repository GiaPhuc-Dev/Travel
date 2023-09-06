<?php
require_once('../admin/core/config.php');
// Lay tat ca bai viet
$query = $conn->prepare('SELECT * FROM article');
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);


// Lay tat ca bai viet dua theo danh muc 
$query_1 = $conn->prepare('SELECT * FROM article WHERE category_id = :category_id');
$query_1->bindParam(':category_id', $_GET['filter']);
$query_1->execute();
$articles_1 = $query_1->fetchAll(PDO::FETCH_ASSOC);


// Lay tat ca danh muc
$query_2 = $conn->prepare('SELECT * FROM category');
$query_2->execute();
$categories = $query_2->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Khám phá</title>
	<link rel="stylesheet" href="./assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
	<!-- Menu -->
	<?php include("inc/menu.php") ?>

	<div class="main">
		<div class="container">
			<div class="product">
				<div class="product_main">
					<div class="product_welcome">
						<h3>An Giang có những gì? Hãy cùng chúng mình <span style="color: #6ada4f">khám phá </span> nhé!
						</h3>
					</div>
					<div class="product_list">
						<div class="container">
							<div class="product_list-menu">
								<ul class="product_list-menu-list">
									<li class="product_list-menu-title">
										<a href="./product.php">Tất cả</a>
									</li>

									<?php foreach ($categories as $row): ?>
										<li class="product_list-menu-title">
											<a href="?filter=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a>
										</li>
									<?php endforeach ?>

								</ul>
							</div>
							<div class="clear"></div>
							<div class="product_list-item">
								<ul style="list-style: none;">
									<?php if (!isset($_GET['filter'])){ ?>
										<?php foreach ($articles as $row): ?>
											<li class="product_list-item-card">
												<img src="./uploads/<?php echo $row['image'] ?>"
													class="product_list-item-card-img">

												</img>
												<div class="product_list-item-card-title">
													<span>
														<?php echo $row['title'] ?>
													</span>
												</div>
												<div class="product_list-item-card-title-text-info">
													<span class="product_list-item-card-title-text-info-mini">
														<?php echo $row['summary'] ?>
													</span>
												</div>
												<div class="product_list-item-card-title-btn">
													<a href="product_detail.php?product=<?php echo $row['article_id'] ?>">
														<button class="btn btn-primary">Xem thêm</button>
													</a>

												</div>
											</li>
										<?php endforeach ?>
									<?php }else if(isset($_GET['filter'])){ ?>
										<?php foreach ($articles_1 as $row): ?>
											<li class="product_list-item-card">
												<img src="./uploads/<?php echo $row['image'] ?>"
													class="product_list-item-card-img">

												</img>
												<div class="product_list-item-card-title">
													<span>
														<?php echo $row['title'] ?>
													</span>
												</div>
												<div class="product_list-item-card-title-text-info">
													<span class="product_list-item-card-title-text-info-mini">
														<?php echo $row['summary'] ?>
													</span>
												</div>
												<div class="product_list-item-card-title-btn">
													<a href="product_detail.php?product=<?php echo $row['article_id'] ?>">
														<button class="btn btn-primary">Xem thêm</button>
													</a>

												</div>
											</li>
										<?php endforeach ?>
									<?php } ?>
								
								</ul>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<div class="clear"></div>
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