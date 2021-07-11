<?php
	include 'inc/header.php';
?>
<?php
	if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
		echo "<script>window.location = '404.php';</script>";
	}else{
		$id = $_GET['catid'];
	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$getPd = $pd->ProductByCate($id);
					if ($getPd) {
						while ($result=$getPd->fetch_assoc()) {
	      		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="Details.php?proid=<?php echo $result['productid'] ?>"><img src="admin/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productname'] ?></h2>
					 <p><?php echo $fm->textshorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price'] ?></span></p>
				     <div class="button"><span><a href="Details.php?proid=<?php echo $result['productid'] ?>" class="details">Details</a></span></div>
				</div>
				<?php } }else{
					header("location:404.php");
					//echo "<p>Product of this category are not available !</p>";
				} ?>
			</div>

	
	
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>