<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
	if (isset($_GET['delcatcat'])) {
    	$id = base64_decode($_GET['delcatcat']);
    	//$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcatcat']);
    	$delCat = $cat->delCatById($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">  
        <?php
        	if (isset($delCat)) {
        		echo $delCat;
        	}
        ?>      
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getCat=$cat->getAllcat();
					if($getCat){
						$i=0;
						while ( $result = $getCat->fetch_assoc()) {
							$i++;
						
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['catname'];?></td>
					<td><a href="catedit.php?catid=<?php echo $result['catid']?>">Edit</a> || <a onclick ="return confirm('Are you sure to Delete..')" href="?delcatcat=<?php echo base64_encode($result['catid'])?>">Delete</a></td>
				</tr>
				<?php } }?>
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

