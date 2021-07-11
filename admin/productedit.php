<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['productid']) || $_GET['productid']==NULL) {
        echo "<script>window.location == 'catlist.php'</script>";
    }else{
        //$id = $_GET['productid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
    }
?>
<?php
    $pro=new Product();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $pro->ProductUpdate($_POST, $_FILES, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">   
        <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
        ?> 

        <?php
            $getProduct=$pro->getProductById($id);
            if ($getProduct) {
                while ( $editresult=$getProduct->fetch_assoc()) {
           
        ?>           
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productname" value="<?php echo $editresult['productname'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catid">
                            <option>Select Category</option>
                            <?php
                                $cat=new Category();
                                $getCat=$cat->getAllcat();
                                if ($getCat) {
                                    while ($result=$getCat->fetch_assoc()) {
                                     
                            ?>
                            <option
                                <?php
                                    if ($result['catid']==$editresult['catid']) { ?>
                                        selected="selected"
              
                                <?php } ?> value="<?php echo $result['catid']; ?>"><?php echo $result['catname'];?></option>
                                <?php } }?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandid">
                            <option>Select Brand</option>
                            <?php
                                $Brand=new Brand();
                                $getBrand=$Brand->getAllbrand();
                                if ($getBrand) {
                                    while ($result=$getBrand->fetch_assoc()) {
                                     
                            ?>
                            <option
                                <?php
                                    if ($result['brandid']==$editresult['brandid']) { ?>
                                        selected="selected"
              
                                <?php } ?> value="<?php echo $result['brandid']; ?>"><?php echo $result['brandname'];?></option>
                            <?php } }?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $editresult['body']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $editresult['price'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td> 
                    <td>
                        <img src="<?php echo $editresult['image']; ?>" height="80px" width="170px"></br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php if ($editresult['type']==0) { ?>
                                <option selected="selected" value="0">Featured</option>
                                <option value="1">General</option>
                            <?php } else{ ?>
                            <option value="o">Featured</option>
                            <option selected="selected" value="1">General</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php }}?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


