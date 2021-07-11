<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>User List</h2>
            <div class="block">  
                <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Usern Name</th>
						<th>Email</th>
						<th>Details</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>

					<?php
                    	$getUser=$usr->getAllUser();
                    	if($getUser){
                        $i=0;
                        	while ( $result = $getUser->fetch_assoc()) {
                            $i++;
                        
					?>
					<tr class="odd gradeX">
						<td ><?php echo $i?></td>
						<td ><?php echo $result['adminname'] ?></td>
						<td ><?php echo $result['adminuser'] ?></td>
						<td ><?php echo $result['adminemail'] ?></td>
						<td ><?php echo $fm->textshorten($result['admindetails'],30); ?></td>
						<td >
							<?php 
								if ($result['level']=='0') {
									echo "Admin";
								}elseif ($result['level']=='1') {
									echo "Author";
								}elseif ($result['level']=='2') {
									echo "Editor";
								}
						 	?>
						 </td>
						<td >
							<a href="userveiw.php?viewUer=<?php echo $result['adminid']?>">View</a>|| 
							<a href="useredit.php?viewEdit=<?php echo $result['adminid']?>">Edit</a>||
							<a onclick ="return confirm('Are you sure to Delete..')" href="?deluser=<?php echo base64_encode($result['adminid'])?>">Delete</a> 
						</td>
					</tr>
					<?php } } ?>
	
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
