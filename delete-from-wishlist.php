<?php
session_start();
include("includes/dbgrad.php");
if(!empty($_GET['product_id']))
{
  $userid=$_SESSION['uid'];
  $productid=$_GET['product_id'];
  $sql="DELETE from wishlist where userid=:userid and productid=:productid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':userid',$userid,PDO::PARAM_STR);    
  $query->bindParam(':productid',$productid,PDO::PARAM_STR);
  if($query->execute())
  {
  }
  else
  {
    echo "Product not removed from wishlist!";
  }
}
else
{
  echo '<script>window.location.replace("404-error.php");</script>';
}
?>