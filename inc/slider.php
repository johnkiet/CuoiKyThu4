<div class="header_bottom">

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
    <div class="header_bottom_right_images" style="width:67%;height: max-content;">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <?php 
                    $get_slider = $product-> show_slider();
                    if ($get_slider){
                        while($result_slider = $get_slider -> fetch_assoc()){
                    ?>
                    <li><img src="admin/upload/<?php echo $result_slider['sliderImage']?>" alt="<?php echo $result_slider['sliderName']?>" /></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>