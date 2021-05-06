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
  $eid=$_POST['eid'];
  $st=$_GET['st'];
  if(!empty($_POST['status']))
  {
    $status=$_POST['status'];
    if(!empty($_POST['aid']))
    {
      $aid=strtoupper($_POST['aid']);
      $mysql="SELECT name from admin where adminid=:aid";
      $query = $dbh->prepare($mysql);
      $query->bindParam(':aid',$aid,PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      if($query->rowCount() > 0)
      {
        foreach($results as $result)
        {
          $aname=strtoupper($result->name);
        }
      }
    }
    if(!empty($_POST['aef']))
    {
      $aef=$_POST['aef'];
    }
  }
  if(!empty($aid))
  {    
    date_default_timezone_set("Asia/Kolkata");
    $cdate=date('d-m-Y H:m:s');
    $sql="UPDATE enquiry set assignedAdminId=:aid,assignedAdminName=:aname,enquiryAssignedDate=:cdate,enquiryStatus=:status where enquiryid=:eid and enquiryStatus=:st";
    $query = $dbh->prepare($sql);
    $query->bindParam(':aid',$aid,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->bindParam(':st',$st,PDO::PARAM_STR); 
    $query->bindParam(':status',$status,PDO::PARAM_STR); 
    $query->bindParam(':aname',$aname,PDO::PARAM_STR); 
    $query->bindParam(':cdate',$cdate,PDO::PARAM_STR);    
    if($query->execute())
    {        
      echo '<script>alert("Enquiry status updated successfully!!");</script>'; 
      echo '<script>window.history.go(-2);</script>';        
    }
    else
    {
      echo '<script>alert("Enquiry status not updated!!");</script>'; 
    }
  }
  if(!empty($aef))
  {
    date_default_timezone_set("Asia/Kolkata");
    $cdate=date('d-m-Y H:m:s');
    $sql="UPDATE enquiry set adminEnquiryFeedback=:aef,enquiryClosedDate=:cdate,enquiryStatus=:status where enquiryid=:eid and enquiryStatus=:st";
    $query = $dbh->prepare($sql);
    $query->bindParam(':aef',$aef,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->bindParam(':st',$st,PDO::PARAM_STR); 
    $query->bindParam(':status',$status,PDO::PARAM_STR); 
    $query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
    if($query->execute())
    {        
      echo '<script>alert("Enquiry status updated successfully!!");</script>'; 
      echo '<script>window.history.go(-2);</script>';           
    }
    else
    {
      echo '<script>alert("Enquiry status not updated!!");</script>'; 
    }
  }
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
                      <form method="post" class="form-horizontal">

                        <div class="hr-dashed"></div>
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
                                    <label class="col-sm-2 control-label">Enquiry Id</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="eid" id="eid" value="<?php echo $result->enquiryid; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="cname" id="cname" value="<?php echo $result->name; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Customer Email</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="cemail" id="cemail" value="<?php echo $result->email; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Customer Mobile</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="cmob" id="cmob" value="<?php echo $result->mobile; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Issue</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="issue" id="issue" value="<?php echo $result->message; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-8">
                                      <select name="status" id="status" class="form-control" onchange="showhide()" required>
                                        <option value="">Select</option>
                                        <?php
                                          if($result->enquiryStatus==0)
                                          {
                                        ?>
                                            <option value="1">Assigned</option>
                                            <option value="2">Closed</option>
                                        <?php
                                          }
                                          elseif($result->enquiryStatus==1)
                                          {
                                        ?>
                                            <option value="2">Closed</option>
                                        <?php
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="aid" style="display: none;">
                                    <label class="col-sm-2 control-label">Assigned Admin Id</label>
                                    <div class="col-sm-8">
                                      <select name="aid" id="aid" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                          $mysql="SELECT adminid,name from admin";
                                          $query = $dbh->prepare($mysql);
                                          $query->execute();
                                          $data=$query->fetchAll(PDO::FETCH_OBJ);
                                          if($query->rowCount() > 0)
                                          {
                                            foreach($data as $dt)
                                            {
                                        ?>
                                              <option value="<?php echo $dt->adminid?>"><?php echo $dt->adminid; ?> - (<?php echo $dt->name; ?>)</option>
                                        <?php
                                            }
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="aef" style="display: none;">
                                    <label class="col-sm-2 control-label">Admin Feedback</label>
                                    <div class="col-sm-8">
                                      <textarea type="text" class="form-control" name="aef"></textarea>
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
                        ?>
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">Enquiry Id</th>
                                  <?php
                                    if($st==1)
                                    {
                                  ?>                                      
                                      <th scope="col">Assigned Admin</th>
                                      <th scope="col">Admin Name</th>
                                  <?php
                                    }
                                  ?>
                                  <th scope="col">Customer Name</th>
                                  <th scope="col">Customer Email</th>
                                  <th scope="col">Customer Mobile</th>
                                  <th scope="col">Issue</th>
                                  <th scope="col">Enquiry Open Date</th>
                                  <?php
                                    if($st==1)
                                    {
                                  ?>                                     
                                      <th scope="col">Enquiry Assigned Date</th>
                                  <?php
                                    }
                                  ?>
                                </tr>
                              </thead>
                              <tbody>
                        <?php
                            foreach($results as $result)
                            {              
                        ?>
                                <tr>
                                  <td><?php echo $result->enquiryid; ?></td>
                                  <?php
                                    if($st==1)
                                    {
                                  ?>   
                                      <td><?php echo $result->assignedAdminId; ?></td>
                                      <td><?php echo $result->assignedAdminName; ?></td>
                                  <?php
                                    }
                                  ?>
                                  <td><?php echo $result->name; ?></td>
                                  <td><?php echo $result->email; ?></td>
                                  <td><?php echo $result->mobile; ?></td>
                                  <td><?php echo $result->message; ?></td>
                                  <td><?php echo $result->enquiryOpenDate; ?></td>
                                  <?php
                                    if($st==1)
                                    {
                                  ?>  
                                      <td><?php echo $result->enquiryAssignedDate; ?></td>
                                  <?php
                                    }
                                  ?>
                                </tr>
                        <?php
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
      if(x==1)
      {
        document.getElementById("aid").style.display = 'block';
        document.getElementById("aef").style.display = 'none';
      }
      else if(x==2)
      {
        document.getElementById("aid").style.display = 'none';
        document.getElementById("aef").style.display = 'block';
      }
      else
      {
        document.getElementById("aef").style.display = 'none';
        document.getElementById("aid").style.display = 'none';
      }
    }
  </script>

<?php include('includes/footer.php'); ?>