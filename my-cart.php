<?php 
$page=0;
$prodid=0;
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

if(isset($_SESSION['uid']))
{
	$userid=$_SESSION['uid'];

?>

	<script type="text/javascript">

	    function remove_product(val) 
	    {
	        var request = new XMLHttpRequest();
	        request.onreadystatechange = function() {
		        if(this.readyState === 4 && this.status === 200){
		            alert("Product removed from cart successfully!");
		            location.reload(); 
		        }
		       	if(this.readyState === 4 && this.status === 204){
		            alert("Product could not be removed from cart!");
		            location.reload(); 
		        }
		    };
	        request.open("GET", "delete-from-cart.php?product_id="+val , true);
	        request.send();
	    }
	    function add_coupon() 
	    {
	    	var ccode = $("#ccode").val();
	    	if((ccode!="")||(ccode!=0))
	    	{
		    	var request = new XMLHttpRequest();
		        request.onreadystatechange = function() {
			        if(this.readyState === 4 && this.status === 200){
			            alert("Coupon added successfully!");
			            location.reload();
			            event.preventDefault(); 
			        }
			       	if(this.readyState === 4 && this.status === 204){
			            alert("Coupon could not added!");
			            location.reload(); 
			            event.preventDefault();
			        }
			    };
		        request.open("GET", "add-coupon.php?couponcode="+ccode , true);
		        request.send();
		    }
		    else
		    {
		    	alert("Add product first");
		    	location.replace("/");
		    }
	    }    
	    function remove_coupon() 
	    {
	    	var request = new XMLHttpRequest();
	        request.onreadystatechange = function() {
		        if(this.readyState === 4 && this.status === 200){
		            alert("Coupon removed successfully!");
		            location.reload();
		            event.preventDefault(); 
		        }
		       	if(this.readyState === 4 && this.status === 204){
		            alert("Coupon could not removed!");
		            location.reload(); 
		            event.preventDefault();
		        }
		    };
	        request.open("GET" , "remove-coupon.php" , true);
	        request.send();
	    }
	    function quant_price(val,pid) 
	    {
	      	var request = new XMLHttpRequest();
	        request.onreadystatechange = function() {
		        if(this.readyState === 4 && this.status === 200){
		            location.reload();
		            event.preventDefault(); 
		        }
		       	if(this.readyState === 4 && this.status === 204){
		       		alert("Quantity could not be changed!");
		            location.reload(); 
		            event.preventDefault();
		        }
		    };
	        request.open("POST", "change-quantity.php?quant="+val+'&product_id='+pid , true);
	        request.send();
	    }
	    function add_total_price(val) 
	    {
	    	if((val!="")||(val!=0))
	    	{
		      	var request = new XMLHttpRequest();
		        request.onreadystatechange = function() {
			        if(this.readyState === 4 && this.status === 200){
			        	var id = this.responseText;
			            window.location.replace("billing-details.php?id="+id);
			            event.preventDefault(); 
			        }
			       	if(this.readyState === 4 && this.status === 204){
			       		alert("Total Price could not be set!");
			            location.reload(); 
			            event.preventDefault();
			        }
			    };
		        request.open("GET", "add-to-order.php?total="+val , true);
		        request.send();
		    }
		    else
		    {
		    	alert("Add product first");
		    	location.replace("/");
		    }
	    }
	</script>

	<div class="container">
		<h3>My Cart</h3>
	    <div class="hr-dashed"></div>
		<div class="row">
			<div class="col-lg-8">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Product</th>
							    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;"></th>
							    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Quantity</th>
							    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Amount</th>
							    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Discount</th>
							    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Remove</th>
							</tr>
						</thead>
						<tbody>
<?php
	$sql="SELECT * from cart ct join products prod on ct.productid=prod.productid where ct.userid=:userid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':userid',$userid,PDO::PARAM_STR);	
	$query->execute();	
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
			$prodid=$result->productid;
?>	

						<tr>					    
			                <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->productName; ?></td>
			                <td>					        
			                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" alt="" class="mCS_img_loaded" style="width: 80px;height: 80px;">
			                </td>
						    <td style="text-align: center; font-weight: 500;font-size: 16px;">	  <select name="quantity" onChange="quant_price(this.value,<?php echo $result->productid; ?>);">
						    		<option value="<?php echo $result->productQuantity; ?>" readonly><?php echo $result->productQuantity; ?></option>
						    		<?php
						    			if($result->productQuantity==1) 
						    			{
						    		?>
						    				<option value="1" disabled>1</option>
										    <option value="2">2</option>
										    <option value="3">3</option>
										    <option value="4">4</option>
										    <option value="5">5</option>
										    <option value="6">6</option>
						    		<?php
						    			}
						    		?>	
						    		<?php
						    			if($result->productQuantity==2) 
						    			{
						    		?>
						    				<option value="1">1</option>
										    <option value="2" disabled>2</option>
										    <option value="3">3</option>
										    <option value="4">4</option>
										    <option value="5">5</option>
										    <option value="6">6</option>
						    		<?php
						    			}
						    		?>	
						    		<?php
						    			if($result->productQuantity==3) 
						    			{
						    		?>
						    				<option value="1">1</option>
										    <option value="2">2</option>
										    <option value="3" disabled>3</option>
										    <option value="4">4</option>
										    <option value="5">5</option>
										    <option value="6">6</option>
						    		<?php
						    			}
						    		?>			
						    		<?php
						    			if($result->productQuantity==4) 
						    			{
						    		?>
						    				<option value="1">1</option>
										    <option value="2">2</option>
										    <option value="3">3</option>
										    <option value="4" disabled>4</option>
										    <option value="5">5</option>
										    <option value="6">6</option>
						    		<?php
						    			}
						    		?>	
						    		<?php
						    			if($result->productQuantity==5) 
						    			{
						    		?>
						    				<option value="1">1</option>
										    <option value="2">2</option>
										    <option value="3">3</option>
										    <option value="4">4</option>
										    <option value="5" disabled>5</option>
										    <option value="6">6</option>
						    		<?php
						    			}
						    		?>	
						    		<?php
						    			if($result->productQuantity==6) 
						    			{
						    		?>
						    				<option value="1">1</option>
										    <option value="2">2</option>
										    <option value="3">3</option>
										    <option value="4">4</option>
										    <option value="5">5</option>
										    <option value="6" disabled>6</option>
						    		<?php
						    			}
						    		?>							   	
						    	</select>
							</td>
							<?php
								if($result->discountPrice==0)
								{
							?>
						    		<td style="text-align: center; font-weight: 500;font-size: 16px;" id=""><?php echo $result->productPrice; ?></td>
						   	<?php
						   		}
						   		else
						   		{
						   	?>
						   			<td style="text-align: center; font-weight: 500;font-size: 16px;">
						   				<p style="color: grey;text-decoration: line-through;"><?php echo $result->productPrice; ?></p>
						   				<p><?php echo $result->productTotalPrice; ?></p>
						   			</td>
						   	<?php
						   		}
						   	?>
						    <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->discountPrice; ?></td>
						    
						    <td style="margin-left: 25%;">
						        <button type="submit" style="margin-left: 30%;" class="fa fa-trash" onclick="remove_product('<?php echo $result->productid; ?>')"></button>
						    </td>
						</tr>
<?php
		}
	}
?>
						</tbody>
					</table>
				</div>
			    <div class="card">
			    	<!--<form id="myform">-->
			        	<div class="row">
			        		<div class="col-lg-6">
			           			<input type="text" name="ccode" id="ccode" class="form-control" placeholder="Enter your Coupon Code">
			           		</div>
			           	</div>
			           	<div class="row">
			           		<div class="col-lg-6 mt-3">
			            		<button type="submit" class="checkout round-black-btn" onclick="add_coupon()">Apply Coupon</button>
			            	</div>
			            </div>
			        <!--</form>-->
			    </div>
			</div>
<?php
		$totp=0;$totsc=0;$tot=0;
		$sql="SELECT * from cart where userid=:userid";
        /*$mysql="SELECT * from products prod join productreviews prodrev where prod.productid=prodrev.productid and prod.parentcategoryid=:pcatid and prod.subcategoryid=:subcatid and prod.productid=:prodid and prodrev.productid=:prodid";*/
        $query = $dbh->prepare($sql);
        $query->bindParam(':userid',$userid,PDO::PARAM_STR); 
        $query->execute();  
        $data=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
          	foreach($data as $result)
          	{
          		$dp=$result->discountPrice;
          		$cd=$result->couponDiscount;
          		$sc=$result->shippingCharge;
          		$tp=$result->productTotalPrice;
          		$totp=$totp+$tp;
          		$totsc=$totsc+$sc;
          		$tot=$totsc+$totp;
          		$ct=$result->couponTag;
          	}
        }
?>
			<div class="col-lg-4">
				<div class="cart-totals">
					<h3 style="font-weight: 600;text-decoration: underline;">Cart Amount</h3>
					<div class="hr-dashed"></div>
					<table class="table table-responsive">
						<tbody>
						    <tr>
						        <td>Product Price:</td>
						        <td class="subtotal"><?php echo $totp; ?></td>
						    </tr>
						    <tr>
						        <td>Shipping Charges:</td>
						        <td class="subtotal"><?php echo $totsc; ?></td>
						    </tr>
						    <?php
						    	if(!empty($cd))
						    	{
						    ?>
								    <tr>
								    	<p class="fa fa-ticked" style="color: green;font-size: 14px;">Coupon has been added!</p>
								    	<p style="font-size: 14px;font-weight: 500;">Coupon Code: <?php echo $ct; ?></p>
								    	<p style="font-size: 14px;font-weight: 500;">Coupon Discount: <?php echo $cd; ?>
								    		<button type="submit" style="margin-left: 25%;" class="fa fa-trash" id="tooltip" onclick="remove_coupon();"></button>
								    		<span class="tooltiptext">Remove coupon</span>
								    	</p>
								    </tr>
								    <tr class="total-row">
								        <td>Total:</td>
								        <td class="price-total"><?php $tot=$tot-$cd; echo $tot; ?></td>
								    </tr>
						    <?php
						    	}
						    	else
						    	{
						    ?>
						    		<tr class="total-row">
								        <td>Total:</td>
						    			<td class="price-total"><?php echo $tot; ?></td>
						    		</tr>
						    <?php
						    	}
				          		$dp=0;
				          		$cd=0;
				          		$sc=0;
				          		$tp=0;
				          		$totp=0;
				          		$totsc=0;
				          		$totalprice=$tot;
				          		$tot=0;
				          		$ct="";
						    ?>					    
						</tbody>
					</table>
					<div class="btn-cart-totals">
						<!--<a href="#" class="update round-black-btn" title="">Update Cart</a>-->
						<button type="submit" class="checkout round-black-btn" onclick="add_total_price(<?php echo $totalprice; ?>)">Checkout</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hr-dashed"></div>

<?php 
}
else
{
	echo '<script>window.location.replace("login-signup.php");</script>';
} 
include ("includes/footer.php"); 
?>