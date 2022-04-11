<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/brand.php';
?>
<?php
if (isset($_GET['brandId']) && $_GET['brandId'] != NULL) {
    $id = $_GET['brandId'];
} else {
    echo "<script>window.location = 'brandlist.php'</script>";
}

$brand = new brand();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brandName =  $_POST['brandName'];
    $update_brand = $brand->update_brand($id, $brandName);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit brand</h2>
        <div class="block copyblock">
            <?php
            if (isset($update_brand)) {
                echo $update_brand;
            }
            ?>
            <?php
            $getbrandbyid = $brand->getbrandbyid($id);
            if ($getbrandbyid) {
                $i = 0;
                while ($result = $getbrandbyid->fetch_assoc()) {
                    $i++;

            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="brandName" value="<?php echo $result['brandName'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
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