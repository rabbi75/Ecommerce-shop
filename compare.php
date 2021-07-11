<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cuslogin");
	if ($login == false) {
		header("location:login.php");
	}
?>
<style>
	.success{color: green;font-size: 17px;}
	.error{color: red;font-size: 17px;}
	table.tblone img{height: 90px;width: 100px;}
</style>
<?php
    $cusId = Session::get("cusId");
    if (isset($_GET['delcompare'])) {
    	$productid = $_GET['delcompare'];
        $delCompare = $pd->delCompareById($cusId,$productid);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">	
			<div class="cartpage">
			    	<h2>Compare</h2>
						<table class="tblone">
							<tr>
								<th>Sl</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php
								$cusId = Session::get("cusId");
								$getPd = $pd->getAllCompareProduct($cusId);
								if ($getPd) {
									$i=0;
									while ($result=$getPd->fetch_assoc()) {
									$i++;
							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $result['productname']; ?></td>
								<td>$ <?php echo $result['price']; ?></td>
								<td><img src="Admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>
									<a href="Details.php?proid=<?php echo $result['productid']; ?>">View</a> || <a href="?delcompare=<?php echo $result['productid']; ?>">Remove</a>
								</td>
							</tr>
							<?php } } ?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%;text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>