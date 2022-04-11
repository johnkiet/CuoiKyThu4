<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php
if (isset($_GET['productId']) && $_GET['productId'] != NULL) {
    $id = $_GET['productId'];
} else {
    echo "<script>window.location = 'productlist.php'</script>";
}
$pd = new product();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $update_product = $pd->update_product($_POST, $_FILES, $id);
	}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
            <?php
            if (isset($update_product)) {
                echo $update_product;
            }
            ?>
            <?php
            $getproductbyid = $pd->getproductbyid($id);
            if ($getproductbyid) {
                $i = 0;
                while ($result_product = $getproductbyid->fetch_assoc()) {
                    $i++;

            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="category">
                                        <option>Select Brand</option>
                                        <?php
                                        $category = new category();
                                        $show_category = $category->show_category();
                                        if ($show_category) {
                                            $i = 0;
                                            while ($result = $show_category->fetch_assoc()) {
                                                $i++;

                                        ?>
                                                <option <?php
                                                        if ($result['categoryId'] == $result_product['categoryId']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['categoryId'] ?>"><?php echo $result['categoryName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Brand</label>
                                </td>
                                <td>
                                    <select id="select" name="brand">
                                        <option>Select Brand</option>
                                        <?php
                                        $brand = new brand();
                                        $show_brand = $brand->show_brand();
                                        if ($show_brand) {
                                            $i = 0;
                                            while ($result = $show_brand->fetch_assoc()) {
                                                $i++;

                                        ?>
                                                <option <?php
                                                        if ($result['brandId'] == $result_product['brandId']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input name="price" type="text" value="<?php echo $result_product['price'] ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img style="width: 100px; height: 100px;" src="upload/<?php echo $result_product['product_image']; ?>" alt="">
                                    <input name="product_image" type="file" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="product_type">
                                        <option>Select Type</option>
                                        <?php
                                        if ($result_product['product_type'] == 0) {
                                        ?>
                                            <option value="1">Featured</option>
                                            <option selected value="0">Non-Featured</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option selected value="1">Featured</option>
                                            <option value="0">Non-Featured</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>