<?php
include 'inc/header.php'
?>
<?php
if (isset($_GET['proID'])) {
    $customer_id = Session::get('customer_id');
	$proID = $_GET['proID'];
	$deleteWishlist = $product->deleteWishlist($proID, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$updateCart = $ct->updateCart($quantity, $cartId);
}

if(!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Wishlist</h2>
				<table class="tblone">
					<tr>
						<th width="10%">ID Compare</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Action</th>
					</tr>
					<?php
					$customer_id = Session::get('customer_id');
					$get_wishlist = $product->get_wishlist($customer_id);
					if ($get_wishlist) {
						$i = 0;
						while ($result = $get_wishlist->fetch_assoc()) {
							$i ++;
					?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img style="width: 60%;height: 60%;" src="admin/upload/<?php echo $result['image']; ?>" alt="" /></td>
								<td><?php echo $fm->format_currency($result['price']) ?> vnd</td>
								<td>
                                    <a href="?proID=<?php echo $result['productId'] ?>">Remove</a> ||
                                    <a href="detail.php?proID=<?php echo $result['productId'] ?>">Buy</a>
                                </td>
							</tr>
					<?php
						}
					}
					?>
				</table>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php'
?>