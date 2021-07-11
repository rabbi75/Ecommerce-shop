<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['viewUer']) || $_GET['viewUer']==NULL) {
        echo "<script>window.location == 'Dashboard.php'</script>";
    }else{
        //$id = $_GET['productid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['viewUer']);
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        echo "<script>window.location = 'Dashbord.php'</script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User Veiw</h2>
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
                        <input type="text" value="<?php echo $result['adminname'];?>" name="adminname" class="medium" readonly="readonly" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Roll Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['adminuser'];?>" name="adminuser" class="medium" readonly="readonly" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['adminemail'];?>" name="adminemail"  class="medium" readonly="readonly" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Details</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['admindetails'];?>" name="admindetails"class="medium" readonly="readonly" />
                    </td>
                </tr>    

                <tr>
                    <td>
                        <label>User Roll</label>
                    </td>
                    <td>
                        <select id="select" name="level" readonly="readonly" >
                            <?php
                            if ($result['level']==0) { ?>
                                <option value="0">Admin</option>
                            <?php   }elseif($result['level']==1){ ?>
                                <option value="1">Author</option>
                            <?php    }else{ ?>
                            <option value="2">Editor</option>
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
