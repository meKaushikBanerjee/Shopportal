<?php
session_start();
include("includes/dbgrad.php");
if(isset($_SESSION['uid']))
{
  if((!empty($_GET['quant']))&&(!empty($_GET['product_id'])))
  {
    $userid=strtoupper($_SESSION['uid']);
    $quant=$_GET['quant'];    
    $pid=$_GET['product_id'];
    $p=0;$f=0;
    $sql="SELECT * from cart where userid='$userid' and productid='$pid'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      foreach($results as $result)
      {
        $f=$result->productFinalPrice; 
        $f=$f*$quant;
        $qt=$result->productQuantity;      
        if($qt<>$quant)
        {
          $sql="UPDATE cart set productQuantity=:quant,productTotalPrice=:f where userid=:userid and productid=:pid";
          $query = $dbh->prepare($sql);
          $query->bindParam(':quant',$quant,PDO::PARAM_STR); 
          $query->bindParam(':pid',$pid,PDO::PARAM_STR); 
          $query->bindParam(':userid',$userid,PDO::PARAM_STR); 
          $query->bindParam(':f',$f,PDO::PARAM_STR); 
          if($query->execute())
          {
          }
          else
          {
            echo "Quantity could not be changed!";
          }
        }
        $p=0;$f=0;
      }
    }
  }
}
else
{
  echo '<script>window.location.replace("404-error.php");</script>';
}
?>