<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }
?>
<style>
    .payment{width: 500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin: 0px auto;padding: 50px;}
    .payment h2{border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px;}
    .payment a{background: #ff0000;border-radius: 3px;color: #fff;font-size: 25px;padding: 5px 30px;}
    .back a{width: 160px;margin: 5px auto;padding: 7px 0px;text-align: center;display: block;background: #555;border: 1px solid #333;color: #fff;border-radius: 3px;font-size: 25px;}
</style>
 <div class="main">
    <div class="content"> 
    	<div class="section group">
    		<div class="payment">
    			<h2>Choose Payment Option</h2>
                <a href="paymentoffline.php">Offline Payment</a>
    		    <a href="paymentonline.php">Online Payment</a>
            </div>
            <div class="back">
                <a href="cart.php">Previous</a>
            </div>
    	</div>
       <div class="clear"></div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>