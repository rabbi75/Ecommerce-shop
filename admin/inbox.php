<?php
	include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
	if (isset($_GET['mainid'])) {
		$id=$_GET['mainid'];
		$sid=$_GET['shiftid'];
		$time=$_GET['time'];
		$price=$_GET['price'];
		$shift=$ct->productShifted($id,$sid,$time,$price);
	}
?>
<!-- Start Delete Order Product -->
<?php
	if (isset($_GET['delmainid'])) {
		$did=$_GET['delmainid'];
		$dsid=$_GET['delshiftid'];
		$time=$_GET['time'];
		$price=$_GET['price'];
		$delOrder=$ct->deleteOrder($did,$dsid,$time,$price);
	}
?>
<!-- End Delete Order Product -->
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        	if (isset($shift)) {
        		echo $shift;
        	}

        	if (isset($delOrder)) {
        		echo $delOrder;
        	}
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Order Time</th>
					<th>Product</th>
					<th>Image</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Cust ID</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

					$getOrder=$ct->getAllOrderProduct();
					if ($getOrder) {
						while ($result=$getOrder->fetch_assoc()) {
							
				?>
				<tr class="odd gradeX">
					<td><?php echo $result['id'];?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td><?php echo $result['productname'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="60px" width="90px"></td>
					<td><?php echo $result['quantity'];?></td>
					<td>$<?php echo $result['price'];?></td>
					<td><?php echo $result['cmrid'];?></td>
					<td><a href="customer.php?custid=<?php echo $result['cmrid'];?>">View Details</a></td>
					<?php if ($result['status']=='0') { ?>
							<td><a href="?mainid=<?php echo $result['id'];?>&amp;shiftid=<?php echo $result['cmrid'];?>&amp;price=<?php echo $result['price'];?>&amp;time=<?php echo $result['date'];?>">Shifted</a></td>
					<?php  }elseif ($result['status']=='1') { ?>
						<td>Pending</td>
					<?php }else{ ?>
					<td><a href="?delmainid=<?php echo $result['id'];?>&amp;delshiftid=<?php echo $result['cmrid'];?>&amp;price=<?php echo $result['price'];?>&amp;time=<?php echo $result['date'];?>">Remove</a></td>
					<?php } ?>
				</tr>
			<?php } } ?>	
			</tbody>
		</table>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
