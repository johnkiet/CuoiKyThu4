<?php
	include 'inc/header.php'
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>All Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $getallproduct = $product->getallproduct();
                if($getallproduct){
                    while($result = $getallproduct->fetch_assoc()){
            ?>
           <div class="grid_1_of_4 images_1_of_4">
                <a href="detail.php?proID=<?php echo $result['productId'] ?>"><img style="height: 300px;" src="admin/upload/<?php echo $result['product_image']; ?>" alt="" /></a>
                <h2 style="padding-top: 0.5rem; font-size: 18px;"><?php echo $result['productName'] ?></h2>
                <p style="padding: 0px;"><?php echo $fm->textShorten($result['product_desc'],30)?></p>
                <p style="padding: 0px;text-align: center;"><span class="price"><?php echo $fm->format_currency($result['price']) ?>vnd</span></p>
                <div class="button"><span><a href="detail.php?proID=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="">
            <?php 
                $product_all = $product->get_all_product();
                $product_count = mysqli_num_rows($product_all);
                $product_button = $product_count/6;
                $i=1;
                echo '<p>Trang: </p>';
                for($i=1; $i<$product_button; $i++){
                    echo '<a style="margin:0 5px;" href="products.php?trang='.$i.'" >'.$i.'</a>';    
                }
            ?>
        </div>
    </div>
</div>
 <?php
	include 'inc/footer.php'
?>