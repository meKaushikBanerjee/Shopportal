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

if(isset($_POST['refresh']))
{
  $sql="DELETE from userlog";
  $query = $dbh->prepare($sql);              
  if($query->execute())
  {    
    $_SESSION['delmsg']="Access Log Cleared Successfully!!";
  }
  else
  {
  	$_SESSION['delmsg']="Access Log could not be Cleared!!";
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
            <h2 class="page-title">Users Access Log</h2>
            <div class="col-sm-8">
            	<form name="refreshaccesslog" method="post" enctype="multipart/form-data">
                	<input class="btn btn-primary" type="submit" name="refresh" onclick="return confirm('Want to delete all present accesslog from database????');" value="Clear Access Log">
                </form>
            </div>
            <h2 class="page-title"></h2>
            <?php 
                if(isset($_POST['refresh']))
                { 
            ?>
                    <div class="alert alert-error" style="color: green;">
	                  	<button type="button" class="close" data-dismiss="alert">×</button>
	                  	<?php echo htmlentities($_SESSION['delmsg']); ?>
	                  	<?php echo htmlentities($_SESSION['delmsg']=""); ?>
	                </div>
            <?php 
                }
            ?>
            <table id="zctb" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">User Id</th>
                  <th scope="col">User Name</th>
                  <th scope="col">User Email</th>
                  <th scope="col">User IP</th>
                  <th scope="col">Login Time</th>
                  <th scope="col">Logout Time</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $sql="SELECT * from userlog";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                    {
                ?>
                      <tr>
                        <td><?php echo htmlentities($result->userid); ?></td>
                        <td><?php echo htmlentities($result->userName); ?></td>
                        <td><?php echo htmlentities($result->userEmail); ?></td>
                        <td><?php echo htmlentities($result->userIp); ?></td>
                        <td><?php echo htmlentities($result->loginTime); ?></td>
                        <td><?php echo htmlentities($result->logoutTime); ?></td>
                        <td><?php echo htmlentities($result->status); ?></td>
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