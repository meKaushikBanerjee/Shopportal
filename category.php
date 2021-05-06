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
?>

<?php include("includes/sidebar-filter.php") ?>

<div id="main">

<?php 
	include("includes/searchbar.php");
	include("includes/navbar.php");
?>
	<div class="cat-product-container">
		<button class="openbtn" onclick="openNav()"><i class="fa fa-filter"></i> Filter Products</button>
		<div class="hr-dashed"></div>
		<div class="row">

<?php

	if((isset($_GET['pcat']))&&(isset($_GET['scat'])))
	{		
		$pcatid=$_GET['pcat'];
		$subcatid=$_GET['scat'];
		$sql="SELECT * from products where parentcategoryid=:pcatid and subcategoryid=:subcatid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':pcatid',$pcatid,PDO::PARAM_STR);		
		$query->bindParam(':subcatid',$subcatid,PDO::PARAM_STR);	
		$query->execute();	
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			foreach($results as $result)
			{
?>
				<div class="col-md-3 col-sm-6">
				    <div class="cat-product-grid4">
				        <div class="cat-product-image4">
				            <a href="#">
				                <img class="cat-pic-1" src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>">
				                <img class="cat-pic-2" src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage2; ?>">
				            </a>
				            <ul class="cat-social">
				                <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
				                <li><a href="#" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
				                <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
				            </ul>
				        	<span class="cat-product-new-label">New</span>
				            <span class="cat-product-discount-label">-10%</span>
				        </div>
				        <div class="cat-product-content">
				            <h3 class="cat-title"><a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><?php echo $result->productName; ?></a></h3>
				            <div class="cat-price">
				                <?php echo $result->productFinalPrice ?>
				            </div>
				            <a class="cat-add-to-cart" href="">ADD TO CART</a>
				        </div>
				    </div>
				</div>
<?php
			}
		}
	}
	else 
	{
		echo '<script>window.location.replace("/")</script>';
	}
?>	
		</div>
	</div>
	<div class="hr-dashed"></div>
</div>

<?php include ("includes/footer.php"); ?>