<?php
include 'inc/header.php'
?>
<?php

$ct = new cart();
if (isset($_GET['cartId'])) {
	$id = $_GET['cartId'];
	$deleteCart = $ct->deleteCart($id);
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
				<h2>Your Cart</h2>
				<?php
				if (isset($updateCart)) {
					echo $updateCart;
				}
				?>
				<?php
				if (isset($deleteCart)) {
					echo $deleteCart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$ct = new cart();
					$getproduct_cart = $ct->getproduct_cart();
					$sub_total = 0;
					$qty = 0;
					if ($getproduct_cart) {
						while ($resultcart = $getproduct_cart->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $resultcart['productName'] ?></td>
								<td><img style="width: 60%;height: 60%;" src="admin/upload/<?php echo $resultcart['images']; ?>" alt="" /></td>
								<td><?php echo $fm->format_currency($resultcart['price']) ?> vnd</td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cartId" value="<?php echo $resultcart['cartId'] ?>" />
										<input type="number" name="quantity" value="<?php echo $resultcart['quantity'] ?>" min = "1"/>
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<?php
								$total = $resultcart['price'] * $resultcart['quantity'];
								?>
								<td><?php echo $fm->format_currency($total) ?> vnd</td>
								<td><a onclick="return confirm('Are you want to delete?')" href="?cartId=<?php echo $resultcart['productId'] ?>">Delete</a></td>
							</tr>
					<?php
							$sub_total = $sub_total + $total;
							$qty = $qty + $resultcart['quantity'];
						}
					}
					?>
				</table>
				<?php
                                $check_cart = $ct->getproduct_cart();
                                if($check_cart){
                                    
                                
                                
                            ?>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td><?php 
						Session::set('sum',$sub_total);
						Session::set('qty',$qty);
						echo $fm->format_currency($sub_total)?> vnd</td>
					</tr>
					<tr>
						<th>VAT(10%) : </th>
						<td><?php
							$vat = $sub_total * 0.1;
							echo $fm->format_currency($vat) ?> vnd</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td><?php echo $fm->format_currency($sub_total + $vat) ?> vnd</td>
					</tr>
				</table>

				<?php
				}else{
					echo '<div class="copy_right">
					<p style="font-size: 30px;">Empty Cart </p>
				</div>';
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php'
?>