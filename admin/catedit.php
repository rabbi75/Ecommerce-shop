<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid']==NULL) {
        echo "<script>window.location == 'catlist.php'</script>";
    }else{
        //$id = $_GET['catid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
    }
?>

<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catname=$_POST['catname'];
        $upDateCat = $cat->upDateCat($catname,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if (isset($upDateCat)) {
                        echo $upDateCat;
                    }
                ?>
                <?php
                     $getCat=$cat->getCatById($id);
                     if ($getCat) {
                         while ($result=$getCat->fetch_assoc()) {
                
                ?>
                 <form action="" method="POST">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="catname" value="<?php echo $result['catname'];?>" class="medium" />
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