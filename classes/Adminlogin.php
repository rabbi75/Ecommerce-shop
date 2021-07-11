<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php
/**
 * Adminlogin class
 */
class Adminlogin{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function adminLogin($adminName,$adminPass){
		$adminName=$this->fm->validation($adminName);
		$adminPass=$this->fm->validation($adminPass);

		$adminName=mysqli_real_escape_string($this->db->link,$adminName);
		$adminPass=mysqli_real_escape_string($this->db->link,$adminPass);

		if (empty($adminName) || empty($adminPass)) {
			$loginmsg="Username or Password must not be empty !";
			return $loginmsg;
		}else{
			$query="SELECT * FROM tbl_admin WHERE adminname='$adminName' AND adminpass='$adminPass'";
			$result=$this->db->select($query);
			if ($result != false) {
				$value=$result->fetch_assoc();
				Session::set("adminlogin", true);
				Session::set("adminid", $value['adminid']);
				Session::set("adminname", $value['adminname']);
				Session::set("adminuser", $value['adminuser']);
				header("location:Dashbord.php");
			}else{
				$loginmsg="Username or Password not match !";
				return $loginmsg;
			}
		}
	}

}

?>