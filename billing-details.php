<?php 
$page=0;
include("includes/main.php"); 
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 60*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  header('Location: logout.php');
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}
if(isset($_SESSION['logout']))
{
	if($_SESSION['logout'] == 1)
	{
		include("includes/topheader.php");
	}
}
include("includes/searchbar.php");
include("includes/navbar.php"); 

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
{
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
{
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
if(isset($_POST['submit']))
{
			date_default_timezone_set("Asia/Kolkata");
			$cdate=date('d-m-Y');
			$userid=strtoupper($_SESSION['uid']);
			$badd=strtoupper($_POST['badd']);
			$badd2=strtoupper($_POST['badd2']);
			$bcon=strtoupper($_POST['bcon']);
			$bst=strtoupper($_POST['bst']);
			$bct=strtoupper($_POST['bct']);
			$bzip=$_POST['bzip'];
			$sadd=strtoupper($_POST['sadd']);
			$sadd2=strtoupper($_POST['sadd2']);
			$scon=strtoupper($_POST['scon']);
			$sst=strtoupper($_POST['sst']);
			$sct=strtoupper($_POST['sct']);
			$szip=$_POST['szip'];
			$payment=strtoupper($_POST['paymentMethod']);

			$mysql="UPDATE orders set billingAddress=:badd,billingAddressAdditional=:badd2,billingCountry=:bcon,billingState=:bst,billingCity=:bct,billingPincode=:bzip,shippingAddress=:sadd,shippingAddressAdditional=:sadd2,shippingCountry=:scon,shippingState=:sst,shippingCity=:sct,shippingPincode=:szip,paymentMethod=:payment,paymentStatus=0,orderStatus=0 where userid=:userid";
		    $query = $dbh->prepare($mysql);
		    $query->bindParam(':userid',$userid,PDO::PARAM_STR);   
		    $query->bindParam(':badd',$badd,PDO::PARAM_STR); 
		    $query->bindParam(':badd2',$badd2,PDO::PARAM_STR); 
		    $query->bindParam(':bcon',$bcon,PDO::PARAM_STR);
		    $query->bindParam(':bst',$bst,PDO::PARAM_STR);
		    $query->bindParam(':bct',$bct,PDO::PARAM_STR);    
		    $query->bindParam(':bzip',$bzip,PDO::PARAM_STR);
		    $query->bindParam(':sadd',$sadd,PDO::PARAM_STR); 
		    $query->bindParam(':sadd2',$sadd2,PDO::PARAM_STR); 
		    $query->bindParam(':scon',$scon,PDO::PARAM_STR);
		    $query->bindParam(':sst',$sst,PDO::PARAM_STR);
		    $query->bindParam(':sct',$sct,PDO::PARAM_STR);    
		    $query->bindParam(':szip',$szip,PDO::PARAM_STR);
		    $query->bindParam(':payment',$payment,PDO::PARAM_STR);
		    if($query->execute())
		    {
			    $sql="INSERT into customerorders(userid,userName,mobileNo,productid,productName,quantity,productPrice,productDiscountedPrice,productTotalPrice,shippingCharge,productDiscount,coupon,couponTag,couponDiscount,totalPrice,billingAddress,billingAddressAdditional,billingCountry,billingState,billingCity,billingPincode,shippingAddress,shippingAddressAdditional,shippingCountry,shippingState,shippingCity,shippingPincode,paymentMethod,paymentStatus,orderStatus) SELECT userid,userName,mobileNo,productid,productName,quantity,productPrice,productDiscountedPrice,productTotalPrice,shippingCharge,productDiscount,coupon,couponTag,couponDiscount,totalPrice,billingAddress,billingAddressAdditional,billingCountry,billingState,billingCity,billingPincode,shippingAddress,shippingAddressAdditional,shippingCountry,shippingState,shippingCity,shippingPincode,paymentMethod,paymentStatus,orderStatus from orders where userid=:userid";
			    $query = $dbh->prepare($sql);
		    	$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			    if($query->execute())
			    {
			    	$sql="SELECT * from customerorders";
				    $query = $dbh->prepare($sql);
				    $query->execute();
				    $row=$query->rowCount();
				    if($row>=0)
				    {
				        $id="ORD_".$row;
				        $sql="UPDATE customerorders set orderid=:id,dateorder:cdate where userid=:userid and orderid=''";
				        $query = $dbh->prepare($sql);
				        $query->bindParam(':id',$id,PDO::PARAM_STR);
		    			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
		    			$query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
				        if($query->execute())
				        {
							$sql="DELETE from cart where userid=:userid";
							$query = $dbh->prepare($sql);
							$query->bindParam(':userid',$userid,PDO::PARAM_STR);
							if($query->execute())
							{
								$sql="DELETE from orders where userid=:userid";
								$query = $dbh->prepare($sql);
								$query->bindParam(':userid',$userid,PDO::PARAM_STR);
								if($query->execute())
								{
									echo '<script>window.location.replace("order-cnf.php");</script>';
								}
							}
						}
			        }
			    }
			    else
			    {
			        echo '<script>alert("Data could not be copied to new table customerorders!");</script>';
			    }
			}
		    else
		    {
		        echo '<script>alert("Data could not be updated to orders!");</script>';
		    }
}
if(isset($_SESSION['uid']))
{
	if(isset($_GET['id']))
	{
		$userid=strtoupper($_SESSION['uid']);
		$sql="SELECT o.productPrice,o.quantity,o.productDiscount,o.totalPrice,o.shippingCharge,o.couponDiscount,o.couponTag,o.shippingAddressAdditional,o.billingAddressAdditional,o.paymentMethod,u.shippingAddress,u.shippingCountry,u.shippingState,u.shippingCity,u.shippingPincode from users u join orders o on u.id=o.userid where u.id=:userid and o.userid=:userid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':userid',$userid,PDO::PARAM_STR);	
		$query->execute();	
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			$pta=0;$tda=0;
			foreach($results as $result)
			{
		    	$pprice=unserialize($result->productPrice);
		    	$pquant=unserialize($result->quantity);
		    	$pdiscount=unserialize($result->productDiscount);    	
		    	$tprice=$result->totalPrice;
		    	$sprice=$result->shippingCharge;
		    	$cd=$result->couponDiscount;
		    	$ct=$result->couponTag;
		    	$i=0;
			  	while(!empty($pprice[$i]))
			  	{ 
			  		$pta=$pta+($pprice[$i]*$pquant[$i]);
			  		$tda=$tda+($pdiscount[$i]*$pquant[$i]);
			    	++$i;
			  	}
?>
				<div class="container">
				    <h2 style="text-align: center;">Billing Details</h2>
				    <div class="row">
				        <div class="col-md-4 order-md-2 mb-4">
				          	<h4 class="d-flex justify-content-between align-items-center mb-3">
					            <span class="text-muted">Cart Bill</span>
					            <span class="badge badge-secondary badge-pill"><?php echo $i; ?> Items</span>
				          	</h4>
				          	<ul class="list-group mb-3">
					            <li class="list-group-item d-flex justify-content-between lh-condensed">
					              	<div>
					                	<h6 class="my-0">Products Total Amount</h6>
					                	<!--<small class="text-muted">Brief description</small>-->
					              	</div>
					              	<span class="text-muted"><?php echo $pta; ?></span>
					            </li>
					            <li class="list-group-item d-flex justify-content-between bg-light">
					              	<div>
					                	<h6 class="my-0">Total Discount Amount</h6>
					                	<!--<small class="text-muted">Brief description</small>-->
					              	</div>
					              	<span class="text-success">-<?php echo $tda; ?></span>
					            </li>
					            <!--<li class="list-group-item d-flex justify-content-between lh-condensed">
					              	<div>
					                	<h6 class="my-0">Third item</h6>
					                	<small class="text-muted">Brief description</small>
					              	</div>
					              	<span class="text-muted">$5</span>
					            </li>-->
					            <li class="list-group-item d-flex justify-content-between bg-light">
					              	<div>
					                	<h6 class="my-0">Shipping Price</h6>
					                	<!--<small class="text-muted"><?php echo $ct; ?></small>-->
					              	</div>
					              	<span class="text-muted"><?php echo $sprice; ?></span>
					            </li>
					            <li class="list-group-item d-flex justify-content-between bg-light">
					              	<div>
					                	<h6 class="my-0">Coupon Code :</h6>
					                	<small class="text-muted"><?php echo $ct; ?></small>
					              	</div>
					              	<span class="text-success">-<?php echo $cd; ?></span>
					            </li>
					            <li class="list-group-item d-flex justify-content-between">
					              	<span>Cart Amount</span>
					              	<strong><?php echo $tprice; ?></strong>
					            </li>
				          	</ul>
				        </div>

				        <div class="col-md-8 order-md-1">          	
				          	<form class="needs-validation" method="POST" action="">
				          			<h4 class="mb-3">Billing Details</h4>

						            <div class="mb-3">
						              	<label for="address">Address</label>
						              	<input type="text" class="form-control" name="badd" id="badd" placeholder="Enter billing address" required>
						            </div>

						            <div class="mb-3">
						              	<label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
						              	<input type="text" class="form-control" name="badd2" id="badd2" placeholder="Additional landmark details" required>
						            </div>

						            <div class="row">
						              	<div class="col-md-6 mb-3">
						                	<label for="country">Country</label>
						                	<input type="text" class="form-control d-block w-100" name="bcon" id="bcon" placeholder="Enter billing country" required>
						                	<!--<select class="custom-select d-block w-100" id="country" required>
						                  		<option value="">Choose...</option>
						                  		<option>United States</option>
						                	</select>-->
						              	</div>
						              	<div class="col-md-6 mb-3">
						                	<label for="state">State</label>
						                	<input type="text" class="form-control d-block w-100" id="bst" name="bst" placeholder="Enter billing state" required>
						              	</div>
						            </div>
						            <div class="row">
						              	<div class="col-md-6 mb-3">
						                	<label for="state">City</label>
						                	<input type="text" class="form-control d-block w-100" id="bct" name="bct" placeholder="Enter billing city" required>
						              	</div>
						              	<div class="col-md-6 mb-3">
						                	<label for="zip">Zip</label>
						                	<input type="text" class="form-control" name="bzip" id="bzip" placeholder="Enter billing pincode" required>
						              	</div>
						            </div>

					            <hr class="mb-4"> 

					          		<h4 class="mb-3">Shipping Details</h4>

						            <div class="mb-3">
						              	<label for="address">Address</label>
						              	<input type="text" class="form-control" name="sadd" id="sadd" placeholder="Enter shipping address" value="<?php echo $result->shippingAddress; ?>" required>
						            </div>

						            <div class="mb-3">
						              	<label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
						              	<input type="text" class="form-control" name="sadd2" id="sadd2" placeholder="Additional landmark details" value="<?php echo $result->shippingAddressAdditional; ?>" required>
						            </div>

						            <div class="row">
						              	<div class="col-md-6 mb-3">
						                	<label for="country">Country</label>
						                	<input type="text" class="form-control d-block w-100" name="scon" id="scon" placeholder="Enter shipping country" value="<?php echo $result->shippingCountry; ?>" required>
						                	<!--<select class="custom-select d-block w-100" id="country" required>
						                  		<option value="">Choose...</option>
						                  		<option>United States</option>
						                	</select>-->
						              	</div>
						              	<div class="col-md-6 mb-3">
						                	<label for="state">State</label>
						                	<input type="text" class="form-control d-block w-100" name="sst" id="sst" placeholder="Enter shipping state" value="<?php echo $result->shippingState; ?>" required>
						              	</div>
						            </div>
						            <div class="row">
						              	<div class="col-md-6 mb-3">
						                	<label for="state">City</label>
						                	<input type="text" class="form-control d-block w-100" name="sct" id="sct" placeholder="Enter shipping city" value="<?php echo $result->shippingCity; ?>" required>
						              	</div>
						              	<div class="col-md-6 mb-3">
						                	<label for="zip">Zip</label>
						                	<input type="text" class="form-control" name="szip" id="szip" placeholder="Enter shipping pincode" value="<?php echo $result->shippingPincode; ?>" required>
						              	</div>
						            </div>

					            <hr class="mb-4">       

					            <!--<div class="custom-control custom-checkbox">
					              	<input type="checkbox" class="custom-control-input" name="chkdiv1" id="save-info">
					              	<label class="custom-control-label" for="save-info">Save this information for next time</label>
					            </div>

					            <hr class="mb-4">-->

					            <h4 class="mb-3">Payment</h4>

					            <div class="row">
					            	<div class="col-md-3 mb-3">
						              	<div class="custom-control custom-radio">
						                	<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" <?php echo ($result->paymentMethod=='CREDIT CARD')?'checked':'' ?> value="credit card" required>
						                	<label class="custom-control-label" for="credit">Credit card</label>
						              	</div>
						            </div>
						            <div class="col-md-3 mb-3">
						              	<div class="custom-control custom-radio">
						                	<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" <?php echo ($result->paymentMethod=='DEBIT CARD')?'checked':'' ?> value="debit card" required>
						                	<label class="custom-control-label" for="debit">Debit card</label>
						              	</div>
						            </div>
						            <div class="col-md-4 mb-3">
						              	<div class="custom-control custom-radio">
						                	<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" <?php echo ($result->paymentMethod=='COD')?'checked':'' ?> value="cod" required>
						                	<label class="custom-control-label" for="paypal">Cash on Delivery</label>
						              	</div>
						            </div>
						            <div class="col-md-3 mb-3">
						              	<div class="custom-control custom-radio">
						                	<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" <?php echo ($result->paymentMethod=='NET BANKING')?'checked':'' ?> value="net banking" required>
						                	<label class="custom-control-label" for="paypal">Net Banking</label>
						              	</div>
						            </div>
					            </div>
					            <hr class="mb-2">
					            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Continue to checkout</button>
				          	</form>
				        </div>
				    </div>
				</div>
				<div class="hr-dashed"></div>
<?php
			}
		}
	}
	else
	{
		echo '<script>alert("Please proceed checkout from your cart!");</script>';
		echo '<script>window.location.replace("my-cart.php");</script>';
	} 
}
else
{
	echo '<script>window.location.replace("/");</script>';
}
include("includes/footer.php"); 

?>