<?php 
$page=1;
error_reporting(0);
include("includes/main.php"); 
if(($_SESSION['logout']) ==1)
{
	echo '<script>window.location.replace("/myaccount.php")</script>';
}
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

if(isset($_POST['signup']))
{
	$sql="SELECT * from users";
	$query = $dbh->prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$row=$query->rowCount();
	if($row>=0)
	{
		$row += 1;
        $id="SP_".$row;
	}
	$email=strtoupper($_POST['email']);
	$password=$_POST['password'];
	/*$encpass = password_hash($password, PASSWORD_BCRYPT);*/
	$name=strtoupper($_POST['fullname']);
	$mobile=$_POST['mobile'];
	$sql="INSERT INTO users(id,email,password,name,contactno) VALUES(:id,:email,:encpass,:name,:mobile)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':id',$id,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':password',$password,PDO::PARAM_STR);		
	/*$query->bindParam(':encpass',$encpass,PDO::PARAM_STR);*/
	$query->bindParam(':name',$name,PDO::PARAM_STR);
	$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);	
	if($query->execute())
	{
		$_SESSION['logout']=1;
		$_SESSION['login']=0;
		$_SESSION['username']=$name;
		$_SESSION['alogin']=$_POST['fullname'];
		$_SESSION['alogged'] = time();
		echo '<script>window.location.replace("/")</script>';					
	}
	else
	{
		echo "<script>alert('Records could not be inserted');</script>";
	}
}

else if(isset($_POST['signin']))
{
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql="SELECT id as uid,password as pswd,name as uname from users where email=:email";
	$query = $dbh->prepare($sql);
	$query->bindParam(':email',$email,PDO::PARAM_STR);		
	$query->execute();	
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
			/*$validPassword = password_verify($password, $results['password']);
	    	if($validPassword)
	    	{*/
	    		date_default_timezone_set("Asia/Kolkata");
	    		$cdate=date('H:i:s', time());
				$uid=$result->uid;
				$uname=$result->uname;
				$sql="INSERT into userlog(userid,userName,userEmail,userIp,loginTime,status) VALUES(:uid,:uname,:email,:ip_address,:cdate,1)";
				$query = $dbh->prepare($sql);
				$query->bindParam(':uid',$uid,PDO::PARAM_STR);
				$query->bindParam(':uname',$uname,PDO::PARAM_STR);
				$query->bindParam(':ip_address',$ip_address,PDO::PARAM_STR);
				$query->bindParam(':email',$email,PDO::PARAM_STR);
				$query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
				if($query->execute())
				{
					$_SESSION['logout']=1;
					$_SESSION['login']=0;
					$_SESSION['uid']=$result->uid;
					$_SESSION['uname']=$result->uname;
					$_SESSION['alogin']=$result->uname;
					$_SESSION['alogged'] = time();
					echo '<script>window.location.replace("/")</script>';
				}
			/*}
			else
			{
				echo "<script>alert('Wrong Password! Kindly check the password');</script>";
			}*/	
		}
	}
	else
	{
		echo "<script>alert('Record not found on db');</script>";
	}
}

?>

<script type="text/javascript">
	function createCaptcha() {
		//clear the contents of captcha div first 
		document.getElementById('captcha').innerHTML = "";
		var charsArray="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var lengthOtp = 6;
		var captcha = [];
		for (var i = 0; i < lengthOtp; i++) {
		    //below code will not allow Repetition of Characters
		    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
		    if (captcha.indexOf(charsArray[index]) == -1)
		      captcha.push(charsArray[index]);
		    else i--;
		}		
		document.getElementById("cap").value = captcha.join("");
	}

	function validation() {
		if(document.form1.chk.value=="") {
			document.getElementById("error").style.display="block";
			document.getElementById("error").innerHTML="Enter Captcha!";
			document.form1.chk.focus();
			return false;
		}
		else if(document.form1.ran.value!=document.form1.chk.value) {
			document.getElementById("error").style.display="block";
			document.getElementById("error").innerHTML="Captcha Not Matched!";
			document.form1.chk.focus();
			return false;
		}
		else if(document.form1.ran.value==document.form1.chk.value) {
			document.getElementById("error").style.display="none";
			return true;
		}
		return true;
	}

	function chkpswd() {
		if(document.form1.repassword.value!=document.form1.password.value) {
			document.getElementById("errorpassword").style.display="block";
			document.getElementById("errorpassword").innerHTML="Password not Matching!";
			document.form1.repassword.focus();
			return false;
		}
		else if(document.form1.repassword.value==document.form1.password.value) {
			document.getElementById("errorpassword").style.display="none";
			return true;
		}
		return true;
	}
</script>

<div class="container">
	<div class="row text-center">
		<div class="col-sm-6 no-gutters">
			<div class="card">
				<form class="form-signin" name="form1" action="" method="POST">
				  	<h1 class="h3 mb-3 font-weight-bold">Register</h1>

				  	<input type="text" name="fullname" id="inputname" class="form-control" placeholder="Full Name" onkeypress="return validname(event);" required >

				  	<input type="text" name="mobile" id="inputmobile" class="form-control" placeholder="Mobile Number" maxlength="10" onkeypress="return validmob(event);" required >

				  	<input type="email" name="email" id="inputemail" class="form-control" placeholder="Email address" required >

				  	<input type="password" name="password" id="inputpassword" class="form-control" placeholder="Password" required>

				  	<input type="password" name="repassword" id="inputrepassword" class="form-control" placeholder="Confirm Password Entered" required onchange="return chkpswd();">
				  	<span id="errorpassword" class="error-color"></span>

					<div id="captcha"></div>
					<input type="text" id="cap" name="ran" class="captcha-image form-control-captcha" readonly>
					<input type="button" class="reload-button" id="btnrefresh" value="Refresh" onclick="createCaptcha()"><br>
					<input type="text" placeholder="Enter Captcha" name="chk" id="cpatchaTextBox" class="form-control" required>	
					<span id="error" class="error-color"></span>

					<button class="btn btn-lg btn-primary btn-block" name="signup" type="submit" onclick="return validation();">Register</button>
					<p class="mt-5 mb-3 text-muted">&copy; 2017-2020 by Kaushik Banerjee</p>
				</form>		
			</div>
		</div>
		<div class="col-sm-6 no-gutters">
			<div class="card">
				<form class="form-signin" action="" method="POST">
				  	<h1 class="h3 mb-3 font-weight-bold">Login</h1>

				  	<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required >

				  	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

				  	<div class="checkbox mb-3">
				    	<label>
				      		<input type="checkbox" value="remember-me" required> Remember me
				    	</label>
				  	</div>

				  	<button class="btn btn-lg btn-primary btn-block" name="signin" type="submit">Login</button>
				  	<p class="mt-5 mb-3 text-muted">&copy; 2017-2020 by Kaushik Banerjee</p>
				</form>	
			</div>		
		</div>
	</div>
</div>

<?php include ("includes/footer.php"); ?>