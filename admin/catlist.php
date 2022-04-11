<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$category = new category();
if (isset($_GET['delId'])) {
	$id = $_GET['delId'];
	$delete_category = $category->deletecategory($id);
} else {
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>

		<div class="block">
			<?php
			if (isset($delete_category)) {
				echo $delete_category;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$show_cate = $category->show_category();
					if ($show_cate) {
						$i = 0;
						while ($result = $show_cate->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['categoryName']; ?></td>
								<td><a href="categoryedit.php?categoryId=<?php echo $result['categoryId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')" href="?delId=<?php echo $result['categoryId'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>