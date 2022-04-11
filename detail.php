<?php
include 'inc/header.php'
?>
<?php
if (isset($_GET['proID']) && $_GET['proID'] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['proID'];
}

$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
	$productid = $_POST['productid'];
	$insertCompare= $product->insertCompare($productid, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist'])) {
	$productid = $_POST['productid'];
	$insertWishlist= $product->insertWishlist($productid, $customer_id);
}

$ct = new cart();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$addCart = $ct->addCart($quantity, $id);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$getproduct_detail = $product->getproduct_detail($id);
			if ($getproduct_detail) {
				while ($resultdetail = $getproduct_detail->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/upload/<?php echo $resultdetail['product_image']; ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $resultdetail['productName'] ?></h2>
							<p><?php echo $fm->textShorten($resultdetail['product_desc'], 30) ?></p>
							<div class="price">
								<p>Price: <span><?php echo $fm->format_currency($resultdetail['price']) ?> vnd</span></p>
								<p>Category: <span><?php echo $resultdetail['categoryName'] ?></span></p>
								<p>Brand:<span><?php echo $resultdetail['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
								<?php
								if (isset($addCart)) {
									echo $addCart;
								}
								
								?>
							</div>
							<div class="add-cart">
								<div class = "button_details">
								<form action="" method="POST">
									<!-- <a href="?wlist=<?php echo $resultdetail['productId'] ?>" class="buysubmit">Save to Wish list</a> -->
									<!-- <a href="?compare=<?php echo $resultdetail['productId'] ?>" class="buysubmit ">Compare product</a> -->
									<input type="hidden" name="productid" value="<?php echo $resultdetail['productId']?>" />	
									
									<?php
                    					$login_check = Session::get('customer_login');
                    					if ($login_check) {
                        					echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product" />';
                    					} else {
											echo'';
										}
                					?>

									<?php
									if (isset($insertCompare)){
										echo $insertCompare;
									}
									?>
								</form>
								<form action="" method="POST">
									<!-- <a href="?wlist=<?php echo $resultdetail['productId'] ?>" class="buysubmit">Save to Wish list</a> -->
									<!-- <a href="?compare=<?php echo $resultdetail['productId'] ?>" class="buysubmit ">Compare product</a> -->
									<input type="hidden" name="productid" value="<?php echo $resultdetail['productId']?>" />	
									
									<?php
                    					$login_check = Session::get('customer_login');
                    					if ($login_check) {
											echo '<input type="submit" class="buysubmit" name="wishlist" value="Save to wishlist" />'; 

                    					} else {
											echo'';
										}
                					?>

									<?php
									if (isset($insertWishlist)){
										echo $insertWishlist;
									}
									?>
								</form>
								</div>

								<div class = "clear">

								</div>
							</div>
						</div>
						<div class="product-desc">
						<h2>Product Details</h2>
						<p><?php echo $resultdetail['product_desc'] ?></p>
					</div>
					</div>
					
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php
							$getallcategory = $category->getallcategory();
							if ($getallcategory) {
								while ($result_allcate = $getallcategory->fetch_assoc()) {
							?>
									<li><a href="productbycat.php?cateId=<?php echo $result_allcate['categoryId'] ?>"><?php echo $result_allcate['categoryName'] ?></a></li>
							<?php
								}
							}
							?>
    				</ul>
    	
 				</div>
		</div>
	</div>
</div>
<?php
include 'inc/footer.php'
?>