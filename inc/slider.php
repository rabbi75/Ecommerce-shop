	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getIphone=$pd->getProductIphone();
					if ($getIphone) {
						while ($iphone=$getIphone->fetch_assoc()) {
							
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $iphone['productid']; ?>"> <img src="admin/<?php echo $iphone['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $iphone['productname'];?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $iphone['productid']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
				<?php } }?>

				<?php
					$getSamsung=$pd->getProductSamsung();
					if ($getSamsung) {
						while ($Samsung=$getSamsung->fetch_assoc()) {
							
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $Samsung['productid']; ?>"><img src="admin/<?php echo $Samsung['image']; ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $Samsung['productname']; ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $Samsung['productid']; ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php } }?>
			</div>
			<div class="section group">
				<?php
					$getAcer=$pd->getProducttAcer();
					if ($getAcer) {
						while ($Acer=$getAcer->fetch_assoc()) {
						
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $Acer['productid']; ?>"><img src="admin/<?php echo $Acer['image']; ?>" alt="" / ></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $Acer['productname']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $Acer['productid']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } }?>

			   <?php
					$getCanon=$pd->getProducttCanon();
					if ($getCanon) {
						while ($Canon=$getCanon->fetch_assoc()) {
							
					
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $Canon['productid']; ?>"><img src="admin/<?php echo $Canon['image']; ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p><?php echo $Canon['productname']; ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $Canon['productid']; ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php } }?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>