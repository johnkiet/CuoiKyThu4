<?php
include 'inc/header.php'
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$insert_customer = $customer->insert_customer($_POST);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
	$login_customer = $customer->login_customer($_POST);
}
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check) {
	header('Location:cart.php');
}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<?php
			if (isset($login_customer)) {
				echo $login_customer;
			}
			?>
			<form action="" method="POST">
				<input type="text" name="Username" class="field" placeholder="Enter E-mail...">
				<input type="password" name="PasswordLG" class="field" placeholder="Enter Password...">
				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons">
					<div><input type="submit" name="login" value="Sign In" class="btn btn-outline-secondary"></input></div>
				</div>
			</form>

		</div>
		<div class="register_account" style="height: 100%;width:63%;">
			<h3>Register New Account</h3>
			<?php
			if (isset($insert_customer)) {
				echo $insert_customer;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div style="width:30%;">
									<input type="text" name="Name" placeholder="Enter Name...">
								</div>

								<div style="width:30%;">
									<input type="text" name="City" placeholder="Enter City...">
								</div>

								<div style="width:30%;">
									<input type="text" name="Zip_Code" placeholder="Enter Zip-Code...">
								</div>
								<div style="width:30%;">
									<input type="text" name="EMail" placeholder="Enter E-Mail...">
								</div>
							</td>
							<td>
								<div style="width:30%;">
									<input type="text" name="Address" placeholder="Enter Address...">
								</div>
								<div style="width:30%;">
									<select id="country" name="Country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="VN">Việt Nam</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>

									</select>
								</div>

								<div style="width:30%;">
									<input type="text" name="Phone" placeholder="Enter Phone...">
								</div>

								<div style="width:30%;">
									<input type="password" name="Password" placeholder="Enter Password...">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="buttons">
					<div><input type="submit" name="submit" class="btn btn-outline-secondary" value="Create Account"></input></div>
				</div>
				<p class="note">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php'
?>