<?php 
include('includes/mainheader.php');
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 60*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  header('Location: ../logout.php');
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}
if(isset($_SESSION['uid']))
{
  $userid=$_SESSION['uid'];
?>

<body>

<?php include("includes/header.php"); ?>
  
  <div class="ts-main-content">

<?php 
    include('includes/sidebar.php');
?>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Ongoing Orders</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Status</th>
                    <th scope="col">Track Order</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from customerorders where userid=:userid and (orderStatus=0 or orderStatus=1 or orderStatus=2 or orderStatus=3 or orderStatus=5)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                        $pid=unserialize($result->productid);
                        $pquant=unserialize($result->quantity);  
                        $prid=count($pid);                    
                        $i=0;
                        while(!empty($pid[$i]) && ($pquant[$i]))
                        {
                          $prodid=$pid[$i];
                          $prodquant=$pquant[$i];
                          $mysql="SELECT productName,productImage1,productid from products where productid=:prodid";
                          $query = $dbh->prepare($mysql);
                          $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);
                          $query->execute();
                          $data=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                            foreach($data as $dt)
                            {                            
                              if($i==0)
                              {                          
                  ?>
                                <tr>
                                  <th rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->orderid; ?></th>
                                  <td scope="row"><?php echo $dt->productName; ?></td>
                                  <td scope="row"><img src="../admin/productimages/<?php echo $dt->productid; ?>/<?php echo $dt->productImage1; ?>" style="width:80px;height: 80px;" /></td>
                                  <td scope="row"><?php echo $prodquant; ?></td>
                                  <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->orderDate; ?></td>
                                  <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->paymentMethod; ?></td>
                                  <td rowspan="<?php echo $prid; ?>" scope="rowgroup">
                                    <?php
                                      if($result->orderStatus==0)
                                      {
                                    ?>
                                        <p style="color: red;text-align: center;font-weight: 500;">
                                          Confirmation Awaited from Seller</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==1)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Processed</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==2)
                                      {
                                    ?>  
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Shipped</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==3)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Out for Delivery</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==6 || $result->orderStatus==7 )
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Cancelled</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==5)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Confirmed by Seller</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==4)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Delivered</p>
                                    <?php
                                      }
                                    ?> 
                                  </td>
                                  <td rowspan="<?php echo count($pid);?>" scope="rowgroup" style="text-align:center;"><a href="order-details.php?oid=<?php echo $result->orderid;?>"><i class="fa fa-map-marker"></i></a></td>
                                </tr>
                  <?php
                              }
                              else
                              {
                  ?>
                                <tr>
                                  <td scope="row"><?php echo $dt->productName; ?></td>
                                  <td scope="row"><img src="../admin/productimages/<?php echo $dt->productid; ?>/<?php echo $dt->productImage1; ?>" style="width:80px;height: 80px;" /></td>
                                  <td scope="row"><?php echo $prodquant; ?></td>
                                </tr>
                  <?php
                              }
                            }
                          }
                          ++$i;
                        }
                      }
                    }
                  ?>                                    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="ts-main-content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Previous Orders</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Status</th>
                    <th scope="col">Download Invoice</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from customerorders where userid=:userid and (orderStatus=4 or orderStatus=6 or orderStatus=7)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                        $pid=unserialize($result->productid);
                        $pquant=unserialize($result->quantity);  
                        $prid=count($pid);                    
                        $i=0;
                        while(!empty($pid[$i]) && ($pquant[$i]))
                        {
                          $prodid=$pid[$i];
                          $prodquant=$pquant[$i];
                          $mysql="SELECT productName,productImage1,productid from products where productid=:prodid";
                          $query = $dbh->prepare($mysql);
                          $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);
                          $query->execute();
                          $data=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                            foreach($data as $dt)
                            {                            
                              if($i==0)
                              {                          
                  ?>
                                <tr>
                                  <th rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->orderid; ?></th>
                                  <td scope="row"><?php echo $dt->productName; ?></td>
                                  <td scope="row"><img src="../admin/productimages/<?php echo $dt->productid; ?>/<?php echo $dt->productImage1; ?>" style="width:80px;height: 80px;" /></td>
                                  <td scope="row"><?php echo $prodquant; ?></td>
                                  <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->orderDate; ?></td>
                                  <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->paymentMethod; ?></td>
                                  <td rowspan="<?php echo $prid; ?>" scope="rowgroup">
                                    <?php
                                      if($result->orderStatus==0)
                                      {
                                    ?>
                                        <p style="color: red;text-align: center;font-weight: 500;">
                                          Confirmation Awaited from Seller</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==1)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Processed</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==2)
                                      {
                                    ?>  
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Shipped</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==3)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Out for Delivery</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==6 || $result->orderStatus==7 )
                                      {
                                    ?> 
                                        <p style="color: red;text-align: center;font-weight: 500;">
                                          Cancelled</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==5)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Confirmed by Seller</p>
                                    <?php
                                      }
                                      elseif($result->orderStatus==4)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Delivered</p>
                                    <?php
                                      }
                                    ?> 
                                  </td>
                                  <td rowspan="<?php echo count($pid);?>" scope="rowgroup" style="text-align:center;"><a href="invoice.php?oid=<?php echo $result->orderid;?>&uid=<?php echo $userid; ?>"><i class="fa fa-download"></i></a></td>
                                </tr>
                  <?php
                              }
                              else
                              {
                  ?>
                                <tr>
                                  <td scope="row"><?php echo $dt->productName; ?></td>
                                  <td scope="row"><img src="../admin/productimages/<?php echo $dt->productid; ?>/<?php echo $dt->productImage1; ?>" style="width:80px;height: 80px;" /></td>
                                  <td scope="row"><?php echo $prodquant; ?></td>
                                </tr>
                  <?php
                              }
                            }
                          }
                          ++$i;
                        }
                      }
                    }
                  ?>                                    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php 
}
else
{
  echo '<script>alert("Kindly login!");</script>';
  echo '<script>window.location.replace("/login-signup.php");</script>';
}
include('includes/footer.php'); 

?>