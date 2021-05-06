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
?>

<body>

<?php include("includes/header.php");?>
  
  <div class="ts-main-content">

<?php include('includes/sidebar.php'); ?>
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
                      <div class="hr-dashed"></div>
                      <div class="form-horizontal">
                        <?php 
                          $id=$_GET['eid'];
                          $st=$_GET['st'];
                          $sql="SELECT * from enquiry where enquiryid=:id and enquiryStatus=:st";
                          $query = $dbh->prepare($sql);
                          $query->bindParam(':st',$st,PDO::PARAM_STR);                  
                          $query->bindParam(':id',$id,PDO::PARAM_STR);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                            foreach($results as $result)
                            {
                        ?>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Enquiry Id</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="eid" id="eid" value="<?php echo $result->enquiryid; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Customer Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="cname" id="cname" value="<?php echo $result->name; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Customer Email</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="cemail" id="cemail" value="<?php echo $result->email; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Customer Mobile</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="cmob" id="cmob" value="<?php echo $result->mobile; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Issue</label>
                                    <div class="col-sm-8">
                                      <textarea type="text" class="form-control" name="issue" id="issue" readonly><?php echo $result->message; ?></textarea>
                                    </div>
                                  </div>                             
                                  <?php
                                    if($result->enquiryStatus==0)
                                    {
                                  ?>                                   
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="Open" readonly>
                                    </div>
                                  </div>
                                  <?php
                                    }
                                    elseif($result->enquiryStatus==1)
                                    {
                                  ?> 
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="Assigned" readonly>
                                    </div>
                                  </div>                                   
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Assigned Admin</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->assignedAdminName; ?>" readonly>
                                    </div>
                                  </div>                                       
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Enquiry Assigned Date</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->enquiryAssignedDate; ?>" readonly>
                                    </div>
                                  </div>
                                  <?php
                                    }
                                    elseif($result->enquiryStatus==2)
                                    {
                                  ?>                                    
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-8"> 
                                      <input type="text" class="form-control" name="issue" id="issue" value="Closed" readonly> 
                                    </div>
                                  </div>                                   
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Assigned Admin</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->assignedAdminName; ?>" readonly>
                                    </div>
                                  </div>                                       
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Enquiry Assigned Date</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->enquiryAssignedDate; ?>" readonly>
                                    </div>
                                  </div>                                       
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Admin Feedback</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->adminEnquiryFeedback; ?>" readonly>
                                    </div>
                                  </div>                                       
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Enquiry Closed Date</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->enquiryClosedDate; ?>" readonly>
                                    </div>
                                  </div>                                       
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Admin Feedback</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="Open" readonly>
                                    </div>
                                  </div>
                                  <?php
                                    }
                            }
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

<?php include('includes/footer.php'); ?>