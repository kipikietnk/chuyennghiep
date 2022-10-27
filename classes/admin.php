<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class admin
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert_admin($adminName, $adminEmail, $adminUser, $adminPass, $level)
	{

		$brandName = $this->fm->validation($adminName);
		$adminEmail = $this->fm->validation($adminEmail);
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);
		$level = $this->fm->validation($level);
		$adminName = mysqli_real_escape_string($this->db->link, $adminName);
		$adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
		$level = mysqli_real_escape_string($this->db->link, $level);

		if (empty($adminUser)) {
			$alert = "<span class='error'>Nhập tài khoản</span>";
			return $alert;
		} else {
			$query = "INSERT INTO tbl_admin(adminName, adminEmail, adminUser, adminPass, level) VALUES('$adminName','$adminEmail','$adminUser','$adminPass','$level')";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>Thêm QTV thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thêm QTV không thành công</span>";
				return $alert;
			}
		}
	}
	public function show_admin()
	{
		$query = "SELECT * FROM tbl_admin order by level asc";
		$result = $this->db->select($query);
		return $result;
	}


	public function update_admin($oldpw, $newpw)
	{
		$adminId = Session::get('adminId');
		$oldpw = md5($this->fm->validation($oldpw));
		$newpw = md5($this->fm->validation($newpw));

		$oldpw = mysqli_real_escape_string($this->db->link, $oldpw);
		$newpw = mysqli_real_escape_string($this->db->link, $newpw);

		if (empty($oldpw) || empty($newpw)) {
			$alert = "Điền đủ thông tin ";
			return $alert;
		} else {
			$query = "SELECT * FROM tbl_admin WHERE adminId = '$adminId' AND adminPass = '$oldpw'";
			$result = $this->db->select($query);
			if ($result) {
				$update_query = "UPDATE tbl_admin SET adminPass = '$newpw' WHERE adminId = '$adminId'";
				$result1 = $this->db->update($update_query);
				if ($result1) {
					$alert = "<span class='success'>Cập nhật mật khẩu thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Cập nhật không thành công</span>";
					return $alert;
				}
			} else {
				$alert = "<span class='error'>Mật khẩu cũ không đúng</span>";
				return $alert;
			}
		}
	}
	public function del_admin($id)
	{
		$query = "DELETE FROM tbl_admin where adminId = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa QTV thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Xóa QTV không thành công</span>";
			return $alert;
		}
	}
}
?>