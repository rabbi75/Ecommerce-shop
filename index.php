<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
	
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	
	        <div class="section group">
	        	<?php
    				$getFepro=$pd->getFeaturedProduct();
    				if ($getFepro) {
    					while ($result=$getFepro->fetch_assoc()) {
    			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="Details.php"?proid=<?php echo $result['productid'];?>><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['productname'];?> </h2>
					 <p><?php echo $fm->textshorten($result['body'],70); ?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="Details.php?proid=<?php echo $result['productid'] ?>" class="details">Details</a></span></div>
				</div>
				<?php } }?>
			</div>
		
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
    				$geNepro=$pd->getNewProduct();
    				if ($geNepro) {
    					while ($result=$geNepro->fetch_assoc()) {
    			?> 
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="Details.php"?proid=<?php echo $result['productid'];?>><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['productname'];?> </h2>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="Details.php?proid=<?php echo $result['productid'] ?>" class="details">Details</a></span></div>
				</div>
				<?php } }?>
			</div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
?>
