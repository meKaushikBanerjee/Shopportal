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
            <h2 class="page-title">Pending Reviews</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from productreviews where userid=:userid and status=0";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {                                    
                  ?>
                        <tr>
                          <td scope="row"><?php echo $result->productName; ?></td>
                          <td scope="row"><img src="../admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage; ?>" style="width:80px;height: 80px;" /></td>
                          <td scope="row" style="color: green;text-align: center;">Delivered</td>       
                          <td scope="row" style="text-align:center;"><a href="review-detail.php?pid=<?php echo $result->productid;?>" class="btn btn-primary">Review</a></td>
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

  <div class="ts-main-content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Reviewed Orders</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quanlity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Value</th>
                    <th scope="col">Comment</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from productreviews where userid=:userid and status=1";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {                          
                  ?>
                        <tr>
                          <td scope="row"><?php echo $result->productName; ?></td>
                          <td scope="row"><img src="../admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage; ?>" style="width:80px;height: 80px;" /></td>
                                <td scope="row">
                                <?php
                                  if($result->quality==5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->quality==4)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->quality==3)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->quality==2)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->quality==1)
                                  {
                                ?>
                                  <i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->quality==4.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->quality==3.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->quality==2.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->quality==1.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->quality==0.5)
                                  {
                                ?>
                                  <i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                ?>
                                </td>
                                <td scope="row">
                                  <?php
                                  if($result->price==5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->price==4)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->price==3)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->price==2)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->price==1)
                                  {
                                ?>
                                  <i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->price==4.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->price==3.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->price==2.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->price==1.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->price==0.5)
                                  {
                                ?>
                                  <i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                ?>
                                </td>
                                <td scope="row">
                                  <?php
                                  if($result->value==5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->value==4)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->value==3)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->value==2)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->value==1)
                                  {
                                ?>
                                  <i class="fa fa-star"></i>
                                <?php
                                  }
                                  elseif($result->value==4.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->value==3.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->value==2.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->value==1.5)
                                  {
                                ?>
                                  <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                  elseif($result->value==0.5)
                                  {
                                ?>
                                  <i class="fa fa-star-half-o"></i>
                                <?php
                                  }
                                ?>
                                </td>
                                <td scope="row"><?php echo $result->review; ?></td>
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

<?php 
}
else
{
  echo '<script>alert("Kindly login!");</script>';
  echo '<script>window.location.replace("/login-signup.php");</script>';
}
include('includes/footer.php'); 

?>