<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Details.</h2>
       <div class="block copyblock"> 

<?php
    if (!isset($_GET['custid']) || $_GET['custid']==NULL) {
        echo "<script>window.location = 'inbox.php'</script>";
    }else{
        //$id = $_GET['catid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custid']);
        //echo $id;
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        echo "<script>window.location = 'inbox.php'</script>";
    }
?>

        <?php
            $getOrder=$cmr->getAllCustomerDetails($id);
            if ($getOrder) {
                while ($cusdetails=$getOrder->fetch_assoc()) {
       
        ?>
         <form action="" method="POST">
            <table class="form">                    
                <tr>
                    <td>Name :</td>
                    <td>
                        <input type="text" readonly="readonly" value="<?php echo $cusdetails['name'];?>" class="medium"  />
                    </td>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td>
                        <input type="text" readonly="readonly" value="<?php echo $cusdetails['address'];?>" class="medium"  />
                    </td>
                </tr>
                <tr>
                    <td>City :</td>
                    <td>
                        <input type="text" readonly="readonly" value="<?php echo $cusdetails['city'];?>" class="medium"  />
                    </td>
                </tr>
                <tr>
                    <td>Zipcode :</td>
                    <td>
                        <input type="text" readonly="readonly" value="<?php echo $cusdetails['zip'];?>" class="medium"  />
                    </td>
                </tr>
                <tr>
                    <td>Phone :</td>
                    <td>
                        <input type="text" readonly="readonly" value="<?php echo $cusdetails['phone'];?>" class="medium"  />
                    </td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td>
                        <input type="text" readonly="readonly" value="<?php echo $cusdetails['email'];?>" class="medium"  />
                    </td>
                </tr>
                <tr> 
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
