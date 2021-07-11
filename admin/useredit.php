<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
    if (!isset($_GET['viewEdit']) || $_GET['viewEdit']==NULL) {
        echo "<script>window.location == 'userlist.php'</script>";
    }else{
        //$id = $_GET['productid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['viewEdit']);
    }
?>
<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $usereditResult = $usr->upDateUser($_POST,$id);
    }
?>
<div class="grid_10">
    <?php
        if (isset($usereditResult)) {
            echo $usereditResult;
        }
    ?>
    <div class="box round first grid">
        <h2>User Edit</h2>
       <div class="block copyblock"> 
        <?php
            $getUser=$usr->getAllUserDetails($id);
            if ($getUser) {
                while ($result=$getUser->fetch_assoc()) {
       
        ?>
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['adminname'];?>" name="adminname" class="medium" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Roll Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['adminuser'];?>" name="adminuser" class="medium" />
                    </td>
                </tr>                  
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['adminemail'];?>" name="adminemail"  class="medium" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Details</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['admindetails'];?>" name="admindetails"class="medium" />
                    </td>
                </tr>    

                <tr>
                    <td>
                        <label>User Roll</label>
                    </td>
                    <td>
                        <select id="select" name="level">
                            <option>Select User Roll</option>
                            <?php if ($result['level']==0) { ?>
                                <option selected="selected" value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            <?php   }elseif($result['level']==1){ ?>
                                <option value="0">Admin</option>
                                <option selected="selected" value="1">Author</option>
                                <option value="2">Editor</option>
                            <?php    }else{ ?>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option selected="selected" value="2">Editor</option>
                        <?php    } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td> 
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } }?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
