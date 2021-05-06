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

if(isset($_SESSION['uid']))
{
	$userid=$_SESSION['uid'];

?>
	<script type="text/javascript">
	    function remove_wishlist_product(val) 
	    {
	        var request = new XMLHttpRequest();
	        request.onreadystatechange = function() {
		        if(this.readyState === 4 && this.status === 200){
		            alert("Product removed from wishlist successfully!");
		            location.reload(); 
		        }
		       	if(this.readyState === 4 && this.status === 204){
		            alert("Product could not be removed from wishlist!");
		            location.reload(); 
		        }
		    };
	        request.open("GET", "delete-from-wishlist.php?product_id="+val , true);
	        request.send();
	    }
	    function add_product(val) 
	    {
	        var request = new XMLHttpRequest();
	        request.onreadystatechange = function() {
	            if(this.readyState === 4 && this.status === 200){                    
	                alert("Product added to cart successfully!");
	                location.reload(); 
	            }
	            if(this.readyState === 4 && this.status === 204){
	                alert("Product could not be added to cart!");
	                location.reload(); 
	            }
	       };
	        request.open("GET", "add-to-cart.php?product_id="+val , true);
	        request.send();
	    }
	</script>

	<div class="container">
		<h3>My wishlist</h3>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Product Name</th>
					    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Product Image</th>
					    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Unit Price</th>
					    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Stock Status</th>
					    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Add to Cart</th>
					    <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Remove from Wishlist</th>
					</tr>
				</thead>
				<tbody>
<?php
	$sql="SELECT * from wishlist wi join products prod on wi.productid=prod.productid where wi.userid=:userid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':userid',$userid,PDO::PARAM_STR);	
	$query->execute();	
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
?>	

					<tr>
					    <td>					        
		                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" alt="" class="mCS_img_loaded" style="width: 80px;height: 80px;">
		                </td>
		                <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->productName; ?></td>
					    <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->productPrice; ?></td>
					    <?php 
					    	if($result->productAvailability=="IN STOCK")
					    	{
					    ?>
					    		<td style="text-align: center; font-weight: 500;font-size: 16px;color: green;">In Stock</td>
					    <?php 
					    	}
					    	else
					    	{
					    ?>
					    		<td style="text-align: center; font-weight: 500;font-size: 16px;color: red;">Out of Stock</td>
					   	<?php 
					   		}
					   	?>
					    <td style="margin-left: 25%;">
					        <button style="margin-left: 30%;" class="fa fa-plus" onclick="add_product('<?php echo $result->productid; ?>')"></button>
					    </td>
					    <td style="margin-left: 25%;">
					        <button style="margin-left: 30%;" class="fa fa-trash" onclick="remove_wishlist_product('<?php echo $result->productid; ?>')"></button>
					    </td>
					</tr>
<?php
		}
	}
?>
				</tbody>
			</table>
		</div>
	</div>

<?php 
}
else
{
	echo '<script>window.location.replace("login-signup.php");</script>';
}
include ("includes/footer.php"); 
?>