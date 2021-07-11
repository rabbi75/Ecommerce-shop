<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	
class Product{
	
	private $db;
	private $fm;

	public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	
	public function ProductInsert($data, $file){
		$productname=$this->fm->validation($data['productname']);
		$catid=$this->fm->validation($data['catid']);
		$brandid=$this->fm->validation($data['brandid']);
		$body=$this->fm->validation($data['body']);
		$price=$this->fm->validation($data['price']);
		$type=$this->fm->validation($data['type']);
		$productname=mysqli_real_escape_string($this->db->link,$data['productname']);
		$catid=mysqli_real_escape_string($this->db->link,$data['catid']);
		$brandid=mysqli_real_escape_string($this->db->link,$data['brandid']);
		$body=mysqli_real_escape_string($this->db->link,$data['body']);
		$price=mysqli_real_escape_string($this->db->link,$data['price']);
		$type=mysqli_real_escape_string($this->db->link,$data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($productname == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == "") {
            $msg =  "<span class='error'>Field must not be empty</span>";
            return $msg;
         }elseif ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
            </span>";
            } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
            .implode(', ', $permited)."</span>";
            } else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product( productname,catid,brandid,body,price,image,type)VALUES('$productname','$catid','$brandid','$body','$price','$uploaded_image','$type')";
            $productInsert=$this ->db->insert($query);
			if ($productInsert) {
				$msg="<span class='success'>Product Inserted Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Product Not Inserted.</span>";
				return $msg;
			}
		}
	}



	public function getAllProdut(){
		$sql ="SELECT tbl_product.*, tbl_catagory.catname, tbl_brand.brandname
					FROM tbl_product
					INNER JOIN tbl_catagory
					ON tbl_product.catid = tbl_catagory.catid
					INNER JOIN tbl_brand
					ON tbl_product.brandid = tbl_brand.brandid
					ORDER BY tbl_product.productid desc";
    	$result=$this ->db->select($sql);
    	return $result;
	}

	public function getProductById($id){
		$sql ="SELECT * FROM `tbl_product` WHERE productid='$id'";
    	$result=$this ->db->select($sql);
    	return $result;
	}


	public function ProductUpdate($data, $file, $id){
		$productname=$this->fm->validation($data['productname']);
		$catid=$this->fm->validation($data['catid']);
		$brandid=$this->fm->validation($data['brandid']);
		$body=$this->fm->validation($data['body']);
		$price=$this->fm->validation($data['price']);
		$type=$this->fm->validation($data['type']);
		$productname=mysqli_real_escape_string($this->db->link,$data['productname']);
		$catid=mysqli_real_escape_string($this->db->link,$data['catid']);
		$brandid=mysqli_real_escape_string($this->db->link,$data['brandid']);
		$body=mysqli_real_escape_string($this->db->link,$data['body']);
		$price=mysqli_real_escape_string($this->db->link,$data['price']);
		$type=mysqli_real_escape_string($this->db->link,$data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($productname == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == "") {
            echo "<span class='error'>Field must not be empty</span>";
         }else{

         if (!empty($file_name)) {
         
          if ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
            </span>";
            } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
            .implode(', ', $permited)."</span>";
            } else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query ="UPDATE tbl_product
                    SET
                    productname = '$productname',
                    catid = '$catid',
                    brandid = '$brandid',
                    body = '$body',
                    price = '$price',
                    image = '$uploaded_image',
                    type = '$type'
                    WHERE productid = '$id'";

            $updated_row=$this ->db->update($query);
			if ($updated_row) {
				$msg="<span class='success'>Product Update Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Product Not Updated.</span>";
				return $msg;
			}
                }


         }else{
             $query ="UPDATE tbl_product
                    SET
                    productname = '$productname',
                    catid = '$catid',
                    brandid = '$brandid',
                    body = '$body',
                    price = '$price',
                    type = '$type'
                    WHERE productid = '$id'";

            $updated_row=$this ->db->update($query);
			if ($updated_row) {
				$msg="<span class='success'>Product Update Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Product Not Updated.</span>";
				return $msg;
			}
         }
       }
	}


	public function delProductById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
    	$sql = "DELETE FROM tbl_product WHERE productid='$id'";
    	$Delete_row=$this ->db->delete($sql);
			if ($Delete_row) {
				$msg="<span class='success'>Product Delete Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Product Not Deleted.</span>";
				return $msg;
			}
	}


	public function getFeaturedProduct(){
		$sql ="SELECT * FROM `tbl_product` WHERE type='0' ORDER BY productid DESC LIMIT 4";
    	$result=$this ->db->select($sql);
    	return $result;
	}

	public function getNewProduct(){
		$sql ="SELECT * FROM `tbl_product` ORDER BY productid DESC LIMIT 4";
    	$result=$this ->db->select($sql);
    	return $result;
	}

	public function getSingleProduct($id){
		$sql ="SELECT p.*,c.catname,b.brandname
    				FROM tbl_product as p, tbl_catagory as c, tbl_brand as b
    				WHERE p.catid = c.catid AND p.brandid = b.brandid AND p.productid = '$id'";
    	$result=$this ->db->select($sql);
    	return $result;
	}

	public function getProductIphone(){
		$sql="SELECT * FROM tbl_product WHERE brandid = 6 ORDER BY productid DESC LIMIT 1";
		$result=$this ->db->select($sql);
    	return $result;
	}

	public function getProductSamsung(){
		$sql="SELECT * FROM tbl_product WHERE brandid = 2 ORDER BY productid DESC LIMIT 1";
		$result=$this ->db->select($sql);
    	return $result;
	}

	public function getProducttAcer(){
		$sql="SELECT * FROM tbl_product WHERE brandid = 3 ORDER BY productid DESC LIMIT 1";
		$result=$this ->db->select($sql);
    	return $result;
	}

	public function getProducttCanon(){
		$sql="SELECT * FROM tbl_product WHERE brandid = 5 ORDER BY productid DESC LIMIT 1";
		$result=$this ->db->select($sql);
    	return $result;
	}

	public function ProductByCate($id){
		$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$sql="SELECT * FROM tbl_product WHERE catid='$id'";
		$result=$this ->db->select($sql);
    	return $result;
	}


	public function insertCompareData($cmpid, $cusId){
		$cusId=$this->fm->validation($cusId);
		$productid=$this->fm->validation($cmpid);
		$cusId=mysqli_real_escape_string($this->db->link,$cusId);
		$productid=mysqli_real_escape_string($this->db->link,$cmpid);


		$Checkksql = "SELECT * FROM tbl_compare WHERE cmrid='$cusId' AND productid='$productid'";
		$check=$this ->db->select($Checkksql);
		if ($check) {
			$msg="<span class='error'>Already Added !</span>";
				return $msg;
		}

		$sql="SELECT * FROM tbl_product WHERE productid='$productid'";
		$Getpro=$this ->db->select($sql);
		if ($Getpro) {
			while ($result=$Getpro->fetch_assoc()) {
				$productid=$result['productid'];
				$productname=$result['productname'];
				$price=$result['price'];
				$image=$result['image'];
            	$query = "INSERT INTO tbl_compare(cmrid,productid,productname,price,image) VALUES('$cusId','$productid','$productname','$price','$image')";
            	$insert_row=$this ->db->insert($query);
            	if ($insert_row) {
				$msg="<span class='success'>Added to Compare.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Not Added !</span>";
				return $msg;
			}
			}
		}
	}

	public function getAllCompareProduct($cusId){
		$cusId=$this->fm->validation($cusId);
		$cusId=mysqli_real_escape_string($this->db->link,$cusId);
		$sql="SELECT * FROM tbl_compare WHERE cmrid ='$cusId' ORDER BY id DESC";
		$result=$this ->db->select($sql);
    	return $result;
	}

	public function delCompareData($cusId){
		$cusId=$this->fm->validation($cusId);
		$cusId=mysqli_real_escape_string($this->db->link,$cusId);
    	$sql = "DELETE FROM tbl_compare WHERE cmrid='$cusId'";
    	$Delete_row=$this ->db->delete($sql);
	}

	public function delCompareById($cusId,$id){
		$sql = "DELETE FROM tbl_compare WHERE cmrid ='$cusId' AND productid='$id'";
		$Delete_row=$this ->db->delete($sql);
		if ($Delete_row) {
				$msg="<span class='success'>Delete Successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Not Deleted !</span>";
				return $msg;
			}
	}

	public function savewlistData($id,$cusId){
		$Checkksql = "SELECT * FROM tbl_wlist WHERE cmrid='$cusId' AND productid='$id'";
		$check=$this ->db->select($Checkksql);
		if ($check) {
			$msg="<span class='error'>Already Added !</span>";
				return $msg;
		}
		$sql="SELECT * FROM tbl_product WHERE productid='$id'";;
		$Getpro=$this ->db->select($sql);
		if ($Getpro) {
			while ($result=$Getpro->fetch_assoc()) {
				$productid=$result['productid'];
				$productname=$result['productname'];
				$price=$result['price'];
				$image=$result['image'];
            	$wquery="INSERT INTO tbl_wlist(cmrid,productid,productname,price,image) VALUES('$cusId','$productid','$productname','$price','$image')";
            	$insert_row=$this ->db->insert($wquery);
            	if ($insert_row) {
				$msg="<span class='success'>Added ! Check Wishlist Page.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Not Added !.</span>";
				return $msg;
			}
			}
		}	
	}

	public function getAllwishlistProduct($cusId){
		$cusId=mysqli_real_escape_string($this->db->link,$cusId);
		$sql = "SELECT * FROM tbl_wlist WHERE cmrid='$cusId' ORDER BY id DESC";
		$result=$this ->db->select($sql);
		return $result;
	}

	public function delWhishData($cusId,$productid){
		$sql="DELETE FROM tbl_wlist WHERE cmrid='$cusId' AND productid='$productid'";
		$deldata=$this ->db->delete($sql);
		return $deldata;
	}


	public function Ordermassage(){
		$sql = "SELECT * FROM tbl_order WHERE status = '0' order by id desc";
		$result=$this ->db->select($sql);
		return $result;
	}

}
?>