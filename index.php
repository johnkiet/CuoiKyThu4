<?php
	include 'inc/header.php';
	include 'inc/slider.php'
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $getproduct_feature = $product->getproduct_feature();
                if($getproduct_feature){
                    while($result = $getproduct_feature->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="detail.php?proID=<?php echo $result['productId'] ?>"><img style="height: 300px;" src="admin/upload/<?php echo $result['product_image']; ?>" alt="" /></a>
                <h2 style="padding-top: 0.5rem; font-size: 18px;"><?php echo $result['productName'] ?></h2>
                <p style="padding: 0px;"><?php echo $fm->textShorten($result['product_desc'],30)?></p>
                <p style="padding: 0px;text-align: center;"><span class="price"> <?php echo $fm->format_currency($result['price']) ?> vnd</span></p>
                <div class="button"><span><a href="detail.php?proID=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $getproduct_new = $product->getproduct_new();
                if($getproduct_new){
                    while($result = $getproduct_new->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="detail.php?proID=<?php echo $result['productId'] ?>"><img style="height: 300px;" src="admin/upload/<?php echo $result['product_image']; ?>" alt="" /></a>
                <h2 style="padding-top: 0.5rem; font-size: 18px;"><?php echo $result['productName'] ?></h2>
                <p style="padding: 0px;"><?php echo $fm->textShorten($result['product_desc'],30)?></p>
                <p style="padding: 0px; text-align: center;"><span class="price"> <?php echo $fm->format_currency($result['price']) ?> vnd</span></p>
                <div class="button"><span><a href="detail.php?proID=<?php echo $result['productId'] ?>">Details</a></span></div>
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