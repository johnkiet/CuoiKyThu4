<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/category.php';
?>
<?php
    if (isset($_GET['categoryId']) && $_GET['categoryId'] != NULL) {
        $id = $_GET['categoryId'];
    }else{
        echo "<script>window.location = 'catlist.php'</script>";
    }

    $category = new category();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $categoryName =  $_POST['categoryName'];
        $update_category = $category->update_category($id,$categoryName);
    }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock">
            <?php
            if (isset($update_category)) {
                echo $update_category;
            }
            ?>
            <?php
            $getcategorybyid = $category->getcategorybyid($id);
            if ($getcategorybyid) {
                $i = 0;
                while ($result = $getcategorybyid->fetch_assoc()) {
                    $i++;

            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="categoryName" value="<?php echo $result['categoryName'] ?>" class="medium" />
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