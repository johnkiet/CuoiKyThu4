<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/brand.php'; ?>


<?php
$product = new product();
$format = new Format();

if (isset($_GET['proId'])) {
	$id = $_GET['proId'];
	$delete_product = $product->deleteproduct($id);
} else {
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php

			if (isset($delete_product)) {
				echo $delete_product;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Image</th>
						<th>Price</th>
						<th>Description</th>
						<th>Type</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_product = $product->show_product();
					if ($show_product) {
						$i = 0;
						while ($result = $show_product->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $result['productId']; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img style="width: 60px; height: 60px;" src="upload/<?php echo $result['product_image']; ?>" alt=""></td>
								<td><?php echo $fm->format_currency($result['price']); ?> vnd</td>
								<td><?php echo $format->textShorten($result['product_desc'], 50) ?></td>
								<td><?php if ($result['product_type'] == 0) {
										echo 'Non-Feathered';
									} else {
										echo 'Feathered';
									} ?></td>
								<td><?php echo $result['categoryName']; ?></td>
								<td><?php echo $result['brandName']; ?></td>
								<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')" href="?proId=<?php echo $result['productId'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>