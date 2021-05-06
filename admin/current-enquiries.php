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
date_default_timezone_set("Asia/Kolkata");
$cdate=date('d-m-Y');
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
            <h2 class="page-title">Today's Enquiry</h2>
            <div class="table-responsive">
              <table id="zctb" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>                    
                    <th scope="col">Enquiry Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Enquiry Date</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from enquiry where openDate=:cdate";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                  ?>
                        <tr>
                          <td><?php echo $result->enquiryid; ?></td>
                          <td><?php echo $result->name; ?></td>
                          <td><?php echo $result->enquiryOpenDate; ?></td>
                          <td>
                            <?php
                                      if($result->enquiryStatus==0)
                                      {
                                    ?>
                                        <p style="color: red;text-align: center;font-weight: 500;">
                                          Enquiry Open</p>
                                    <?php
                                      }
                                      elseif($result->enquiryStatus==1)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Enquiry Assigned to Admin</p>
                                    <?php
                                      }
                                      elseif($result->enquiryStatus==2)
                                      {
                                    ?>  
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Enquiry Closed</p>
                                    <?php
                                      }
                                    ?> 
                          </td>
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