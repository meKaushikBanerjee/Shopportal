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
$pid=$_GET['pid'];
$userid=$_SESSION['uid'];
if(isset($_POST['update']))
{
  $userid=$_SESSION['uid'];
  if(isset($_POST['pricerating']))
  {
    $prate=$_POST['pricerating'];
  }
  if(isset($_POST['quarating']))
  {
    $qrate=$_POST['quarating'];
  }
  if(isset($_POST['valrating']))
  {
    $vrate=$_POST['valrating'];
  }
  $reason=$_POST['reason'];
  $sql="UPDATE productreviews set quality=:qrate,price=:prate,review=:reason,value=:vrate,status=1 where userid=:userid and productid=:pid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':userid',$userid,PDO::PARAM_STR);
  $query->bindParam(':pid',$pid,PDO::PARAM_STR);
  $query->bindParam(':qrate',$qrate,PDO::PARAM_STR);  
  $query->bindParam(':prate',$prate,PDO::PARAM_STR);
  $query->bindParam(':vrate',$vrate,PDO::PARAM_STR);
  $query->bindParam(':reason',$reason,PDO::PARAM_STR); 
  if($query->execute())
  {
    $_SESSION['msg']="Your review was submitted successfully!!";     
  }
  else
  {
    $_SESSION['msg']="Your review could not be submitted!!";
  }
}

if(isset($_SESSION['uid']))
{  
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
            <h2 class="page-title">Review your order</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Review</div>
                    <div class="panel-body">
                      <?php 
                        if(isset($_POST['update']))
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

                      <form method="post" class="form-horizontal">
                        <div class="hr-dashed"></div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Price Rating</label>
                                <div class="col-sm-5 pricerating">
                                    <input type="radio" id="pstar5" name="pricerating" value="5" />
                                    <label class="pfull" for="pstar5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="pstar4half" name="pricerating" value="4.5" />
                                    <label class="phalf" for="pstar4half" title="Pretty good - 4.5 stars"></label> 
                                    <input type="radio" id="pstar4" name="pricerating" value="4" />
                                    <label class="pfull" for="pstar4" title="Pretty good - 4 stars"></label> 
                                    <input type="radio" id="pstar3half" name="pricerating" value="3.5" />
                                    <label class="phalf" for="pstar3half" title="Meh - 3.5 stars"></label> 
                                    <input type="radio" id="pstar3" name="pricerating" value="3" />
                                    <label class="pfull" for="pstar3" title="Meh - 3 stars"></label> 
                                    <input type="radio" id="pstar2half" name="pricerating" value="2.5" />
                                    <label class="phalf" for="pstar2half" title="Kinda bad - 2.5 stars"></label> 
                                    <input type="radio" id="pstar2" name="pricerating" value="2" />
                                    <label class="pfull" for="pstar2" title="Kinda bad - 2 stars"></label> 
                                    <input type="radio" id="pstar1half" name="pricerating" value="1.5" />
                                    <label class="phalf" for="pstar1half" title="Meh - 1.5 stars"></label> 
                                    <input type="radio" id="pstar1" name="pricerating" value="1" />
                                    <label class="pfull" for="pstar1" title="Sucks big time - 1 star"></label> 
                                    <input type="radio" id="pstarhalf" name="pricerating" value="0.5" />
                                    <label class="phalf" for="pstarhalf" title="Sucks big time - 0.5 stars"></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Quality Rating</label>
                                <div class="col-sm-5 quarating">
                                    <input type="radio" id="qstar5" name="quarating" value="5" />
                                    <label class="qfull" for="qstar5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="qstar4half" name="quarating" value="4.5" />
                                    <label class="qhalf" for="qstar4half" title="Pretty good - 4.5 stars"></label> 
                                    <input type="radio" id="qstar4" name="quarating" value="4" />
                                    <label class="qfull" for="qstar4" title="Pretty good - 4 stars"></label> 
                                    <input type="radio" id="qstar3half" name="quarating" value="3.5" />
                                    <label class="qhalf" for="qstar3half" title="Meh - 3.5 stars"></label> 
                                    <input type="radio" id="qstar3" name="quarating" value="3" />
                                    <label class="qfull" for="qstar3" title="Meh - 3 stars"></label> 
                                    <input type="radio" id="qstar2half" name="quarating" value="2.5" />
                                    <label class="qhalf" for="qstar2half" title="Kinda bad - 2.5 stars"></label> 
                                    <input type="radio" id="qstar2" name="quarating" value="2" />
                                    <label class="qfull" for="qstar2" title="Kinda bad - 2 stars"></label> 
                                    <input type="radio" id="qstar1half" name="quarating" value="1.5" />
                                    <label class="qhalf" for="qstar1half" title="Meh - 1.5 stars"></label> 
                                    <input type="radio" id="qstar1" name="quarating" value="1" />
                                    <label class="qfull" for="qstar1" title="Sucks big time - 1 star"></label> 
                                    <input type="radio" id="qstarhalf" name="quarating" value="0.5" />
                                    <label class="qhalf" for="qstarhalf" title="Sucks big time - 0.5 stars"></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Value Rating</label>
                                <div class="col-sm-5 rating">
                                    <input type="radio" id="vstar5" name="valrating" value="5" />
                                    <label class="vfull" for="vstar5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="vstar4half" name="valrating" value="4.5" />
                                    <label class="vhalf" for="vstar4half" title="Pretty good - 4.5 stars"></label> 
                                    <input type="radio" id="vstar4" name="valrating" value="4" />
                                    <label class="vfull" for="vstar4" title="Pretty good - 4 stars"></label> 
                                    <input type="radio" id="vstar3half" name="valrating" value="3.5" />
                                    <label class="vhalf" for="vstar3half" title="Meh - 3.5 stars"></label> 
                                    <input type="radio" id="vstar3" name="valrating" value="3" />
                                    <label class="vfull" for="vstar3" title="Meh - 3 stars"></label> 
                                    <input type="radio" id="vstar2half" name="valrating" value="2.5" />
                                    <label class="vhalf" for="vstar2half" title="Kinda bad - 2.5 stars"></label> 
                                    <input type="radio" id="vstar2" name="valrating" value="2" />
                                    <label class="vfull" for="vstar2" title="Kinda bad - 2 stars"></label> 
                                    <input type="radio" id="vstar1half" name="valrating" value="1.5" />
                                    <label class="vhalf" for="vstar1half" title="Meh - 1.5 stars"></label> 
                                    <input type="radio" id="vstar1" name="valrating" value="1" />
                                    <label class="vfull" for="vstar1" title="Sucks big time - 1 star"></label> 
                                    <input type="radio" id="vstarhalf" name="valrating" value="0.5" />
                                    <label class="vhalf" for="vstarhalf" title="Sucks big time - 0.5 stars"></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Comment</label>
                                <div class="col-sm-8">
                                  <textarea type="text" class="form-control" name="reason" required></textarea>
                                </div>
                              </div>
                              <div class="col-sm-8 col-sm-offset-5">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Order Status">
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
  <!--<script type="text/javascript">
    $(document).ready(function()
    {
      $("input[@name='pricerating']").click(function()
      {
        var sim = $("input[@name='pricerating']:checked").val();
        //alert(sim);
        if (sim<3) 
        { 
          $('.pmyratings').css('color','red'); 
          $(".pmyratings").text(sim); 
        }
        else
        { 
          $('.pmyratings').css('color','green'); 
          $(".pmyratings").text(sim); 
        } 
      }); 
      $("input[@name='quarating']").click(function()
      {
        var sim = $("input[@name='quarating']:checked").val();
        //alert(sim);
        if (sim<3) 
        { 
          $('.qmyratings').css('color','red'); 
          $(".qmyratings").text(sim); 
        }
        else
        { 
          $('.qmyratings').css('color','green'); 
          $(".qmyratings").text(sim); 
        } 
      });
      $("input[@name='valrating']").click(function()
      {
        var sim = $("input[@name='valrating']:checked").val();
        //alert(sim);
        if (sim<3) 
        { 
          $('.vmyratings').css('color','red'); 
          $(".vmyratings").text(sim); 
        }
        else
        { 
          $('.vmyratings').css('color','green'); 
          $(".vmyratings").text(sim); 
        } 
      });
    });
  </script>-->
<?php 
}
else
{
  echo '<script>alert("Kindly login!");</script>';
  echo '<script>window.location.replace("/login-signup.php");</script>';
}
include('includes/footer.php'); 

?>