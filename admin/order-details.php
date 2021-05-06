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

if(isset($_POST['update']))
{
  $uid=$_POST['uid'];
  $id=$_POST['oid'];
  if(!empty($_POST['status']))
  {
    $status=$_POST['status'];
    if(!empty($_POST['reason']))
    {
      $reason=strtoupper($_POST['reason']);
    }
    else
    {
      $reason="NONE";
    }
  }
      $sql="UPDATE customerorders set orderStatus=:status,cancelReason=:reason where orderid=:id and userid=:uid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':id',$id,PDO::PARAM_STR);
      $query->bindParam(':uid',$uid,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR); 
      $query->bindParam(':reason',$reason,PDO::PARAM_STR);
      if($query->execute())
      {        
        $_SESSION['msg']="Order Status Updated Successfully!!";         
      }
      else
      {
        $_SESSION['msg']="Order Status not updated!!";
      }
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
            <h2 class="page-title">Update Order Status</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Update Order Status</div>
                    <div class="panel-body">
                      <?php 
                        if(isset($_POST['update']))
                        { 
                      ?>
                        <div class="alert alert-error" style="color: green;">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo htmlentities($_SESSION['msg']); ?>
                            <?php echo htmlentities($_SESSION['msg']=""); ?>
                        </div>
                      <?php 
                        }
                      ?>

                      <form method="post" class="form-horizontal">

                        <div class="hr-dashed"></div>
                        <?php 
                          $id=$_GET['oid'];
                          $uid=$_GET['uid'];
                          $sql="SELECT * from customerorders where orderid=:id and userid=:uid and (orderStatus=0 or orderStatus=1 or orderStatus=2 or orderStatus=3 or orderStatus=5)";
                          $query = $dbh->prepare($sql);
                          $query->bindParam(':id',$id,PDO::PARAM_STR);
                          $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                            foreach($results as $result)
                            {
                        ?>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Order Id</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="oid" id="oid" value="<?php echo $result->orderid; ?>" readonly>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">User Id</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="uid" id="uid" value="<?php echo $result->userid; ?>" readonly>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Ordered By</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="oby" id="oby" value="<?php echo $result->userName; ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                  <select name="status" id="status" class="form-control" onchange="showhide()" required>
                                    <option value="">Select</option>
                                    <option value="0">Awaiting Confirmation from Seller</option>
                                    <option value="5">Confirmed by Seller</option>
                                    <option value="1">Processed</option>
                                    <option value="2">Shipped</option>
                                    <option value="3">Out for Delivery</option>
                                    <option value="4">Delivered</option>
                                    <option value="6">Cancelled by Seller</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group" id="reason" style="display: none;">
                                <label class="col-sm-2 control-label">Reason for Cancellation</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="reason">
                                </div>
                              </div>
                              <div class="col-sm-8 col-sm-offset-5">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Order Status">
                              </div>
                        <?php
                            }
                          }
                        ?>
                      </form>
                    </div>
                    <div class="table-responsive">
                    
                        <?php 
                          $id=$_GET['oid'];
                          $uid=$_GET['uid'];
                          $sql="SELECT * from customerorders where userid=:uid and orderid=:id and (orderStatus=0 or orderStatus=1 or orderStatus=2 or orderStatus=3 or orderStatus=5)";
                          $query = $dbh->prepare($sql);
                          $query->bindParam(':uid',$uid,PDO::PARAM_STR);                  
                          $query->bindParam(':id',$id,PDO::PARAM_STR);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                        ?>
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">Product Id</th>
                                  <th scope="col">Product Name</th>
                                  <th scope="col">Quantity</th>
                                  <th scope="col">Product Price</th>
                                  <th scope="col">Discount</th>
                                  <th scope="col">Total Product Price</th>
                                  <th scope="col">Shipping Charge</th>
                                  <th scope="col">Coupon Discount</th>
                                  <th scope="col">Total Order Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                        <?php
                            foreach($results as $result)
                            {
                              $pid=unserialize($result->productid);
                              $pquant=unserialize($result->quantity);
                              $pprice=unserialize($result->productPrice);
                              $ptprice=unserialize($result->productTotalPrice);
                              $pdiscount=unserialize($result->productDiscount);
                              $prid=count($pid);                    
                              $i=0;
                              while(!empty($pid[$i]) && ($pquant[$i]))
                              {
                                $prodid=$pid[$i];
                                $prodquant=$pquant[$i];
                                $prodprice=$pprice[$i];
                                $prodtotprice=$ptprice[$i];
                                $proddis=$pdiscount[$i];
                                $mysql="SELECT productName,productid from products where productid=:prodid";
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
                                        <td scope="row"><?php echo $dt->productid; ?></td>
                                        <td scope="row"><?php echo $dt->productName; ?></td>
                                        <td scope="row"><?php echo $prodquant; ?></td>
                                        <td scope="row"><?php echo $prodprice; ?></td>
                                        <td scope="row"><?php echo $proddis; ?></td>
                                        <td scope="row"><?php echo $prodtotprice; ?></td>
                                        <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->shippingCharge; ?></td>
                                        <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->couponDiscount; ?></td>
                                        <td rowspan="<?php echo $prid; ?>" scope="rowgroup"><?php echo $result->totalPrice; ?></td>
                                      </tr>
                        <?php
                                    }
                                    else
                                    {
                        ?>
                                      <tr>
                                        <td scope="row"><?php echo $dt->productid; ?></td>
                                        <td scope="row"><?php echo $dt->productName; ?></td>
                                        <td scope="row"><?php echo $prodquant; ?></td>
                                        <td scope="row"><?php echo $prodprice; ?></td>
                                        <td scope="row"><?php echo $proddis; ?></td>
                                        <td scope="row"><?php echo $prodtotprice; ?></td>
                                      </tr>
                        <?php
                                    }
                                  }
                                }
                                ++$i;
                              }
                            }
                        ?>                                   
                              </tbody>
                            </table>

                        <?php
                          }
                        ?>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function showhide()
    {
      var x = document.getElementById("status").value;
      if(x==6)
      {
        document.getElementById("reason").style.display = 'block';
      }
      else
      {
        document.getElementById("reason").style.display = 'none';
      }
    }
  </script>

<?php include('includes/footer.php'); ?>