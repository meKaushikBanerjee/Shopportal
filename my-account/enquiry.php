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

if(isset($_POST['submit']))
{
  $sql="SELECT * from enquiry";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $row=$query->rowCount();
  if($row>=0)
  {
    $row += 1;
      $id="ENQ_".$row;
  }
  date_default_timezone_set("Asia/Kolkata");
  $cdate=date('d-m-Y');
  $userid=strtoupper($_POST['uid']);
  $email=$_POST['email'];
  $sub=$_POST['subject'];
  $message=$_POST['message'];
  $name=strtoupper($_POST['name']);
  $mobile=$_POST['mobile'];
  $sql="INSERT INTO enquiry(enquiryid,userid,name,email,mobile,subject,message,openDate) VALUES(:id,:userid,:name,:email,:mobile,:sub,:message,:cdate)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->bindParam(':userid',$userid,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':sub',$sub,PDO::PARAM_STR);
  $query->bindParam(':message',$message,PDO::PARAM_STR);  
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
  $query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
  if($query->execute())
  {
    $to = $_POST['email'];
      $subject = "Enquiry sent to Kaushik";          
      $message = "<html>
            <head>
              <title>User Enquiry</title>
            </head>
            <body>
              <p>Thank You! for querying with us!</p>
              <p>Keep this Enquiry ID: ".$id." for future reference.</p>
              <p>Your satisfaction is our achievement. So kindly be patient while we go through your query and solve it!</p>
              <p>Thanking You,</p>
              <p>kaushik's</p>
            </body>
          </html>";
           
      $header = 'From: kaushikuem19@gmail.com';
      $header .= 'MIME-Version: 1.0' . "\r\n";  
    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
           
      $retval = mail($to,$subject,$message,$header);
      if( $retval == true ) 
      {
        $to = "kaushikuem19@gmail.com";
        $subject = "Query posted";           
        $message = "<html>
              <head>
                <title>User Enquiry</title>
              </head>
              <body>
                <p>A query has been posted by ".$name." with email".$email.".</p>
                <p>Enquiry ID:" .$id.".</p>
                <p>Thanking You,</p>
                <p>".$name."</p>
              </body>
            </html>";
             
        $header = 'From: '.$email;
        $header .= 'MIME-Version: 1.0' . "\r\n";  
      $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
             
        $retval1 = mail($to,$subject,$message,$header);
        if( $retval1 == true ) 
        {
          $_SESSION['msg']="Enquiry is sent Successfully!!";     
          echo '<script>window.location.replace("contact-us.php");</script>';
        }
        else
        {
          echo "<script>alert('Email could not be sent to the admin');</script>";
        }
      }
      else
      {
        echo "<script>alert('Email could not be sent to the user');</script>";
      }
  }
  else
  {
    echo "<script>alert('Records could not be inserted');</script>";
  }
}

if(isset($_SESSION['uid']))
{
  $userid=$_SESSION['uid'];
?>

<body>

<?php include("includes/header.php"); ?>
  
  <div class="ts-main-content">

<?php include("includes/sidebar.php"); ?>
    <div class="content-wrapper">
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Send Enquiry</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading"></div>
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
                          <input type="text" name="uid" id="uid"  class="form-control" readonly value="<?php echo $userid; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Name : </label>
                        <div class="col-sm-8">
                          <input type="text" name="name" id="name"  class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email id: </label>
                        <div class="col-sm-8">
                          <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile No : </label>
                        <div class="col-sm-8">
                          <input type="text" name="mobile" id="mobile"  class="form-control" minlength="10" maxlength="10" required>
                        </div>
                      </div>                      

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Subject: </label>
                        <div class="col-sm-8">
                          <input type="text" name="subject" id="subject" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Message: </label>
                        <div class="col-sm-8">
                          <textarea name="message" id="message" class="form-control" required></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-5">
                          <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block rounded-0 py-2">
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