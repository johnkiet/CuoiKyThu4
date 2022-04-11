<?php
include 'inc/header.php'
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['save'])) {
    $id = Session::get('customer_id'); 
    $update_customers = $customer->update_customers($_POST,$id);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Update Profiles</h3>
                    <?php
			if (isset($update_customers)) {
				echo $update_customers;
			}
			?>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="POST">
                <table class="tblone">
                    <?php
                    $id = Session::get('customer_id');
                    $get_customers = $customer->show_customers($id);
                    if ($get_customers) {
                        while ($resultI4 = $get_customers->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>Name: </td>
                                <td><input type="text" name="name" value="<?php echo $resultI4['name'] ?>"> </td>
                            </tr>
                            <tr>
                                <td>Phone: </td>
                                <td><input type="text" name="phone" value="<?php echo $resultI4['phone'] ?> "> </td>
                            </tr>
                            <tr>
                                <td>Address: </td>
                                <td><input type="text" name="address" value="<?php
                                    $Address = $resultI4['address'];
                                    echo $Address;
                                    ?>"> </td>
                            </tr>
                            <tr>
                                <td>City: </td>
                                <td><input type="text" name="city" value="<?php
                                    $Address = $resultI4['city'];
                                    echo $Address;
                                    ?>"> </td>
                            </tr>
                            <tr>
                                <td>Country: </td>
                                <td><input type="text" name="country" value="<?php
                                    $Address = $resultI4['country'];
                                    echo $Address;
                                    ?>"> </td>
                            </tr>
                            <tr>
                                <td>ZipCode: </td>
                                <td><input type="text" name="zipcode" value="<?php echo $resultI4['zip_code'] ?> "> </td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td><input type="text" name="email" value="<?php echo $resultI4['email'] ?> "> </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="save" value="Save" class="default"></input></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php'
?>