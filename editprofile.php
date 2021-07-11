<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }
?>
<?php
    $cusid = Session::get("cusId");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $ReCuUpdate = $cmr->customerUpdate($_POST, $cusid);
    }
?>
<style>
	.tblone{width: 550px;margin: 0px auto;border:2px solid #ddd;}
	.tblone tr td{text-align: justify;}
    .tblone input[type="text"]{width: 400px;padding: 5px;font-size: 15px;}
</style>
 <div class="main">
    <div class="content"> 
    	<div class="section group">
            <?php
                $id = Session::get("cusId");
                $getData=$cmr->getCustomerData($id);
                if ($getData) {
                    while ($UserData=$getData->fetch_assoc()) {

            ?>
            <form action="" method="POST">
    		<table class="tblone">
                <?php
                    if (isset($ReCuUpdate)) {
                        echo "<tr><td colspan='2'>".$ReCuUpdate."</td></tr>";
                    }
                ?>
                <tr>
                    <td colspan="2"><h2>Update Your Profile Details.</h2></td>
                </tr>
    			<tr>
    				<td width="20%">Name</td>
    				<td><input type="text" required="" name="name" value="<?php echo $UserData['name'];?>"></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td><input type="text" required="" name="phone" value="<?php echo $UserData['phone'];?>"></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td><input type="text" required="" name="email" value="<?php echo $UserData['email'];?>"></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td><input type="text" required="" name="address" value="<?php echo $UserData['address'];?>"></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td><input type="text" required="" name="city" value="<?php echo $UserData['city'];?>"></td>
    			</tr>
    			<tr>
    				<td>Zipcode</td>
    				<td><input type="text" required="" name="zip" value="<?php echo $UserData['zip'];?>"></td>
    			</tr>
    			<tr>
    				<td>Country</td>
    				<td><input type="text" required="" name="country" value="<?php echo $UserData['country'];?>"></td>
    			</tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Save"></td>
                </tr>
    		</table>
            </form>
            <?php } }?>
    	</div>
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>