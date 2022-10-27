<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

?>
<?php

$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

	$UpdateCustomers = $cs->update_customers($_POST, $id);
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="content_top">
				<div class="heading">
					<h3>Cập nhật thông tin cá nhân</h3>
				</div>
				<div class="clear"></div>
			</div>
			<form action="" method="post">
				<table class="tblone">
					<tr>

						<?php
						if (isset($UpdateCustomers)) {
							echo '<td colspan="3">' . $UpdateCustomers . '</td>';
						}
						?>

					</tr>
					<?php
					$id = Session::get('customer_id');
					$get_customers = $cs->show_customers($id);
					if ($get_customers) {
						while ($result = $get_customers->fetch_assoc()) {

					?>
							<tr>
								<td>Tên</td>
								<td>:</td>
								<td><input class="form-control" type="text" name="name" value="<?php echo $result['name'] ?>"></td>
							</tr>
							<tr>
								<td>Số điện thoại</td>
								<td>:</td>
								<td><input class="form-control" type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>

							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><input class="form-control" type="text" readonly name="email" value="<?php echo $result['email'] ?>"></td>

							</tr>
							<tr>
								<td>Địa chỉ</td>
								<td>:</td>
								<td><input class="form-control" type="text" name="address" value="<?php echo $result['address'] ?>"></td>

							</tr>
							<tr>
								<td colspan="3"><input class="btn" type="submit" name="save" value="Lưu"></td>

							</tr>

					<?php
						}
					}
					?>
				</table>
			</form>
		</div>
	</div>
	<?php
	include 'inc/footer.php';

	?>