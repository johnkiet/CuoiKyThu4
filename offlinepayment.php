<?php
include 'inc/header.php'
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] =='order') {
	$customer_id = session::get('customer_id');
    $insert_Order = $ct->insertOrder($customer_id);
    $deleteCart = $ct->deleteCartSS();
    header('Location:success.php');
}

?>
<style type="text/css">
	.box_left {
		width: 50%;
		border: 1px solid #666;
		float: left;
		padding: 4px;
	}
	.box_right{
		width: 47%;
		border: 1px solid #666;
		float: right;
		padding: 4px;
	}
    a.a_order {
        background: red;
        padding: 7px 20px;
        color: #fff;
        font-size: 21px;
    }
</style>
<form action="" method="POST">
<div class="main">
	<div class="content">
		<div class="section group">
			
        <div class="heading">
                <h3>Offline Payment</h3>
                </div>
                <div class="clear"></div>
				<div class="box_left">
				<div class="cartpage">
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
                        <th width="5%">ID</th>
						<th width="15%">Product Name</th>
						
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						
					</tr>
					<?php
					$getproduct_cart = $ct->getproduct_cart();
					$sub_total = 0;
					$qty = 0;
                    $i=0;
					if ($getproduct_cart) {
						while ($resultcart = $getproduct_cart->fetch_assoc()) {
                            $i++;
					?>
							<tr>
                            <td><?php echo $i; ?></td>
								<td><?php echo $resultcart['productName'] ?></td>
								<td><?php echo $fm->format_currency($resultcart['price']) ?> vnd</td>
								<td>
									
										
                                    <?php echo $resultcart['quantity'] ?>
										
									</form>
								</td>
								<?php
								$total = $resultcart['price'] * $resultcart['quantity'];
								?>
								<td><?php echo $fm->format_currency($total)   ?> vnd</td>
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
				<table style="float:right;text-align:left; margin: 5px" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td><?php 
						Session::set('sum',$sub_total);
						Session::set('qty',$qty);
						echo $fm->format_currency($sub_total) ?> vnd</td>
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
                    <tr>
					
				</table>

				<?php
				}else{
					echo '<div class="copy_right">
					<p style="font-size: 30px;">Empty Cart </p>
				</div>';
				}
				?>
			</div>
				</div>
				<div class="box_right">
                <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $customer->show_customers($id);
                if ($get_customers) {
                    while ($resultI4 = $get_customers->fetch_assoc()) {
                ?>
                        <tr>
                            <td>Name: </td>
                            <td><?php echo $resultI4['name'] ?> </td>
                        </tr>
                        <tr>
                            <td>Phone: </td>
                            <td><?php echo $resultI4['phone'] ?> </td>
                        </tr>
                        <tr>
                            <td>Address: </td>
                            <td><?php 
                            $Address = $resultI4['address'].', '.$resultI4['city'].', '.$resultI4['country'];
                            echo $Address; 
                            ?> 
                            </td>
                        </tr>
                        <tr>
                            <td>ZipCode: </td>
                            <td><?php echo $resultI4['zip_code'] ?> </td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><?php echo $resultI4['email'] ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="updateprofile.php">Update Profiles</a></td>
                        </tr>
                        
                <?php
                    }
                }
                ?>
            </table>
				</div>
    	
		</div>
	</div>
  <center>  <a href="?orderid=order" class="a_order" >Order Now</a></center>
</div>
</form>
<?php
include 'inc/footer.php'
?>