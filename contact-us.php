<?php 
$page=0;
include("includes/main.php"); 
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 60*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  header('Location: logout.php');
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}
if(isset($_SESSION['logout']))
{
	if($_SESSION['logout'] == 1)
	{
		include("includes/topheader.php");
	}
}
include("includes/searchbar.php");
include("includes/navbar.php"); 

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
{
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
{
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
if(isset($_POST['submit']))
{
	$sql="SELECT * from mail_enquiry";
	$query = $dbh->prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$row=$query->rowCount();
	if($row>=0)
	{
		$row += 1;
	    $id="MENQ_".$row;
	}
	date_default_timezone_set("Asia/Kolkata");
	$cdate=date('d-m-Y');
	$email=$_POST['email'];
	$sub=$_POST['subject'];
	$message=$_POST['message'];
	$name=strtoupper($_POST['name']);
	$mobile=$_POST['mobile'];
	$sql="INSERT INTO mail_enquiry(enquiryid,name,email,mobile,subject,message,openDate) VALUES(:id,:name,:email,:mobile,:sub,:message,:cdate)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':id',$id,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':sub',$sub,PDO::PARAM_STR);
	$query->bindParam(':message',$message,PDO::PARAM_STR);	
	$query->bindParam(':name',$name,PDO::PARAM_STR);
	$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
	$query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
	if($query->execute())
	{
		$to = $_POST['email'];
	    $subject = "Contact us mail";	         
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

if(isset($_POST['submit']))
{ 
?>
	<div class="container">
		<div class="row">
    		<div class="alert alert-error col-sm-5" style="color: green;">
        		<button type="button" class="close" data-dismiss="alert">x</button>
            		<?php echo htmlentities($_SESSION['msg']); ?>
    		</div>
    	</div>
    </div>
<?php 
}
?>
<section class="container mt-5">

   <!--Contact heading-->
   	<div class="row">   		
      	<!--Grid column-->
      	<div class="col-sm-12 mb-4 col-md-5">
      		<div class="container">
         <!--Form with header-->
         		<form name="form1" action="" method="POST">
		         	<div class="card border-primary rounded-0">
		            	<div class="card-header p-0">
		               		<div class="bg-primary text-white py-3">
		                  		<h3 style="text-align: center;"><i class="fa fa-envelope"></i> Write to us:</h3>
		               		</div>
		            	</div>
		            	<div class="card-body p-3">               
		                  	<div class="form-group">
			                  	<label>Name:</label>
			                  	<div class="input-group">
			                     	<input value="" type="text" name="name" class="form-control" id="inlineFormInputGroupUsername" placeholder="Name" required>
			                  	</div>
							</div>
		                  	<div class="form-group">
		                     	<label>Registered email:</label>
		                     	<div class="input-group mb-2 mb-sm-0">
		                        	<input type="email" value="" name="email" class="form-control" placeholder="Registered Email" required>
		                     	</div>
		                  	</div>
		                  	<div class="form-group">
			                  	<label>Registered Mobile:</label>
			                  	<div class="input-group">
			                     	<input value="" type="text" name="mobile" class="form-control" maxlength="10" onkeypress="return validmob(event);" placeholder="Registered Mobile Number" required>
			                  	</div>
							</div>
		                  	<div class="form-group">
		                     	<label>Subject</label>
		                     	<div class="input-group mb-2 mb-sm-0">
		                        	<input type="text" name="subject" class="form-control" id="inlineFormInputGroupUsername" placeholder="Subject" required>
		                     	</div>
		                  	</div>
		                  	<div class="form-group">
		                     	<label>Message</label>
		                     	<div class="input-group mb-2 mb-sm-0">
		                        	<textarea type="text" class="form-control" name="message" placeholder="Enter your message" required></textarea>
		                     	</div>
		                  	</div>
		                  	<?php
		                  		$a=mt_rand(0,100);
		                  		$b=mt_rand(0,100);
		                  		$c=$a+$b;
		                  	?>
		                  	<div class="form-group">
		                  		<label>Solve the maths below</label>
				                <div class="input-group">
				                    <input value="<?php echo $a."+".$b; ?>" class="form-control" id="inlineFormInputGroupUsername" readonly>
				                </div>
				                <div class="input-group">
				                    <input value="<?php echo $c; ?>" type="text" name="addcaptcha" hidden disabled>
				                </div>
				                <div class="input-group">
				                    <input value="" type="text" name="captcha" class="form-control" placeholder="Enter your added result here" required>
				                </div>
				                <span id="error" class="error-color"></span>
							</div>
		                  	<div class="text-center">
		                     	<input type="submit" name="submit" value="submit" class="btn btn-primary btn-block rounded-0 py-2" onclick="return validation();">
		                  	</div>
					    </div>
		            </div>
		        </form>
	        </div>
        </div>
      	<!--Grid column-->
	  
      	<!--Grid column-->
      	<div class="col-sm-12 col-md-7">
         	<!--Google map-->
         	<div class="mb-4">
            	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d117223.77996815204!2d85.3213263!3d23.3432048!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x11b5a9b0042eef56!2sourcita.com!5e0!3m2!1sen!2sin!4v1589706571407!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
         	</div>
         	<!--Buttons-->
         	<div class="row text-center">
            	<div class="col-md-4">
               		<a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-map-marker"></i></a>
               		<p> Your Address ….. </p>
            	</div>
            	<div class="col-md-4">
               		<a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-phone"></i></a>
               		<p>+91- 90000000</p>
            	</div>
	            <div class="col-md-4">
	               	<a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-envelope"></i></a>
	               	<p> your@gmail.com</p>
	            </div>
         	</div>
      	</div>
      	<!--Grid column-->
	</div>
</section>
<script type="text/javascript">
	function validation() {
		var sum = <?php echo $c; ?>;
		if(document.form1.captcha.value=="") {
			document.getElementById("error").style.display="block";
			document.getElementById("error").innerHTML="Enter Captcha!";
			document.form1.captcha.focus();
			return false;
		}
		else if(document.form1.addcaptcha.value!=document.form1.captcha.value) {
			document.getElementById("error").style.display="block";
			document.getElementById("error").innerHTML="Captcha Not Matched!";
			document.form1.captcha.focus();
			return false;
		}
		else if(document.form1.addcaptcha.value==document.form1.captcha.value) {
			document.getElementById("error").style.display="none";
			return true;
		}
		return true;
	}
</script>

<?php include ("includes/footer.php"); ?>