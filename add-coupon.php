<?php
session_start();
include("includes/dbgrad.php");
if(isset($_SESSION['uid']))
{
  if(!empty($_GET['couponcode']))
  {
    $userid=strtoupper($_SESSION['uid']);
    $ccode=strtoupper($_GET['couponcode']);
    
    $sql="UPDATE cart set coupon='YES',couponTag=:ccode,couponDiscount=100 where userid=:userid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ccode',$ccode,PDO::PARAM_STR); 
    $query->bindParam(':userid',$userid,PDO::PARAM_STR); 
    if($query->execute())
    {
    }
    else
    {
      echo "Coupon not added successfully!";
    }
  }
}
else
{
  echo '<script>window.location.replace("404-error.php");</script>';
}
?>