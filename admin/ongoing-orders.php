<?php 
include('includes/mainheader.php');
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 5*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  echo '<script>alert("You have been idle for 5 minutes");</script>';
  echo '<script>window.location.replace("../logout.php");</script>';
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}
?>

<body>

<?php include("includes/header.php");?>
  
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
              <table id="zctb" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Ordered By</th>
                    <th scope="col">Product Ids</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from customerorders where (orderStatus=5 or orderStatus=1 or orderStatus=2 or orderStatus=3)";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                        $pid=unserialize($result->productid);
                        $pname=unserialize($result->productName);
                        $pquant=unserialize($result->quantity);
                        $i=0;
                  ?>
                        <tr>
                          <th scope="row"><?php echo $result->orderid; ?></th>
                          <td><?php echo $result->userid; ?></td>
                          <td><?php echo $result->userName; ?></td>
                          <td>
                            <?php                             
                              while(!empty($pid[$i]))
                              {
                                echo $pid[$i];
                                ++$i;
                            ?> , 
                            <?php
                              }
                              $i=0;
                            ?>
                          </td>
                          <td>
                            <?php                             
                              while(!empty($pquant[$i]))
                              {
                                echo $pquant[$i]; 
                                ++$i;
                             ?> , 
                            <?php
                              }
                              $i=0;
                            ?>
                          </td>
                          <td><?php echo $result->orderDate; ?></td>
                          <td><?php echo $result->paymentMethod; ?></td>                     
                          <td>
                            <?php
                                    if($result->orderStatus==1)
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
                                      elseif($result->orderStatus==5)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Confirmed by Seller</p>
                                    <?php
                                      }
                                    ?> 
                          </td>
                          <td><a href="order-details.php?oid=<?php echo $result->orderid;?>&uid=<?php echo $result->userid;?>"><i class="fa fa-edit"></i></a></td>
                        </tr>
                  <?php
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

<?php include('includes/footer.php'); ?>