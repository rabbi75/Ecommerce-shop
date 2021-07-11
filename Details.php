<?php
	include 'inc/header.php';
?>
<?php
    if (!isset($_GET['proid']) || $_GET['proid']==NULL) {
        echo "<script>window.location = '404.php'</script>";
    }else{
        //$id = $_GET['catid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
        //echo $id;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity=$_POST['quantity'];
        $addCart = $ct->addToCart($quantity,$id);
    }
?>
<!--Start For Compare Page -->
<?php
    $cusId = Session::get("cusId");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cmprid'])){
    	$productid=$_POST['productid'];
        $insertCompare = $pd->insertCompareData($productid, $cusId);
    }
?>
<!--End For Compare Page -->

<!--Start For wlist Page -->
<?php
    $cusId = Session::get("cusId");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])){
        $saveWlist = $pd->savewlistData($id,$cusId);
    }
?>
<!--End For wlist Page -->
<style>
.mybutton{width: 100px;float: left;margin-right:50px; }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
				<?php
					$getPd = $pd->getSingleProduct($id);
					if ($getPd) {
						while ($result=$getPd->fetch_assoc()) {
						
				?>			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productname'];?> </h2>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catname'];?></span></p>
						<p>Brand:<span><?php echo $result['brandname'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
				<span style="color: red; font-size: 18px;">
				</span>
				<?php
					if (isset($addCart)) {
						echo $addCart;
					}
				?>
				<?php
					if (isset($insertCompare)) {
						echo $insertCompare;
					}
				?>
				<?php
					if (isset($saveWlist)) {
						echo $saveWlist;
					}
				?>
				<?php
				$login = Session::get("cuslogin");
				if ($login == true) {?>
				<div class="add-cart">
					<div class="mybutton">
					<form action="" method="post">
						<input type="hidden" class="buyfield" name="productid" value="<?php echo $result['productid']; ?>"/>
						<input type="submit" class="buysubmit" name="cmprid" value="Add to Compare"/>
					</form>
					</div>
					<div class="mybutton">
				
					<form action="" method="post">
						<input type="hidden" class="buyfield" name="productid" value="<?php echo $result['productid']; ?>"/>
						<input type="submit" class="buysubmit" name="wlist" value="Save to list"/>
					</form>
					</div>
				</div>
				<?php }?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body'];?>
	    </div>
		<?php } } ?>	
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
							$getCat = $cat->getAllcat();
							if ($getCat) {
								while ($result=$getCat->fetch_assoc()) {
									
						?>
				        <li><a href="productbycat.php?catid=<?php echo $result['catid']; ?>"><?php echo $result['catname']; ?></a></li> 
				        <?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
</div>
<?php
	include 'inc/footer.php';
?>