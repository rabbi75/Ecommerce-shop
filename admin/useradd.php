<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $admAdd = $usr->adminAdd($_POST);
    }
?>
<div class="grid_10">
    <?php
        if (isset($admAdd)) {
            echo $admAdd;
        }
    ?>
    <div class="box round first grid">
        <h2>Add New User</h2>
       <div class="block copyblock"> 
        
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="adminname" placeholder="Enter User Name..." class="medium" required="" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Roll Name</label>
                    </td>
                    <td>
                        <input type="text" name="adminuser" placeholder="Enter User Roll Name..." class="medium" required="" />
                    </td>
                </tr>                   
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="adminemail" placeholder="Enter Email..." class="medium" required="" />
                    </td>
                </tr>                    
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="text" name="adminpass" placeholder="Enter Password..." class="medium" required="" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Confirm Password</label>
                    </td>
                    <td>
                        <input type="text" name="cadminpass" placeholder="Enter Confirm Password..." class="medium" required="" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>User Roll</label>
                    </td>
                    <td>
                        <select id="select" name="level">
                            <option>Select User Roll</option>
                            <option value="0">Admin</option>
                            <option value="1">Author</option>
                            <option value="2">Editor</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td> 
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
