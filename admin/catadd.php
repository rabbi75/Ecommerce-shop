<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    $insertCat='';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catname=$_POST['catname'];
        $insertCat = $cat->catInsert($catname);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php
                    if ($insertCat) {
                        echo $insertCat;
                    }
                ?>
                 <form action="catadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catname" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>