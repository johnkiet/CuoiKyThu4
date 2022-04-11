
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/brand.php';
?>
<?php
	$brand = new brand();
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		$brandName =  $_POST['brandName'];
        $insert_brand = $brand->insert_brand($brandName);
	}
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New brand</h2>
               <div class="block copyblock"> 
               <?php
					if(isset($insert_brand)){
						echo $insert_brand;
					}
				?>
                 <form action="brandadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Add" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>