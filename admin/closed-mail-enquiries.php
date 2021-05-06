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
            <h2 class="page-title">Closed Enquiry</h2>
            <div class="table-responsive">
              <table id="zctb" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Enquiry Id</th>
                    <th scope="col">Assigned Admin</th>
                    <th scope="col">Admin Name</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Customer Mobile</th>
                    <th scope="col">Issue</th>
                    <th scope="col">Enquiry Open Date</th>
                    <th scope="col">Enquiry Assigned Date</th>                    
                    <th scope="col">Admin Feedback</th>
                    <th scope="col">Customer Feedback</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Closing Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from mail_enquiry where enquiryStatus=2";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                  ?>
                        <tr>
                          <td><?php echo $result->enquiryid; ?></td>
                          <td><?php echo $result->assignedAdminId; ?></td>
                          <td><?php echo $result->assignedAdminName; ?></td>
                          <td><?php echo $result->name; ?></td>
                          <td><?php echo $result->email; ?></td>
                          <td><?php echo $result->mobile; ?></td>
                          <td><?php echo $result->message; ?></td>
                          <td><?php echo $result->enquiryOpenDate; ?></td>
                          <td><?php echo $result->enquiryAssignedDate; ?></td>
                          <td><?php echo $result->adminEnquiryFeedback; ?></td>
                          <td><?php echo $result->customerEnquiryFeedback; ?></td>
                          <td><?php echo $result->rating; ?></td>
                          <td><?php echo $result->enquiryClosedDate; ?></td>
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