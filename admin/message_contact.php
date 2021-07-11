<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Message</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
            		$getMessage=$cmr->getAllMessage();
            			if($getMessage){
               		$i=0;
                		while ( $result = $getMessage->fetch_assoc()) {
                    	$i++;
                
        		?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['email'];?></td>
					<td><?php echo $result['phone'];?></td>
					<td><?php echo $fm->textshorten($result['body'],30); ?></td>
					<td><?php echo $fm->formatDate($result['time']); ?></td>
					<td>
						<a href="?page=viewmsg&amp;msgid=<?php echo $result['id']; ?>">View</a> ||
						<a href="?page=reply&amp;msg=<?php echo $result['id']; ?>">Reply</a> ||
						<a onclick ="return confirm('Are you sure to Move the Message..')" href="?page=inbox&amp;seenid=<?php echo $result['id']; ?>">Seen</a> 
					</td>
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

<?php include 'inc/footer.php';?>

