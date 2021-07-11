<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cuslogin");
	if ($login == true) {
		header("location:order.php");
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$ResultcustomerLogin = $cmr->customerLogin($_POST);
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
            <?php
    			if (isset($ResultcustomerLogin)) {
    				echo $ResultcustomerLogin;
    			}
    		?>

        	<form action="" method="POST"">
            	<input type="text" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <div class="buttons"><div><button class="grey" name="login">Login</button></div></div></div>
            </form>
          

        <?php
    		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        		$customerReg = $cmr->customerRegistration($_POST);
    		}
		?>          
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
    			if (isset($customerReg)) {
    				echo $customerReg;
    			}
    		?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name" required="" />
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City" required="">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip_Code" required="">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email" required="">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address" required="">
						</div>
						<div>
							<input type="text" name="country" placeholder="County" required="">
						</div>	        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone" required="">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password" required="">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="submit">Create Account</button></div></div>
		    
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>