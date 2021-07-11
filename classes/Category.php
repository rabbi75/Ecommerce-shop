<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	
class Category{
	
	private $db;
	private $fm;

	public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	public function catInsert($catname){
		$catname=$this->fm->validation($catname);
		$catname=mysqli_real_escape_string($this->db->link,$catname);
		if (empty($catname)) {
			$msg="<span class='error'>Category field must not be empty !</span>";
			return $msg;
		}else{
			$query="INSERT INTO tbl_catagory(catname) VALUES('$catname')";
			$catInsert=$this ->db->insert($query);
			if ($catInsert) {
				$msg="<span class='success'>Catagory Inserted Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Catagory Not Inserted.</span>";
				return $msg;
			}
		}
    }

    public function getAllcat(){
    	$sql ="SELECT * FROM `tbl_catagory`ORDER BY catid DESC";
    	$result=$this ->db->select($sql);
    	return $result;
    }

    public function getCatById($id){
    	$sql ="SELECT * FROM `tbl_catagory`WHERE catid='$id'";
    	$result=$this ->db->select($sql);
    	return $result;
    }

    public function upDateCat($catname,$id){
    	$catname=$this->fm->validation($catname);
		$catname=mysqli_real_escape_string($this->db->link,$catname);
		$id=mysqli_real_escape_string($this->db->link,$id);
		if (empty($catname)) {
			$msg="<span class='error'>Category field must not be empty !</span>";
			return $msg;
		}else{
			$sql = "UPDATE `tbl_catagory` SET `catname` = '$catname' WHERE `catid` = '$id'";
			$updated_row=$this ->db->update($sql);
			if ($updated_row) {
				$msg="<span class='success'>Catagory Update Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Catagory Not Updated.</span>";
				return $msg;
			}
		}
    }


    public function delCatById($id){
    	$id=mysqli_real_escape_string($this->db->link,$id);
    	$sql = "DELETE FROM tbl_catagory WHERE catid='$id'";
    	$Delete_row=$this ->db->delete($sql);
			if ($Delete_row) {
				$msg="<span class='success'>Catagory Delete Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Catagory Not Deleted.</span>";
				return $msg;
			}
    }

}
?>