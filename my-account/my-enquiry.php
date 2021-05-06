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
            <h2 class="page-title">Recent Enquiry</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Enquiry Id</th>
                    <th scope="col">Issue</th>
                    <th scope="col">Enquiry Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from enquiry where userid=:userid and (enquiryStatus=0 or enquiryStatus=1)";
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
                          <td><?php echo $result->enquiryid; ?></td>
                          <td><?php echo $result->message; ?></td>
                          <td><?php echo $result->enquiryOpenDate; ?></td>
                          <td>
                            <?php
                              if($result->enquiryStatus==0)
                              {
                            ?> 
                                <p style="color: red;text-align: center;font-weight: 500;">Open</p>
                            <?php
                              }
                            ?> 
                          </td>
                          <td><a href="enquiry-details.php?eid=<?php echo $result->enquiryid;?>&st=<?php echo $result->enquiryStatus;?>"><i class="fa fa-eye"></i></a></td>
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
            <h2 class="page-title">Previous Enquiries</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Enquiry Id</th>
                    <th scope="col">Issue</th>
                    <th scope="col">Enquiry Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from enquiry where userid=:userid and enquiryStatus=2";
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
                          <td><?php echo $result->enquiryid; ?></td>
                          <td><?php echo $result->message; ?></td>
                          <td><?php echo $result->enquiryOpenDate; ?></td>
                          <td>
                            <?php
                              if($result->enquiryStatus==2)
                              {
                            ?> 
                                <p style="color: red;text-align: center;font-weight: 500;">Closed</p>
                            <?php
                              }
                            ?> 
                          </td>
                          <td><a href="enquiry-details.php?eid=<?php echo $result->enquiryid;?>&st=<?php echo $result->enquiryStatus;?>"><i class="fa fa-eye"></i></a></td>
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