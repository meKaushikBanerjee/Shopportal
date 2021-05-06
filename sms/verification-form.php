<?php
session_start();
if(isset($_POST['verify']))
{
	$otp=$_POST['otp'];
	$mobile=$_SESSION['mobile'];
	$sql="SELECT * from mobileverify where mobileNo=:mobile and otp=:otp";
	$query = $dbh->prepare($sql);
	$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
	$query->bindParam(':otp',$otp,PDO::PARAM_STR);    
	$query->execute();
	if($query->rowCount() > 0)
	{
	    echo '<script>alert("Otp verified successfully!!");</script>';
	}
	else
	{
		echo '<script>alert("Wrong Otp!!");</script>';
	}
}
if(isset($_SESSION['msg']))
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
<form id="frm-mobile-verification">
	<div class="form-row">
		<label>OTP is sent to Your Mobile Number</label>		
	</div>

	<div class="form-row">
		<input type="text" id="mobileOtp" name="otp" class="form-input" placeholder="Enter the OTP" maxlength="10" minlength="10">		
	</div>

	<div class="row">
		<input id="verify" type="submit" class="btnVerify" value="Verify" name="verify">		
	</div>
</form>
