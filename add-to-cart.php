<?php
session_start();
include("includes/dbgrad.php");
if(isset($_SESSION['uid']))
{
	if(!empty($_GET['product_id']))
	{
		$userid=$_SESSION['uid'];
		$prodid=$_GET['product_id'];
		$sql="SELECT * from products where productid=:prodid";
	    $query = $dbh->prepare($sql);
	    $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);  
	    $query->execute();  
	    $count=$query->rowCount();
	    $data=$query->fetchAll(PDO::FETCH_OBJ);
	    if($query->rowCount() > 0)
	    {
	        foreach($data as $result)
	        {
	        	$productprice=$result->productPrice;
	        	$productname=$result->productName;
	        	$shippingprice=$result->shippingCharge;
	        	$discountpercent=$result->discountPercent;
	        	$discountprice=$result->discountPrice;
	        	$markedprice=$result->productFinalPrice;
	        	/*if($count==1)
	        	{*/
					$sql="INSERT INTO cart(userid,productid,productName,productPrice,shippingCharge,productQuantity,coupon,couponTag,couponDiscount,discountPercent,discountPrice,productFinalPrice,productTotalPrice) VALUES(:userid,:prodid,:productname,:productprice,:shippingprice,1,'NO','NULL',0,:discountpercent,:discountprice,:markedprice,:markedprice)";
					$query = $dbh->prepare($sql);
					$query->bindParam(':userid',$userid,PDO::PARAM_STR);    
					$query->bindParam(':prodid',$prodid,PDO::PARAM_STR);    
					$query->bindParam(':productname',$productname,PDO::PARAM_STR);    
					$query->bindParam(':productprice',$productprice,PDO::PARAM_STR);    
					$query->bindParam(':shippingprice',$shippingprice,PDO::PARAM_STR);
					$query->bindParam(':markedprice',$markedprice,PDO::PARAM_STR);    
					$query->bindParam(':discountprice',$discountprice,PDO::PARAM_STR);    
					$query->bindParam(':discountpercent',$discountpercent,PDO::PARAM_STR);
					if($query->execute())
					{
					}
					else
					{
						echo "Product not added to cart successfully!";
					}
				/*}
				else
				{
					$count+=1;
					$sql="UPDATE cart set userid=:userid,productid=:prodid,productName:productname,productPrice=:productprice,shippingCharge=:shippingprice,productQuantity=:count,coupon='NO',couponTag='NULL',couponDiscount='0',discountPercent=:discountpercent,discountPrice=:discountprice,productFinalPrice=:markedprice where user";
					$query = $dbh->prepare($sql);
					$query->bindParam(':userid',$userid,PDO::PARAM_STR);    
					$query->bindParam(':prodid',$prodid,PDO::PARAM_STR);    
					$query->bindParam(':productname',$productname,PDO::PARAM_STR);    
					$query->bindParam(':productprice',$productprice,PDO::PARAM_STR);    
					$query->bindParam(':shippingprice',$shippingprice,PDO::PARAM_STR);
					$query->bindParam(':markedprice',$markedprice,PDO::PARAM_STR);    
					$query->bindParam(':discountprice',$discountprice,PDO::PARAM_STR);    
					$query->bindParam(':discountpercent',$discountpercent,PDO::PARAM_STR);
					$query->bindParam(':count',$count,PDO::PARAM_STR); 
					if($query->execute())
					{
					}
					else
					{
						echo "Product not added to cart successfully!";
					}
				}*/
			}
		}
		else
		{
			echo "Product not found";
		}
	}
	else
	{
		echo "Product Id not given";
	}
}
else
{
	echo '<script>window.location.replace("404-error.php");</script>';
}
?>