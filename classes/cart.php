<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
?>

<?php
/**
 * 
 */
class cart
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function add_to_cart($quantity, $id)
	{

		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$sId = session_id();
		$check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId ='$sId'";
		$result_check_cart = $this->db->select($check_cart);
		if ($result_check_cart) {
			$msg = "<span class='error'>Sản phẩm đã được thêm vào</span>";
			return $msg;
		} else {
			$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->select($query)->fetch_assoc();

			$image = $result["image"];
			$price = $result["price"];
			$productName = $result["productName"];

			$query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
			$insert_cart = $this->db->insert($query_insert);
			if ($insert_cart) {
				$msg = "<span class='error'>Thêm sản phẩm thành công</span>";
				return $msg;
			}
		}
	}

	public function get_product_cart()
	{
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_quantity_cart($quantity, $cartId)
	{
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$query = "UPDATE tbl_cart SET

					quantity = '$quantity'

					WHERE cartId = '$cartId'";
		$result = $this->db->update($query);
		if ($result) {
			$msg = "<span class='success'>Cập nhật thành công</span>";
			return $msg;
		} else {
			$msg = "<span class='error'>Cập nhật không thành công</span>";
			return $msg;
		}
	}
	public function del_product_cart($cartid)
	{
		$cartid = mysqli_real_escape_string($this->db->link, $cartid);
		$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
		$result = $this->db->delete($query);
		if ($result) {
			$msg = "<span class='success'>Xóa sản phẩm thành công</span>";
			return $msg;
		} else {
			$msg = "<span class='error'>Xóa sản không phẩm thành công</span>";
			return $msg;
		}
	}

	public function check_cart()
	{
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function check_order($customer_id)
	{
		$sId = session_id();
		$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function del_all_data_cart()
	{
		$sId = session_id();
		$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->delete($query);
	}

	public function insertOrder($customer_id)
	{
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$get_product = $this->db->select($query);
		if ($get_product) {
			while ($result = $get_product->fetch_assoc()) {
				$productid = $result['productId'];
				$productName = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'] * $quantity;
				$image = $result['image'];
				$customer_id = $customer_id;
				$query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_id) VALUES('$productid','$productName','$quantity','$price','$image','$customer_id')";
				$insert_order = $this->db->insert($query_order);
			}
		}
	}
	public function getAmountPrice($customer_id)
	{

		$query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
		$get_price = $this->db->select($query);
		return $get_price;
	}
	public function get_cart_ordered($customer_id)
	{
		$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ORDER BY date_order DESC";
		$get_cart_ordered = $this->db->select($query);
		return $get_cart_ordered;
	}
	public function get_inbox_cart()
	{
		$query = "SELECT * FROM tbl_order ORDER BY date_order DESC";
		$get_inbox_cart = $this->db->select($query);
		return $get_inbox_cart;
	}
	public function shifted($id, $time, $price)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$time = mysqli_real_escape_string($this->db->link, $time);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$query = "UPDATE tbl_order SET

					status = '1'

					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
		$result = $this->db->update($query);
		if ($result) {
			$msg = "<span class='success'>Cập nhật hóa đơn thành công</span>";
			return $msg;
		} else {
			$msg = "<span class='error'>Cập nhật hóa đơn không thành công</span>";
			return $msg;
		}
	}
	public function del_shifted($id, $time, $price)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$time = mysqli_real_escape_string($this->db->link, $time);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$query = "DELETE FROM tbl_order 
					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
		$result = $this->db->delete($query);
		if ($result) {
			$msg = "<span class='success'>Xóa đơn hàng thành công</span>";
			return $msg;
		} else {
			$msg = "<span class='error'>Xóa đơn hàng không thành công</span>";
			return $msg;
		}
	}
	public function shifted_confirm($id, $time, $price)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$time = mysqli_real_escape_string($this->db->link, $time);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$query = "UPDATE tbl_order SET

					status = '2'

					WHERE customer_id = '$id' AND date_order='$time' AND price ='$price'";
		$result = $this->db->update($query);
		return $result;
	}
	public function done($price, $quantity){
		$price = mysqli_real_escape_string($this->db->link, $price);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
		$sql_check = "SELECT * FROM tbl_thongke WHERE created_date = '$now'";
		$check = $this->db->select($sql_check);
		if(!$check){
			$sql_done = "INSERT INTO tbl_thongke(created_date, orders, sales, quantity) VALUES('$now','1','$price','$quantity')";
		$result = $this->db->insert($sql_done);

		}else{
			while($row = $check->fetch_assoc()){
				$doanhthu = $row['sales'] + $price;
				$soluong = $row['quantity'] + $quantity;
				$donhang = $row['orders'] + 1;
				$sql_done = "UPDATE tbl_thongke SET orders = '$donhang', sales = '$doanhthu', quantity = '$soluong' WHERE created_date = '$now'";
		$result = $this->db->update($sql_done);
			
			}
		}
		return true;

	}
}
?>