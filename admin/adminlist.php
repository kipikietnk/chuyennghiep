<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/admin.php' ?>
<?php
$admin = new admin();
if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$deladmin = $admin->del_admin($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách quản trị viên</h2>
		<div class="block">
			<?php

			if (isset($deladmin)) {
				echo $deladmin;
			}

			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</oth>
						<th>Tên</th>
						<th>Email</th>
						<th>Quyền</th>
						<th>Tháo tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_admin = $admin->show_admin();
					if ($show_admin) {
						$i = 0;
						while ($result = $show_admin->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['adminName'] ?></td>
								<td><?php echo $result['adminEmail'] ?></td>
								<td>
									<?php if ($result['level'] == 1){echo 'Nhân viên';}else{echo 'Quản lý';}  ?>
								</td>
								<td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="?delid=<?php echo $result['adminId'] ?>">Xóa</a></td>
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