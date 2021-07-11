<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }
?>
<style>
    .psuccess{width: 500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin: 0px auto;padding: 50px;}
    .psuccess h2{border-bottom: 1px solid #ddd;margin-bottom: 28px;padding-bottom: 10px;}
    .psuccess p{font-size: 18px;line-height: 25px;text-align: left;}
</style>    
 <div class="main">
    <div class="content"> 
    	<div class="section group">
    		<div class="psuccess">
    			<h2>Success</h2>
                <?php
                    $id = Session::get("cusId");
                    $amount=$ct->payableAmount($id);
                    $sum="";
                    if ($amount) {
                        $sum=0;
                        while ($result=mysqli_fetch_array($amount)) {
                            $price=$result['price'];
                            $sum=$sum+$price;
                        }
                    }
                ?>
                <p>Total Payable Amount(Including Vat) : $
                    <?php
                        $vat = $sum * 0.1;
                        $total = $sum + $vat;
                        echo $total;
                    ?>
                </p>
                <p>Thanks for purchase.Receive your order successfully.We will contact you ASAP with delivery details.Here is your order details....<a href="orderdetails.php">Visite Here..</a></p>
    		</div>
    	</div>
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>