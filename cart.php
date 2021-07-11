<?php
	include 'inc/header.php';
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cartid=$_POST['cartid'];
        $quantity=$_POST['quantity'];
        $updateCart = $ct->updateCartQuantity($cartid,$quantity);
        if ($quantity<=0) {
        	$delCart = $ct->delCartById($cartid);
        }
    }
?>
<?php
	if (isset($_GET['delpro'])) {
    	$id = base64_decode($_GET['delpro']);
    	//$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcatcat']);
    	$delCart = $ct->delCartById($id);
    }
?>
<?php 
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    		if (isset($updateCart)) {
			    			echo $updateCart;
			    		}
			    	?>
			    	<?php
			    		if (isset($delCart)) {
			    			echo $delCart;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">Sl</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="5%">Action</th>
							</tr>
							<?php
							$sum=0;
								$getPro=$ct->getCartProduct();
								if ($getPro) {
									$i=0;
									$sum=0;
									$qty=0;
									while ( $result=$getPro->fetch_assoc()) {
									$i++;
							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $result['productname']; ?></td>
								<td><img src="Admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>$<?php echo $result['price']; ?></td>
								
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartid" value="<?php echo $result['cartid']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>

								<td>$
								<?php
									$total=$result['price'] * $result['quantity'];
									echo $total;
								?>	
								</td>
								<td><a onclick ="return confirm('Are you sure to Delete..')" href="?delpro=<?php echo base64_encode($result['cartid'])?>">X</a></td>
							</tr>
							<?php
								$qty=$qty+$result['quantity'];
								$sum=$sum+$total;
								Session::set("qty",$qty);
								Session::set("sum",$sum);
							?>
							<?php } } ?>
						
							
						</table>
						<?php
							$getData = $ct->checkCartTable();
								if ($getData) {
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php
										$vat = $sum * 0.1;
										$gtotal=$sum+$vat;
										$_SESSION['phpcsdoder'] = $gtotal;
										echo $gtotal;
									
									?>
								</td>
							</tr>
					   </table>
						<?php }else{
							header("location:index.php");
							//echo "Cart Empty ! Please shop now.";
						} 

						?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>