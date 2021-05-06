<?php
session_start();
include("includes/dbgrad.php");
if(isset($_SESSION['uid']))
{
  $userid=strtoupper($_SESSION['uid']);
  $sql="UPDATE cart set coupon='NO',couponTag='NONE',couponDiscount=0 where userid=:userid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':userid',$userid,PDO::PARAM_STR); 
  if($query->execute())
  {
  }
  else
  {
      echo "Coupon not removed successfully!";
  }
}
else
{
  echo '<script>window.location.replace("404-error.php");</script>';
}
?>