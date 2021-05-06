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
if(isset($_POST['password']))
{
  $password=strtoupper($_POST['newpassword']);
  $sql="UPDATE users set password=:password where id=:userid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':userid',$userid,PDO::PARAM_STR);    
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

if(isset($_SESSION['uid']))
{
?>

<body>

<?php include("includes/header.php");?>
  
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
                              <label class="col-sm-2 control-label"> User Id : </label>
                              <div class="col-sm-8">
                                <input type="text" name="uname" id="uname"  class="form-control" readonly value="<?php echo $result->id; ?>" >
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Name : </label>
                              <div class="col-sm-8">
                                <input type="text" name="name" id="name"  class="form-control" readonly value="<?php echo $result->name;?>"   required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Mobile No : </label>
                              <div class="col-sm-8">
                                <input type="text" name="mobile" id="mobile"  class="form-control" readonly minlength="10" maxlength="10" value="<?php echo $result->contactno;?>" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Email id: </label>
                              <div class="col-sm-8">
                                <input type="email" name="email" id="email"  class="form-control" readonly value="<?php echo $result->email;?>" readonly>
                                <span id="user-availability-status" style="font-size:12px;"></span>
                              </div>
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

<?php 
}
else
{
  echo '<script>alert("Kindly login!");</script>';
  echo '<script>window.location.replace("/login-signup.php");</script>';
}
include('includes/footer.php'); 

?>