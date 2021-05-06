<?php
session_start();
// Include the bundled autoload from the Twilio PHP Helper Library
include("twilio-php-main/src/Twilio/autoload.php");
use Twilio\Rest\Client;

if(isset($_POST['otp']))
{
	$mobile=$_POST['mobile'];
	$otp = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
	$account_sid = getenv('AC9327f443d8df42a69ba97524da115bba');
	$auth_token = getenv('1de46933cf80a9c71b7184f24cb20a38');

	// A Twilio number you own with SMS capabilities
	$twilio_number = "+15017122661";
	$client = new Client($account_sid, $auth_token);
	$client->messages->create(
	    // Where to send a text message (your cell phone?)
	    $mobile,
	    array(
	        'from' => $twilio_number,
	        'body' => 'Your requested mobile verification otp is - '.$otp
	    )
	);
	$sql="INSERT into mobileverify(mobileNo,otp) VALUES(:mobile,:otp)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR); 
    $query->bindParam(':otp',$otp,PDO::PARAM_STR); 
    if($query->execute())
    {
    	$_SESSION['msg']="Rquested otp has been sent to your mobile!!";
    	$_SESSION['mobile']=$mobile;
    	echo '<script>window.location.replace("verification-form.php");</script>';
    }
    else
    {
    	echo '<script>alert("Data could not be inserted into the table");</script>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>How to Implement OTP SMS Mobile Verification in PHP with TextLocal</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

	<div class="container">
		<div class="error"></div>
		<form id="frm-mobile-verification" method="POST" action=""> 
			<div class="form-heading">Mobile Number Verification</div>

			<div class="form-row">
				<input type="text" id="mobile" name="mobile" class="form-input"
					placeholder="Enter the 10 digit mobile" maxlength="10" minlength="10" required>
			</div>

			<input type="submit" name="otp" class="btnSubmit" value="Send OTP">
		</form>
	</div>

	<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
</body>
</html>