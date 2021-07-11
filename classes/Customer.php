<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	
class Customer{
	
	private $db;
	private $fm;

	public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	public function customerRegistration($data){
		$name=$this->fm->validation($data['name']);
		$city=$this->fm->validation($data['city']);
		$zip=$this->fm->validation($data['zip']);
		$email=$this->fm->validation($data['email']);
		$address=$this->fm->validation($data['address']);
		$country=$this->fm->validation($data['country']);
		$phone=$this->fm->validation($data['phone']);
		$password=$this->fm->validation($data['password']);
		$name=mysqli_real_escape_string($this->db->link,$data['name']);
		$city=mysqli_real_escape_string($this->db->link,$data['city']);
		$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		$address=mysqli_real_escape_string($this->db->link,$data['address']);
		$country=mysqli_real_escape_string($this->db->link,$data['country']);
		$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
		$password=mysqli_real_escape_string($this->db->link,md5($data['password']));

        if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == ""){
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
         }
         $mailquery="SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
         $mailchak=$this ->db->select($mailquery);
			if ($mailchak != false) {
				$msg =  "<span class='error'>Email Already Exist !</span>";
            	return $msg;
			}else{
				$query = "INSERT INTO tbl_customer( name,city,zip,email,address,country,phone,password)VALUES('$name','$city','$zip','$email','$address','$country','$phone','$password')";
				$customerInsert=$this ->db->insert($query);
			if ($customerInsert) {
				$msg="<span class='success'>Customer Registration Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Customer Registration Not Inserted.</span>";
				return $msg;
			}
		}
	}

	public function customerLogin($data){
		$email=$this->fm->validation($data['email']);
		$password=$this->fm->validation($data['password']);
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		$password=mysqli_real_escape_string($this->db->link,md5($data['password']));
		if (empty($email) || empty($password)) {
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
        }
        $sql="SELECT * FROM tbl_customer WHERE email = '$email' AND password ='$password'";
        $lresult=$this ->db->select($sql);
		if ($lresult != false) {
			$value=$lresult->fetch_assoc();
			Session::set("cuslogin", true);
			Session::set("cusId", $value['id']);
			Session::set("cusName", $value['name']);
			header("location:cart.php");
		}else{
			$msg="<span class='error'>Email or Password not matched !</span>";
			return $msg;
		}
	}

	public function getCustomerData($id){
		$sql="SELECT * FROM tbl_customer WHERE id = '$id'";
		$Result=$this ->db->select($sql);
		return $Result;
	}

	public function customerUpdate($data, $cusid){
		//$cusid=$this->fm->validation($data['cusid']);
		$name=$this->fm->validation($data['name']);
		$city=$this->fm->validation($data['city']);
		$zip=$this->fm->validation($data['zip']);
		$email=$this->fm->validation($data['email']);
		$address=$this->fm->validation($data['address']);
		$country=$this->fm->validation($data['country']);
		$phone=$this->fm->validation($data['phone']);
		//$cusid=mysqli_real_escape_string($this->db->link,$data['cusid']);
		$name=mysqli_real_escape_string($this->db->link,$data['name']);
		$city=mysqli_real_escape_string($this->db->link,$data['city']);
		$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		$address=mysqli_real_escape_string($this->db->link,$data['address']);
		$country=mysqli_real_escape_string($this->db->link,$data['country']);
		$phone=mysqli_real_escape_string($this->db->link,$data['phone']);

		if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == ""){
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
        }
        $query = "UPDATE tbl_customer SET
              name='$name',
              city='$city',
              zip='$zip',
              email='$email',
              address='$address',
              country='$country',
              phone='$phone'
              WHERE id='$cusid'";
        $customerupdate=$this ->db->update($query);
		if ($customerupdate) {
			$msg="<span class='success'>Customer Details Update Successfully.</span>";
			return $msg;
		}else{
			$msg="<span class='error'>Customer Details Not Updated .</span>";
			return $msg;
		}

	}

	public function getAllCustomerDetails($id){
		$sql="SELECT * FROM tbl_customer WHERE id = '$id'";
		$Result=$this ->db->select($sql);
		return $Result;
	}

	public function customerContact($data){
		$name=$this->fm->validation($data['name']);
		$email=$this->fm->validation($data['email']);
		$phone=$this->fm->validation($data['phone']);
		$body=$this->fm->validation($data['body']);
		$name=mysqli_real_escape_string($this->db->link,$data['name']);
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
		$body=mysqli_real_escape_string($this->db->link,$data['body']);

        if ($name == "" || $email == "" || $phone == "" || $body == ""){
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
         }
				$query = "INSERT INTO tbl_contact(name,email,phone,body)VALUES('$name','$email','$phone','$body')";
				$customerInsert=$this ->db->insert($query);
			if ($customerInsert) {
				$msg="<span class='success'>Message sent.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Message not sent.</span>";
				return $msg;
			}
		}
	
 	
 	public function getAllMessage(){
 		$sql ="SELECT * FROM tbl_contact WHERE status = '0' order by id desc";
    	$result=$this ->db->select($sql);
    	return $result;
 	}
 	public function contactmassage(){
 		$sql ="SELECT * FROM tbl_contact WHERE status = '0'";
    	$result=$this ->db->select($sql);
    	return $result;
 	}


}
?>
