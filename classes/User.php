<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	
class User{
	
	private $db;
	private $fm;

	public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	public function adminAdd($data){
		$adminname=$this->fm->validation($data['adminname']);
		$adminuser=$this->fm->validation($data['adminuser']);
		$adminemail=$this->fm->validation($data['adminemail']);
		$adminpass=$this->fm->validation($data['adminpass']);
		$cadminpass=$this->fm->validation($data['cadminpass']);
		$level=$this->fm->validation($data['level']);
		$adminname=mysqli_real_escape_string($this->db->link,$data['adminname']);
		$adminuser=mysqli_real_escape_string($this->db->link,$data['adminuser']);
		$adminemail=mysqli_real_escape_string($this->db->link,$data['adminemail']);
		$adminpass=mysqli_real_escape_string($this->db->link,md5($data['adminpass']));
		$cadminpass=mysqli_real_escape_string($this->db->link,md5($data['cadminpass']));
		$level=mysqli_real_escape_string($this->db->link,$data['level']);

        if ($adminname == "" OR $adminuser == "" || $adminemail == "" || $adminpass == "" || $cadminpass == "" || $level == ""){
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
         }
          if ($adminpass!=$cadminpass) {
               $msg =  "<span class='error'>Your Password And Confirm Password Not Match!</span>";
             return $msg;
             }
         $mailquery="SELECT * FROM tbl_admin WHERE adminemail = '$adminemail' LIMIT 1";
         $mailchak=$this ->db->select($mailquery);
			if ($mailchak != false) {
				$msg =  "<span class='error'>Email Already Exist !</span>";
            	return $msg;
			}else{
				$query = "INSERT INTO tbl_admin( adminname,adminuser,adminemail,adminpass,level)VALUES('$adminname','$adminuser','$adminemail','$adminpass','$level')";
				$customerInsert=$this ->db->insert($query);
			if ($customerInsert) {
				$msg="<span class='success'>Admin Registration Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>admin Registration Not Inserted.</span>";
				return $msg;
			}
		}
    }

    public function getAllUser(){
    	$sql ="SELECT * FROM `tbl_admin`ORDER BY adminid DESC";
    	$result=$this ->db->select($sql);
    	return $result;
    }

    public function getAllUserDetails($id){
    	$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);
    	$query="SELECT * FROM tbl_admin WHERE adminid = '$id'";
    	$result=$this ->db->select($query);
    	return $result;
    }

    public function upDateUser($data,$adminid){
    	$adminname=$this->fm->validation($data['adminname']);
    	$adminuser=$this->fm->validation($data['adminuser']);
		$adminemail=$this->fm->validation($data['adminemail']);
		$admindetails=$this->fm->validation($data['admindetails']);
		$level=$this->fm->validation($data['level']);
		$adminname=mysqli_real_escape_string($this->db->link,$data['adminname']);
		$adminuser=mysqli_real_escape_string($this->db->link,$data['adminuser']);
		$adminemail=mysqli_real_escape_string($this->db->link,$data['adminemail']);
		$admindetails=mysqli_real_escape_string($this->db->link,$data['admindetails']);
		$level=mysqli_real_escape_string($this->db->link,$data['level']);

		if ($adminname == "" || $adminuser == "" || $adminemail == "" || $admindetails == "" || $level == "" ){
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
        }
        $query = "UPDATE tbl_admin SET
              adminname='$adminname',
              adminuser='$adminuser',
              adminemail='$adminemail',
              admindetails='$admindetails',
              level='$level'
              WHERE adminid='$adminid'";
        $uawerupdate=$this ->db->update($query);
		if ($uawerupdate) {
			$msg="<span class='success'>User Update Successfully.</span>";
			return $msg;
		}else{
			$msg="<span class='error'>User Not Updated .</span>";
			return $msg;
		}

    }



}
?>