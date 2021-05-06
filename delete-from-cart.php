<?php
session_start();
include("includes/dbgrad.php");
if(!empty($_GET['product_id']))
{
	$userid=$_SESSION['uid'];
	$productid=$_GET['product_id'];
	$sql="DELETE from cart where userid=:userid and productid=:productid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':userid',$userid,PDO::PARAM_STR);    
	$query->bindParam(':productid',$productid,PDO::PARAM_STR);
	if($query->execute())
	{
		$sql="SELECT * from cart";
        $query = $dbh->prepare($sql);
        $query->execute();
        $row=$query->rowCount();
        if($row==0)
        {
            $sql="DELETE from orders where userid=:userid";
			$query = $dbh->prepare($sql);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			if($query->execute())
			{
			}
			else
			{
				echo "Orders table not cleared!";
			}
        }
	}
	else
	{
		echo "Product not removed from cart!";
	}
}
else
{
	echo '<script>window.location.replace("404-error.php");</script>';
}
?>