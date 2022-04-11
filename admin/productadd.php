<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php
    $pd = new product();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $insert_product = $pd->insert_product($_POST, $_FILES);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
        <?php
					if(isset($insert_product)){
						echo $insert_product;
					}
				?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Select Category</option>
                                <?php
                                $category = new category();
					$show_category = $category->show_category();
					if ($show_category) {
						$i = 0;
						while ($result = $show_category->fetch_assoc()) {
							$i++;

					?>
							<option value="<?php echo $result['categoryId'] ?>"><?php echo $result['categoryName'] ?></option>
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
							<option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
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
                            <textarea name="product_desc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input name="price" type="text" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
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
                                <option value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add" />
                        </td>
                    </tr>
                </table>
            </form>
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