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
            <h2 class="page-title">Registered Users</h2>
            <table id="zctb" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Mobile</th>
                  <th scope="col">Shipping Address/City/State/Pincode</th>
                  <th scope="col">Registration Date</th>
                  <th scope="col">Updation Date</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $sql="SELECT * from users";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                    {
                ?>
                      <tr>
                        <th scope="row"><?php echo htmlentities($result->id); ?></th>
                        <td><?php echo htmlentities($result->name); ?></td>
                        <td><?php echo htmlentities($result->email); ?></td>
                        <td><?php echo htmlentities($result->contactno); ?></td>
                        <td><?php echo htmlentities($result->shippingAddress);
                                  echo htmlentities($result->shippingCity);
                                  echo htmlentities($result->shippingState);
                                  echo htmlentities($result->shippingPincode); ?></td>
                        <td><?php echo htmlentities($result->regDate); ?></td>
                        <td><?php echo htmlentities($result->updationDate); ?></td>
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

<?php include('includes/footer.php'); ?>