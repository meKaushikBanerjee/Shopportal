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
  $uname=strtoupper($_POST['uname']);
  $name=strtoupper($_POST['name']);
  $gender=strtoupper($_POST['gender']);
  $email=$_POST['email'];
  $mobile=$_POST['mobile'];
  date_default_timezone_set("Asia/Kolkata");
  $udate=date("d/m/y H:i:s");
  $sql="UPDATE admin set name=:name,gender=:gender,mobile=:mobile,updationDate=:udate where adminid=:uname and email=:email";
  $query = $dbh->prepare($sql);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':gender',$gender,PDO::PARAM_STR);  
  $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);   
  $query->bindParam(':uname',$uname,PDO::PARAM_STR);    
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

if(isset($_POST['password']))
{
  $password=strtoupper($_POST['newpassword']);
  $sql="UPDATE admin set password=:password where adminid=:uname";
  $query = $dbh->prepare($sql);
  $query->bindParam(':uname',$uname,PDO::PARAM_STR);    
  $query->bindParam(':password',$password,PDO::PARAM_STR);               
  if($query->execute())
  {
    $_SESSION['msg']="Password Changed Successfully!!";         
  }
  else
  {
    echo "<script>alert('Account could not be updated');</script>";
  }
}

?>

<body>

<?php include("includes/header.php");?>
  
  <div class="ts-main-content">

<?php 
    include('includes/sidebar.php');

    $uname=$_SESSION['login'];
    $sql ="SELECT * FROM admin WHERE adminid=:uname";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
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
                  <h2 class="page-title"><?php echo $result->name;?>'s&nbsp;Profile </h2>
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
                              <label class="col-sm-2 control-label"> Admin Id : </label>
                              <div class="col-sm-8">
                                <input type="text" name="uname" id="uname"  class="form-control" readonly value="<?php echo $result->adminid; ?>" >
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Name : </label>
                              <div class="col-sm-8">
                                <input type="text" name="name" id="name"  class="form-control" value="<?php echo $result->name;?>"   required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Gender : </label>
                              <div class="col-sm-8">
                                <select name="gender" class="form-control" required>
                                  <?php 
                                    if($result->gender == "NULL")
                                    { 
                                  ?>
                                      <option value="null">choose Gender</option>
                                      <option value="male">Male</option>    
                                      <option value="female">Female</option>
                                      <option value="others">Others</option>
                                  <?php 
                                    } 
                                    elseif($result->gender == "MALE")
                                    { 
                                  ?>  
                                      <option value="<?php echo $result->gender;?>"><?php echo $result->gender;?></option>
                                      <option value="female">Female</option>
                                      <option value="others">Others</option>  
                                  <?php
                                    }
                                    elseif($result->gender == "FEMALE")
                                    {
                                  ?>
                                      <option value="<?php echo $result->gender;?>"><?php echo $result->gender;?></option>
                                      <option value="male">Male</option>                  
                                      <option value="others">Others</option>
                                  <?php
                                    }
                                    elseif($result->gender == "OTHERS")
                                    {
                                  ?>
                                      <option value="<?php echo $result->gender;?>"><?php echo $result->gender;?></option>
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Mobile No : </label>
                              <div class="col-sm-8">
                                <input type="text" name="mobile" id="mobile"  class="form-control" minlength="10" maxlength="10" value="<?php echo $result->mobile;?>" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Email id: </label>
                              <div class="col-sm-8">
                                <input type="email" name="email" id="email"  class="form-control" value="<?php echo $result->email;?>" readonly>
                                <span id="user-availability-status" style="font-size:12px;"></span>
                              </div>
                            </div>

                            <div class="col-sm-6 col-sm-offset-4">
                              <input type="submit" name="update" Value="Update Profile" class="btn btn-primary">
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

  <script type="text/javascript">
    function chkpswd() {
      if(document.form1.newrepassword.value!=document.form1.newpassword.value) {
        document.getElementById("errorpassword").style.display="block";
        document.getElementById("errorpassword").innerHTML="Password not Matching!";
        document.form1.newrepassword.focus();
        return false;
      }
      else if(document.form1.newrepassword.value==document.form1.newpassword.value) {
        document.getElementById("errorpassword").style.display="none";
        return true;
      }
      return true;
    }
  </script>

  <div class="ts-main-content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Change Password</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Change Password</div>
                    <div class="panel-body">
                      <?php 
                        if(isset($_POST['password']))
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
                      <form method="post" name="form1" class="form-horizontal" action="" >                 
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Enter New Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Confirm New Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" name="newrepassword" id="newrepassword" required onchange="return chkpswd();">
                          </div>
                        </div>
                        <span id="errorpassword" style="color: red;font-weight: 500;"></span>
                        <div class="col-sm-8 col-sm-offset-5">
                          <input class="btn btn-primary" type="submit" name="password" value="Change Password">
                        </div>
                      </form>
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