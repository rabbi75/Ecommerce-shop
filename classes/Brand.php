<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
class Brand{
	
	private $db;
	private $fm;

	public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	public function BrandInsert($brandname){
		$brandname=$this->fm->validation($brandname);
		$brandname=mysqli_real_escape_string($this->db->link,$brandname);
		if (empty($brandname)) {
			$msg="<span class='error'>Brand field must not be empty !</span>";
			return $msg;
		}else{
			$query="INSERT INTO tbl_brand(brandname) VALUES('$brandname')";
			$catInsert=$this ->db->insert($query);
			if ($catInsert) {
				$msg="<span class='success'>Brand Inserted Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Brand Not Inserted.</span>";
				return $msg;
			}
		}
	}

	public function getAllbrand(){
    	$sql ="SELECT * FROM `tbl_brand`ORDER BY brandid DESC";
    	$result=$this ->db->select($sql);
    	return $result;
    }

    public function getBrandById($id){
    	$sql ="SELECT * FROM `tbl_brand` WHERE brandid='$id'";
    	$result=$this ->db->select($sql);
    	return $result;
    }

    public function upDateBrand($brandname,$id){
    	$brandname=$this->fm->validation($brandname);
		$brandname=mysqli_real_escape_string($this->db->link,$brandname);
		$id=mysqli_real_escape_string($this->db->link,$id);
		if (empty($brandname)) {
			$msg="<span class='error'>Brand field must not be empty !</span>";
			return $msg;
		}else{
			$sql = "UPDATE `tbl_brand` SET `brandname` = '$brandname' WHERE `brandid` = '$id'";
			$updated_row=$this ->db->update($sql);
			if ($updated_row) {
				$msg="<span class='success'>Brand Update Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Brand Not Updated.</span>";
				return $msg;
			}
		}
    }

    public function delbrandById($id){
    	$id=mysqli_real_escape_string($this->db->link,$id);
    	$sql = "DELETE FROM tbl_brand WHERE brandid='$id'";
    	$Delete_row=$this ->db->delete($sql);
			if ($Delete_row) {
				$msg="<span class='success'>Brand Delete Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Brand Not Deleted.</span>";
				return $msg;
			}
    }



}

?>