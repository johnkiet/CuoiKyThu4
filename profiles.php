<?php
include 'inc/header.php'
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Profiles</h3>
                </div>
                <div class="clear"></div>
            </div>

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
<?php
include 'inc/footer.php'
?>