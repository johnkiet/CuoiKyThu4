<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath . '/../classes/customer.php');
	include_once($filepath . '/../helpers/format.php');  
?>
<?php
    if (isset($_GET['customer_id']) && $_GET['customer_id'] != NULL) {
        $id = $_GET['customer_id'];
    }else{
        echo "<script>window.location = 'inbox.php'</script>";
    }

    $cs = new customer();

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock">
            
            <?php
            $get_customer = $cs->show_customers($id);
            if ($get_customer) {
                $i = 0;
                while ($result = $get_customer->fetch_assoc()) {
                    $i++;

            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>Name</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['name'] ?>" 
                                   class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Phone</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['phone'] ?>" 
                                   class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>City</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['city'] ?>" 
                                   class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Address</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['address'] ?>" 
                                   class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Country</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['country'] ?>" 
                                   class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>ZIP code</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['zip_code'] ?>" 
                                   class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Email</td.\>
                                <td>:</td.\>
                                <td>
                                    <input type="text" readonly="readonly" name="categoryName" value="<?php echo $result['email'] ?>" 
                                   class="medium" />
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
<?php include 'inc/footer.php'; ?>