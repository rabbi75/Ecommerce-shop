<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['brandid']) || $_GET['brandid']==NULL) {
        echo "<script>window.location == 'catlist.php'</script>";
    }else{
        //$id = $_GET['catid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandid']);
    }
?>
<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandname=$_POST['brandname'];
        $upDateBrand = $brand->upDateBrand($brandname,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if (isset($upDateBrand)) {
                        echo $upDateBrand;
                    }
                ?>
                <?php
                     $getBrand=$brand->getBrandById($id);
                     if ($getBrand) {
                         while ($result=$getBrand->fetch_assoc()) {
                
                ?>
                 <form action="" method="POST">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="brandname" value="<?php echo $result['brandname'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>