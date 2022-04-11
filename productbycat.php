<?php
include 'inc/header.php'
?>
<?php
if (isset($_GET['cateId']) && $_GET['cateId'] != NULL) {
	$id = $_GET['cateId'];
} else {
	echo "<script>window.location = '404.php'</script>";
}


?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
			<?php
			$getNamebycategory = $category->getNamebycategory($id);
			if ($getNamebycategory) {
				while ($result_namecate = $getNamebycategory->fetch_assoc()) {
			?>
				<h3>Product from: <?php echo $result_namecate['categoryName'] ?></h3>
				<?php
				}
			}
			?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getproductbycategory = $category->getproductbycategory($id);
			if ($getproductbycategory) {
				while ($result_allproductcate = $getproductbycategory->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
                <a href="detail.php?proID=<?php echo $result_allproductcate['productId'] ?>"><img style="height: 300px;" src="admin/upload/<?php echo $result_allproductcate['product_image']; ?>" alt="" /></a>
                <h2 style="padding-top: 0.5rem; font-size: 18px;"><?php echo $result_allproductcate['productName'] ?></h2>
                <p style="padding: 0px;"><?php echo $fm->textShorten($result_allproductcate['product_desc'],30)?></p>
                <p style="padding: 0px;text-align: center;"><span class="price"> <?php echo $fm->format_currency($result_allproductcate['price']) ?>vnd</span></p>
                <div class="button"><span><a href="detail.php?proID=<?php echo $result_allproductcate['productId'] ?>" class="details">Details</a></span></div>
            </div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php
include 'inc/footer.php'
?>