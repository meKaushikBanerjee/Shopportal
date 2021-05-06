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
if(isset($_POST['update']))
{
  if(isset($_POST['sadd']))
  {
    $sadd=strtoupper($_POST['sadd']);
  }
  if(isset($_POST['scon']))
  {
    $scon=strtoupper($_POST['scon']);
  }
  if(isset($_POST['sst']))
  {
    $sst=strtoupper($_POST['sst']);
  }
  if(isset($_POST['sct']))
  {
    $sct=strtoupper($_POST['sct']);
  }
  if(isset($_POST['spin']))
  {
    $szip=strtoupper($_POST['spin']);
  }  
  date_default_timezone_set("Asia/Kolkata");
  $udate=date("d/m/y H:i:s");
  $sql="UPDATE users set shippingAddress=:sadd,shippingCountry=:scon,shippingState=:sst,shippingCity=:sct,shippingPincode=:szip,updationDate=:udate where id=:userid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':sadd',$sadd,PDO::PARAM_STR);
  $query->bindParam(':scon',$scon,PDO::PARAM_STR);
  $query->bindParam(':sst',$sst,PDO::PARAM_STR);
  $query->bindParam(':sct',$sct,PDO::PARAM_STR);    
  $query->bindParam(':szip',$szip,PDO::PARAM_STR); 
  $query->bindParam(':udate',$udate,PDO::PARAM_STR);              
  if($query->execute())
  {
    $_SESSION['msg']="Account Updated Successfully!!";         
  }
  else
  {
    echo "<script>alert('Account could not be updated');</script>";
  }
}

if(isset($_SESSION['uid']))
{

?>

<body>

<?php include("includes/header.php"); ?>
  
  <div class="ts-main-content">

<?php 
    include('includes/sidebar.php');

    $userid=$_SESSION['uid'];
    $sql ="SELECT * FROM users WHERE id=:userid";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':userid', $userid, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      foreach($results as $result)
        {
?>
          <div class="content-wrapper">
            <div class="container-fluid"> 
              <div class="row">
                <div class="col-md-12">
                  <h2 class="page-title">Shipping Details</h2>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading">Last Updation date : &nbsp; <?php echo $result->updationDate;?> 
                        </div>
                        <div class="panel-body">
                          <?php 
                            if(isset($_POST['submit']))
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
                          <form method="post" action="" name="registration" class="form-horizontal">

                            <div class="form-group">
                              <label class="col-sm-2 control-label"> Shipping Address : </label>
                              <div class="col-sm-8">
                                <input type="text" name="sadd" id="sadd"  class="form-control" value="<?php echo $result->shippingAddress; ?>" >
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Shipping Country : </label>
                              <div class="col-sm-8">
                                <input type="text" name="scon" id="scon"  class="form-control" value="<?php echo $result->shippingCountry;?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Shipping State : </label>
                              <div class="col-sm-8">
                                <input type="text" name="sst" id="sst"  class="form-control" value="<?php echo $result->shippingState;?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Shipping City : </label>
                              <div class="col-sm-8">
                                <input type="text" name="sct" id="sct"  class="form-control" value="<?php echo $result->shippingCity;?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Shipping Pincode: </label>
                              <div class="col-sm-8">
                                <input type="text" name="spin" id="spin"  class="form-control" value="<?php echo $result->shippingPincode;?>">
                              </div>
                            </div>

                            <div class="col-sm-6 col-sm-offset-4">
                              <input type="submit" name="update" Value="Update" class="btn btn-primary">
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
        }
    }

?>

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