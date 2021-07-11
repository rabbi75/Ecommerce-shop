<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }
?>
<?php
    if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
        $id = Session::get("cusId");
        $insertOrder=$ct->orderProduct($id);
        $delData=$ct->delCustomerCart();
        header("location:success.php");
    }
?>
<style>
    .division{width: 50%;float: left;}
    .tblone{width: 540px;margin: 0px auto;border:2px solid #ddd;}
    .tblone tr td{text-align: justify;}
    .tbltwo{float:right;text-align:left;width:60%;border: 2px solid #ddd;margin-right: 14px;margin-top: 12px;}
    .tbltwo tr td{text-align: justify;padding: 5px 10px;}
    .ordernow{padding-bottom: 8px;}
    .ordernow a{width: 200px;margin: 20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background: #ff0000;color: #fff;border-radius: 3px;}
</style>
 <div class="main">
    <div class="content"> 
    	<div class="section group">
            <div class="division">
                <table class="tblone">
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                            <?php    
                            $id = Session::get("cusId");
                            $getData=$ct->getCartProduct();
                            if ($getData) {
                                $i=0;
                                $sum=0;
                                while ($result=$getData->fetch_assoc()) {
                                $i++;
                            ?>
                                
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td>$<?php echo $result['price']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                
                                <td>
                                <?php
                                    $total=$result['price'] * $result['quantity'];
                                    echo $total;
                                ?>  
                                </td>
                            </tr>
                            <?php
                                $sum=$sum+$total;
                            ?>
                            <?php } } ?>
                        </table>
                        <table class="tbltwo">
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td>$<?php echo $sum; ?></td>
                            </tr>
                            <tr>
                                <td>VAT</td>
                                <td>:</td>
                                <td>10% ($<?php echo $vat = $sum * 0.1;?>)</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>:</td>
                                <td>$<?php
                                        $vat = $sum * 0.1;
                                        $gtotal=$sum+$vat;
                                        echo $gtotal;
                                    
                                    ?>
                                </td>
                            </tr>
                       </table>
            </div>
            <div class="division">
                <?php
                    $id = Session::get("cusId");
                    $getData=$cmr->getCustomerData($id);
                    if ($getData) {
                        while ($UserData=$getData->fetch_assoc()) {
                    ?>
                <table class="tblone">
                <tr>
                    <td colspan="3"><h2>Your Profile Details.</h2></td>
                </tr>
                <tr>
                    <td width="20%">Name</td>
                    <td width="5%">:</td>
                    <td><?php echo $UserData['name'];?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $UserData['phone'];?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $UserData['email'];?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $UserData['address'];?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $UserData['city'];?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $UserData['zip'];?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $UserData['country'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="editprofile.php">Update Details</a></td>
                </tr>
            </table>
            <?php } }?>
            </div>
    	</div>
       <div class="clear"></div>
       <div class="ordernow"><a href="?orderid=order">Order</a></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>
