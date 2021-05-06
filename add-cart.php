<?php
include("includes/dbgrad.php");
if(!empty($_POST['product_id']))
{
	$userid=$_SESSION['uid'];
	$prodid=$_POST['product_id'];
	$sql="SELECT * from products where productid=:prodid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);  
    $query->execute();  
    $data=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        foreach($data as $result)
        {
        	$productprice=$result->productPrice;
        	$productname=$result->productName;
        	$shippingprice=$result->shippingCharge;
			$sql="INSERT INTO cart(userid,productid,productName,productPrice,shippingCharge,productQuantity) VALUES(:userid,:prodid,:productname,:productprice,:shippingprice,1)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);    
			$query->bindParam(':prodid',$prodid,PDO::PARAM_STR);    
			$query->bindParam(':productname',$productname,PDO::PARAM_STR);    
			$query->bindParam(':productprice',$productprice,PDO::PARAM_STR);    
			$query->bindParam(':shippingprice',$shippingprice,PDO::PARAM_STR);
			if($query->execute())
			{
				echo "Product added to cart successfully!";
			}
			else
			{
				echo "Product not added to cart successfully!";
			}
		}
	}
	else
	{
		echo "Product not found";
	}
}
else
{
	echo '<script>window.location.replace("404-error.php");</script>';
}
?>