<?php
include 'inc/header.php'
?>
<?php
$customer_id = session::get('customer_id');

if(!isset($customer_id)){
    header('Location:login.php');
}

$ct = new cart();
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted_confirm= $ct->shifted_confirm($id, $time, $price);
}
?>

<style type="text/css">
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }

    .box_right {
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
                    <h3>Order Detail</h3>
                </div>
                <div class="clear"></div>
                <div class="cartpage">
                    <table class="tblone">
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">Product Name</th>
                            <th width="10%">Image</th>
                            <th width="10%">Price</th>
                            <th width="25%">Quantity</th>
                            <th width="10%">status</th>
                            <th width="10%">Date</th>
                            <th width="10%">Action</th>

                        </tr>
                        <?php
                        $customer_id = session::get('customer_id');
                        $getcart_orderdetail = $ct->getcart_orderdetail($customer_id);
                        if ($getcart_orderdetail) {
                            $i = 0;
                            $qty = 0;
                            while ($result = $getcart_orderdetail->fetch_assoc()) {
                                $i++;
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['productName'] ?></td>
                                    <td><img style="width: 60%;height: 60%;" src="admin/upload/<?php echo $result['image']; ?>" alt="" /></td>
                                    <td><?php echo $fm->format_currency($result['price']) ?> vnd</td>
                                    <td><?php echo $result['quantity'] ?></td>
                                    <td>
                                        <?php
                                        if ($result['status'] == '0'){
                                            echo 'Pending';
                                        } elseif ($result['status'] == '1'){
                                        ?>
                                            <span>Shifted</span>
                                        <?php
                                        } else {
                                            echo 'Received';
                                        }
                                        ?>
                                        </td>
                                    <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                    <td><?php
                                        if ($result['status'] == '0'){
                                            echo 'N/A';
                                        } elseif ($result['status'] == '1'){
                                        ?>
                                            <a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price']?>&time=<?php 
                                            echo $result['date_order'] ?>">Confirmed</a>
                                        <?php
                                        } elseif ($result['status'] == '2'){
                                        ?>
                                        <td><?php echo 'Received'; ?></td>
                                        <?php 
                                        } 
                                        ?>
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
        </div>
    </div>
</form>

<?php
include 'inc/footer.php'
?>