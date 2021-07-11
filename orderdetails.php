<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }
?>
<?php
    if (isset($_GET['mainid'])) {
        $id=$_GET['mainid'];
        $sid=$_GET['custid'];
        $time=$_GET['time'];
        $price=$_GET['price'];
        $confirm=$ct->productShiftConfirm($id,$sid,$time,$price);
    }
?>
 <div class="main">
    <div class="content"> 
    	<div class="section group">
    		<div class="order">
    			<h2>Your Ordered Details</h2>
                <table class="tblone">
                            <tr>
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php    
                                $id = Session::get("cusId");
                                $getOrder=$ct->getOrderProduct($id);
                                if ($getOrder) {
                                $i=0;
                                $sum=0;
                                while ($result=$getOrder->fetch_assoc()) {
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td><img src="Admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php $total=$result['price']; echo $total; ?>  
                                </td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td><?php
                                    if ($result['status']=='0') {
                                         echo "Pending";
                                     }elseif ($result['status']=='1') { 
                                        echo "Shifted";
                                     }else{
                                        echo "Ok";
                                     } 
                                 ?>
                                     
                                </td>
                                <?php
                                    if ($result['status']=='1') { ?>
                                           <td><a href="?mainid=<?php echo $result['id'];?>&amp;custid=<?php echo $result['cmrid'];?>&amp;price=<?php echo $result['price'];?>&amp;time=<?php echo $result['date'];?>">Confirm</a></td>

                                    <?php   }elseif ($result['status']=='2') { ?>
                                        <td>Ok</td>
                                    <?php }elseif ($result['status']=='0') { ?>
                                        <td>N/A</td>
                                    <?php   } ?>
                            </tr>
                            <?php } } ?>
                        </table>
    		</div>
    	</div>
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>