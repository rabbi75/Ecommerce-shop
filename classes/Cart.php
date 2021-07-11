<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	
class Cart{
	
	private $db;
	private $fm;

	public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	public function addToCart($quantity,$id){
		$quantity=$this->fm->validation($quantity);
		$quantity=mysqli_real_escape_string($this->db->link,$quantity);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sid=session_id();

		$sql = "SELECT * FROM tbl_product WHERE productid='$id'";
		$result=$this ->db->select($sql)->fetch_assoc();
		$productid=$result['productid'];
		$productname=$result['productname'];
		$price=$result['price'];
		$image=$result['image'];

		$check="SELECT * FROM tbl_cart WHERE productid='$id' AND sid='$sid' AND quantity='$quantity'";
		$getprod=$this ->db->select($check);
		if ($getprod) {
			$msg="<span class='success'>Product already Added !</span>";
			return $msg;
		}else{
			$query="INSERT INTO tbl_cart(sid,productid,productname,price,quantity,image)VALUES('$sid','$productid','$productname','$price','$quantity','$image')";
			$Insertrow=$this ->db->insert($query);
			if ($Insertrow) {
				header("location:cart.php");
			}else{
				header("location:404.php");
			}
		}
	}


	public function getCartProduct(){
		$sid=session_id();
		$sql="SELECT * FROM tbl_cart WHERE sid ='$sid' ";
		$result=$this ->db->select($sql);
    	return $result;
	}

	public function updateCartQuantity($cartid,$quantity){
		$cartid=$this->fm->validation($cartid);
		$quantity=$this->fm->validation($quantity);
		$cartid=mysqli_real_escape_string($this->db->link,$cartid);
		$quantity=mysqli_real_escape_string($this->db->link,$quantity);
		if ($quantity<=0) {
			$sql = "DELETE FROM tbl_cart WHERE cartid='$cartid'";
			$Delete_cart=$this ->db->delete($sql);
		}

		$sql="UPDATE `tbl_cart` SET `quantity` = '$quantity' WHERE `cartid` = '$cartid'";
		$updated_row=$this ->db->update($sql);
			if ($updated_row) {
				header("location:cart.php");
			}else{
				$msg="<span class='error'>Quantity Not Updated.</span>";
				return $msg;
			}
	}


	public function delCartById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
    	$sql = "DELETE FROM tbl_cart WHERE cartid='$id'";
    	$Delete_row=$this ->db->delete($sql);
			if ($Delete_row) {
				echo "<script>window.location = 'cart.php';</script>";
			}else{
				$msg="<span class='error'>Product Not Deleted.</span>";
				return $msg;
			}
	}

	public function checkCartTable(){
		$sid=session_id();
		$sql="SELECT * FROM tbl_cart WHERE sid ='$sid' ";
		$Result=$this ->db->select($sql);
		return $Result;
	}


	public function delCustomerCart(){
		$sid=session_id();
		$sql = "DELETE FROM tbl_cart WHERE sid='$sid'";
		$Result=$this ->db->delete($sql);
	}  

	public function orderProduct($id){
		$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sid=session_id();
		$sql="SELECT * FROM tbl_cart WHERE sid ='$sid' ";
		$Getpro=$this ->db->select($sql);
		if ($Getpro) {
			while ($result=$Getpro->fetch_assoc()) {
				$productid=$result['productid'];
            	$productname=$result['productname'];
            	$quantity=$result['quantity'];
            	$price=$result['price'] * $quantity;
            	$image=$result['image'];
            	$query = "INSERT INTO tbl_order(cmrid,productid,productname,quantity,price,image)VALUES('$id','$productid','$productname','$quantity','$price','$image')";
            	$insert_row=$this ->db->delete($query);
			}
		}
	}

	public function payableAmount($id){
		$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sql="SELECT price FROM tbl_order WHERE cmrid='$id' AND date=now()";
		$Result=$this ->db->select($sql);
		return $Result;
	}

	public function getOrderProduct($id){
		$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sql="SELECT * FROM tbl_order WHERE cmrid ='$id' ORDER BY date DESC ";
		$Result=$this ->db->select($sql);
		return $Result;
	}

	public function checkOrderTable($id){
		$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sql="SELECT * FROM tbl_order WHERE cmrid='$id'";
		$Result=$this ->db->select($sql);
		return $Result;
	}

	public function getAllOrderProduct(){
		$sql="SELECT * FROM tbl_order ORDER BY date DESC";
		$Result=$this ->db->select($sql);
		return $Result;
	}

	public function productShifted($id,$sid,$time,$price){
		$id=$this->fm->validation($id);
		$sid=$this->fm->validation($sid);
		$time=$this->fm->validation($time);
		$price=$this->fm->validation($price);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sid=mysqli_real_escape_string($this->db->link,$sid);
		$time=mysqli_real_escape_string($this->db->link,$time);
		$price=mysqli_real_escape_string($this->db->link,$price);
		$sql ="UPDATE `tbl_order` SET `status` = '1' WHERE id='$id' AND `cmrid` = '$sid' AND date='$time' AND price='$price'";
		$Result=$this ->db->update($sql);
		if ($Result) {
				$msg="<span class='success'>Updated Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Not Updated.</span>";
				return $msg;
			}
	}


	public function deleteOrder($did,$dsid,$time,$price){
		$did=$this->fm->validation($did);
		$dsid=$this->fm->validation($dsid);
		$time=$this->fm->validation($time);
		$price=$this->fm->validation($price);
		$did=mysqli_real_escape_string($this->db->link,$did);
		$dsid=mysqli_real_escape_string($this->db->link,$dsid);
		$time=mysqli_real_escape_string($this->db->link,$time);
		$price=mysqli_real_escape_string($this->db->link,$price);
		$sql ="DELETE FROM `tbl_order` WHERE id='$did' AND `cmrid` = '$dsid' AND date='$time' AND price='$price'";
		$Result=$this ->db->delete($sql);
		if ($Result) {
				$msg="<span class='success'>Delete Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Not Deleted.</span>";
				return $msg;
			}
	}

	public function productShiftConfirm($id,$sid,$time,$price){
		$id=$this->fm->validation($id);
		$sid=$this->fm->validation($sid);
		$time=$this->fm->validation($time);
		$price=$this->fm->validation($price);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sid=mysqli_real_escape_string($this->db->link,$sid);
		$time=mysqli_real_escape_string($this->db->link,$time);
		$price=mysqli_real_escape_string($this->db->link,$price);
		$sql ="UPDATE `tbl_order` SET `status` = '2' WHERE id='$id' AND `cmrid` = '$sid' AND date='$time' AND price='$price'";
		$Result=$this ->db->update($sql);
		if ($Result) {
				$msg="<span class='success'>Updated Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Not Updated.</span>";
				return $msg;
			}
	}

}
?>
