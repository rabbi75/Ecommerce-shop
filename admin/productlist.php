<?php    
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
	if (isset($_GET['delProduct'])) {
    	$id = base64_decode($_GET['delProduct']);
    	//$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcatcat']);
    	$deleteProduct = $pro->delProductById($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        	<?php
        		if (isset($deleteProduct)) {
        			echo $deleteProduct;
        		}
        	?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Product No :</th>
					<th>Product Name :</th>
					<th>Category :</th>
					<th>Brand :</th>
					<th>Body :</th>
					<th>Price :</th>
					<th>Image :</th>
					<th>Type :</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getProduct=$pro->getAllProdut();
					if($getProduct){
                        $i=0;
                        while ( $result = $getProduct->fetch_assoc()) {
                            $i++;
						
				?>
				<tr class="odd gradeX">
					<td><?php echo $i++ ?></td>
					<td><?php echo $result['productname'] ?></td>
					<td><?php echo $result['catname'] ?></td>
					<td><?php echo $result['brandname'] ?></td>
					<td><?php echo $fm->textshorten($result['body'],40); ?></td>
					<td>$<?php echo $result['price'] ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="60px" width="90px" ></td>
					<td>
						<?php
							if ($result['type']==0) {
								echo "Featured";
							}else{
								echo "General";
							}
						 ?>	
					</td>
					<td><a href="productedit.php?productid=<?php echo $result['productid']?>">Edit</a> || <a onclick ="return confirm('Are you sure to Delete..')" href="?delProduct=<?php echo base64_encode($result['productid'])?>">Delete</a></td>
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
